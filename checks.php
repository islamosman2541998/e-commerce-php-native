<?php
require_once 'connection.php';
require_once 'inc/header.php';
$query = "SELECT u.id , u.name, SUM(p.price*o.quantity) AS Total_Price
FROM users u JOIN 
orders o on u.id = o.user_id JOIN 
products p on o.product_id = p.id
GROUP BY u.name;";
$stmt = $connection->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
$results = null;
if (isset($_GET['search_query'])) {
    $search_query = $_GET['search_query'];
    $stmt = $connection->prepare(" SELECT u.id, u.name,SUM(p.price * o.quantity) AS Total_Price 
            FROM users u JOIN orders o ON u.id = o.user_id JOIN 
            products p ON o.product_id = p.id
            WHERE u.name LIKE :search_query
            GROUP BY u.id, u.name");
    $stmt->execute(['search_query' => '%' . $search_query . '%']);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<div class="container text-center">
    <h3 class="h1 my-4">CheckOuts</h3>
    <div class="my-5">
        <form method="GET" class="form d-flex justify-content-center gap-5 g-5" action="">
            <input type="text" class="form-control w-50 mx-4" name="search_query" placeholder="Search for users...">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
    <div>
        <table class="table table-stripe">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Total Price</th>
                    <th>CheckOut</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($results) {
                    foreach ($results as $result) {
                        echo "<tr><td>" . $result['name'] . "</td>
                        <td>" . $result['Total_Price'] . "</td>
                        <td><form method='POST' action='checkOut.php' style='display:inline;'>
                        <input type='hidden' name='id' value='" . $result['id'] . "'>
                        <button class='btn btn-danger' type='submit' onclick='return confirm(\"Are you sure you want to CheckOut?\");'>CheckOut</button>
                        </form></td></tr>";
                    }
                } else {
                    foreach ($users as $user) {
                        echo "<tr><td>" . $user['name'] . "</td>
                        <td>" . $user['Total_Price'] . "</td>
                        <td><form method='POST' action='checkOut.php' style='display:inline;'>
                        <input type='hidden' name='id' value='" . $user['id'] . "'>
                        <button class='btn btn-danger' type='submit' onclick='return confirm(\"Are you sure you want to CheckOut?\");'>CheckOut</button>
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