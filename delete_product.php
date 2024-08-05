<?php
require_once 'connection.php';

if (!isset($_GET['id'])) {
    echo "No product ID specified.";
    exit;
}

$product_id = $_GET['id'];

if (!is_numeric($product_id)) {
    echo "Invalid product ID.";
    exit;
}

try {
  
    $connection->beginTransaction();

 
    $deleteOrdersQuery = "DELETE FROM orders WHERE product_id = ?";
    $stmt = $connection->prepare($deleteOrdersQuery);
    $stmt->execute([$product_id]);

  
    $deleteProductQuery = "DELETE FROM products WHERE id = ?";
    $stmt = $connection->prepare($deleteProductQuery);
    $stmt->execute([$product_id]);

  
    $reorderQuery = "SET @i := 0; UPDATE products SET id = (@i := @i + 1) ORDER BY id;";
    $connection->exec($reorderQuery);

   
    $connection->commit();

    echo "Product and related orders deleted, and IDs reordered successfully.";
} catch (PDOException $e) {
  
    $connection->rollBack();
    echo "Failed to delete product: " . $e->getMessage();
}


header("Location: allproducts_admin.php");
exit;
?>
