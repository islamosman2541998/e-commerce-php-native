<?php
require_once 'connection.php';
require_once 'inc/header.php';

if (!isset($_GET['id'])) {
    echo "No product ID specified.";
    exit;
}

$product_id = $_GET['id'];

$query = "SELECT * FROM products WHERE id = ?";
$stmt = $connection->prepare($query);
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "Product not found.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $cat_id = $_POST['product_cat_id'];
    $availability = $_POST['product_availability'];

    $img_src = $_POST['current_img_src']; 

    if (isset($_FILES['product_img_src']) && $_FILES['product_img_src']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        $tmp_name = $_FILES['product_img_src']['tmp_name'];
        $new_img_name = basename($_FILES['product_img_src']['name']);
        $upload_file = $upload_dir . $new_img_name;

        if (move_uploaded_file($tmp_name, $upload_file)) {
            $img_src = $upload_file;
        } else {
            echo "Failed to upload image.";
            exit;
        }
    }

    $updateQuery = "UPDATE products SET name = ?, price = ?, img_src = ?, cat_id = ?, availability = ? WHERE id = ?";
    $stmt = $connection->prepare($updateQuery);

    if ($stmt->execute([$name, $price, $img_src, $cat_id, $availability, $product_id])) {
        echo "Product updated successfully.";
        header("Location: allproducts_admin.php");
        exit;
    } else {
        echo "Failed to update product.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 800px;
            margin-top: 20px;
            
        }
        .form-group img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Edit Product</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" id="product_name" name="product_name" class="form-control" value="<?php echo htmlspecialchars($product['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" id="product_price" name="product_price" class="form-control" value="<?php echo htmlspecialchars($product['price']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="product_img_src" class="form-label">Product Image Source</label>
                <div>
                    <img styles ="width: 100px; height: 100px" src="<?php  echo htmlspecialchars($product['img_src']); ?>" alt="Current Image" class="img-thumbnail mb-3">
                </div>
                <input type="file" id="product_img_src" name="product_img_src" class="form-control">
                <input type="hidden" name="current_img_src" value="<?php echo htmlspecialchars($product['img_src']); ?>">
            </div>
            <div class="mb-3">
                <label for="product_cat_id" class="form-label">Product Category ID</label>
                <input type="text" id="product_cat_id" name="product_cat_id" class="form-control" value="<?php echo htmlspecialchars($product['cat_id']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="product_availability" class="form-label">Product Availability</label>
                <input type="text" id="product_availability" name="product_availability" class="form-control" value="<?php echo htmlspecialchars($product['availability']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
