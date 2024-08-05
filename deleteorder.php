<?php
require_once 'connection.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];


if (isset($_GET['product_id']) && isset($_GET['order_id'])) {
    $product_id = (int)$_GET['product_id'];
    $order_id = (int)$_GET['order_id'];

    
    $query = "SELECT quantity FROM orders WHERE user_id = ? AND product_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->execute([$user_id, $product_id]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($order) {
        
        if ($order['quantity'] > 1) {
            $query = "UPDATE orders SET quantity = quantity - 1 WHERE user_id = ? AND product_id = ?";
            $stmt = $connection->prepare($query);
            $stmt->execute([$user_id, $product_id]);
        } else {
            
            $query = "DELETE FROM orders WHERE user_id = ? AND product_id = ?";
            $stmt = $connection->prepare($query);
            $stmt->execute([$user_id, $product_id]);
        }

       
        header("Location: my_orders.php");
        exit;
    } else {
        echo "Order not found.";
    }
} else {
    echo "Invalid request.";
}
?>
