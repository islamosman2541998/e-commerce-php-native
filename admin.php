<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_product'])) {
        $name = $_POST['product_name'];
        $price = $_POST['product_price'];
        $cat_id = $_POST['product_cat_id'];
        $availability = $_POST['product_availability'];

        
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["product_img_src"]["name"]);
        move_uploaded_file($_FILES["product_img_src"]["tmp_name"], $target_file);

        $query = "INSERT INTO products (name, price, img_src, cat_id, availability) VALUES (?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($query);
        $stmt->execute([$name, $price, $target_file, $cat_id, $availability]);
    }

    if (isset($_POST['add_category'])) {
        $name = $_POST['category_name'];

        $query = "INSERT INTO categories (name) VALUES (?)";
        $stmt = $connection->prepare($query);
        $stmt->execute([$name]);
    }
}
?>

<?php require_once 'inc/header.php' ?>

<div class="container my-5">
   
    
   
    <div class="row mb-5">
        <div class="col-md-6 offset-md-3">
            <h3 class="text-center">Add New Product</h3>
            <form method="POST" action="admin.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" required>
                </div>
                <div class="form-group">
                    <label for="product_price">Product Price</label>
                    <input type="text" class="form-control" id="product_price" name="product_price" required>
                </div>
                <div class="form-group">
                    <label for="product_img_src">Product Image</label>
                    <input type="file" class="form-control" id="product_img_src" name="product_img_src" required>
                </div>
                <div class="form-group">
                    <label for="product_cat_id">Product Category ID</label>
                    <input type="text" class="form-control" id="product_cat_id" name="product_cat_id" required>
                </div>
                <div class="form-group">
                    <label for="product_availability">Product Availability</label>
                    <input type="text" class="form-control" id="product_availability" name="product_availability" required>
                </div>
                <button type="submit" class="btn btn-primary" name="add_product">Add Product</button>
            </form>
        </div>
    </div>

   
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h3 class="text-center">Add New Category</h3>
            <form method="POST" action="admin.php">
                <div class="form-group">
                    <label for="category_name">Category Name</label>
                    <input type="text" class="form-control" id="category_name" name="category_name" required>
                </div>
                <button type="submit" class="btn btn-primary" name="add_category">Add Category</button>
            </form>
        </div>
    </div>
</div>

<?php require_once 'inc/footer.php' ?>
