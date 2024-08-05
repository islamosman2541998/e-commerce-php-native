<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    try {
        $query1 = "delete from orders
        WHERE user_id = $id";
        $stmt = $connection->prepare($query1);
        $stmt->execute();

        if ($stmt->execute()) {
            echo "CheckOut successfully.";
        } else {
            echo "Failed to CheckOut.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
$connection = null;
header("Location: checks.php");
exit;
?>