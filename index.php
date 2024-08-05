<?php
require_once 'connection.php';
require_once 'inc/header.php';

$isAdmin = isset($_SESSION['user_id']) && $_SESSION['user_id'] == 1;

$userIdInUrl = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_orders'])) {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $product_id = $_POST['product_id'];

        if ($product_id) {
            $query = "INSERT INTO orders (user_id, product_id, orderDate,quantity) VALUES (?, ?, NOW(),1)";
            $stmt = $connection->prepare($query);
            $stmt->execute([$user_id, $product_id]);
            
            $message = 'Product added to your orders!';
        }
    }
}
?>

<div class="latest-products">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="section-heading">
          <h2 class="text-center m-5">Categories</h2>
        </div>
        <ul class="list-group">
          <?php
          $categoryQuery = "SELECT id, name FROM categories"; 
          $categorySqlQuery = $connection->prepare($categoryQuery);
          $categorySqlQuery->execute();
          
          if ($categorySqlQuery->rowCount() > 0) {
            $categories = $categorySqlQuery->fetchAll(PDO::FETCH_ASSOC); 

            foreach ($categories as $category) {
              ?>
              <li class="list-group-item list-group-item-action">
                <a href="index.php?cat_id=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a>
              </li>
              <?php
            }
          } else {
            echo '<li class="list-group-item">No categories found</li>';
          }
          ?>
        </ul>
      </div>

      <div class="col-md-9">
        <div class="section-heading">
          <h2 class="text-center m-5">Products</h2>
        </div>

        <div class="row">
          <?php
          $cat_id = isset($_GET['cat_id']) ? (int)$_GET['cat_id'] : 0;

          if ($cat_id > 0) {
              $query = "SELECT id, name, price, img_src, cat_id, availability FROM products WHERE cat_id = ?";
              $sqlQuery = $connection->prepare($query);
              $sqlQuery->execute([$cat_id]);
          } else {
              $query = "SELECT id, name, price, img_src, cat_id, availability FROM products";
              $sqlQuery = $connection->prepare($query);
              $sqlQuery->execute();
          }
          
          if ($sqlQuery->rowCount() > 0) {
            $products = $sqlQuery->fetchAll(PDO::FETCH_ASSOC); 

            foreach ($products as $product) {
              ?>
              <div class="col-md-4 mb-4">
                <div class="card h-100">
                  <img src="<?php echo $product['img_src']; ?>" class="card-img-top" alt="<?php echo $product['name']; ?>" style="width: 100%; height: 200px; object-fit: cover;">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $product['name']; ?></h5>
                    <p class="card-text">Price: <?php echo $product['price']; ?></p>
                    <p class="card-text">Availability: <?php echo $product['availability']; ?></p>
                    <?php if (!$isAdmin && $userIdInUrl != 1) { ?>
                      <form method="POST" action="index.php">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <button type="submit" name="add_to_orders" class="btn btn-primary">Add to My Orders</button>
                      </form>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <?php
            }
          } else {
            echo '<div class="col-md-12">No products found</div>';
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php if (isset($message)): ?>
  <div class="alert alert-success" role="alert">
    <?php echo $message; ?>
  </div>
<?php endif; ?>

<?php require_once 'inc/footer.php'; ?>
