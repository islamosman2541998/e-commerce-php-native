<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    try {
        $query1 = "update orders 
        set state = 'processing'
        WHERE id = $id";
        $stmt = $connection->prepare($query1);
        $stmt->execute();

        if ($stmt->execute()) {
            echo "Order delivered successfully.";
        } else {
            echo "Failed to deliver order.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$connection = null;
header("Location: orders.php");
exit;
?>