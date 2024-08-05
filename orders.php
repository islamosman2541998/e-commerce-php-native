<?php
require_once 'connection.php';
require_once 'inc/header.php';
$userQuery = "select * from users where cashier_id <> 0 ";
$userStmt = $connection->prepare($userQuery);
$userStmt->execute();
$users = $userStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container text-center">
    <h3 class="h1 my-4">All Orders</h3>
    <div>
        <table class="table table-stripe">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Order Date</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Deliver</th>
                    <th>Processing</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($users as $user) {
                    $ordersQuery = "SELECT products.name,orders.id,orders.state, products.price, 
                    orders.orderDate, orders.product_id, COUNT(orders.product_id) as quantity 
                    FROM orders 
                    JOIN products ON orders.product_id = products.id 
                    WHERE orders.user_id = ?
                    GROUP BY products.id";
                    $ordersStmt = $connection->prepare($ordersQuery);
                    $ordersStmt->execute([$user['id']]);
                    $orders = $ordersStmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($orders as $order) {
                        echo "<tr><td>" . $user['name'] . "</td>
                        <td>" . $order['name'] . "</td>
                        <td>" . $order['orderDate'] . "</td>
                        <td>" . $order['state'] . "</td>
                        <td>" . $order['quantity'] . "</td>
                        <td>" . $order["price"] * $order["quantity"] . "</td>
                        <td><form method='POST' action='deliver_order.php' style='display:inline;'>
                        <input type='hidden' name='id' value='" . $order['id'] . "'>
                        <button class='btn btn-success' type='submit' onclick='return confirm(\"Are you sure that this order has been delivered?\");'>Deliver</button>
                        </form></td>
                        <td><form method='POST' action='processing_order.php' style='display:inline;'>
                        <input type='hidden' name='id' value='" . $order['id'] . "'>
                        <button class='btn btn-danger' type='submit' onclick='return confirm(\"Are you sure that this order has not been delivered?\");'>Processing</button>
                        </form></td></tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php
require_once 'inc/footer.php';
?>