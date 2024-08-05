<?php
require_once 'connection.php';
require_once 'inc/header.php';



if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_order'])) {
    $query = "INSERT INTO orders (user_id, product_id, quantity, state, orderDate)
              SELECT user_id, product_id, COUNT(*), 'Pending', NOW() 
              FROM orders
              WHERE user_id = ?
              GROUP BY product_id";
    $stmt = $connection->prepare($query);
    $stmt->execute([$user_id]);

    $query = "DELETE FROM orders WHERE user_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->execute([$user_id]);

    header("Location: my_orders.php"); 
    exit;
}

$query = "SELECT products.name, products.price, orders.product_id, COUNT(orders.product_id) as quantity 
          FROM orders 
          JOIN products ON orders.product_id = products.id 
          WHERE orders.user_id = ?
          GROUP BY products.id";
$stmt = $connection->prepare($query);
$stmt->execute([$user_id]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_price = 0;
?>
<style>
        .table th, .table td {
            text-align: center;
        }
        .btn-sm {
            font-size: 0.8rem;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
    </style>
    <div class="container">
    <h1 class="my-5 text-center">My Orders</h1>
    <form method="POST" action="my_orders.php">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): 
                    $total_price += $order['price'] * $order['quantity'];
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($order['name']); ?></td>
                    <td><?php echo htmlspecialchars($order['price']); ?></td>
                    <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                    <td><?php echo htmlspecialchars($order['price'] * $order['quantity']); ?></td>
                    <td>
                        <a href="deleteorder.php?product_id=<?php echo htmlspecialchars($order['product_id']); ?>&order_id=<?php echo htmlspecialchars($order['product_id']); ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
        <h3 class="mx-3">Total Price: <?php echo htmlspecialchars($total_price); ?></h3>
        <button type="submit" name="confirm_order" class="btn btn-primary">Confirm Order</button>
        </div>
    </form>
    </div>
