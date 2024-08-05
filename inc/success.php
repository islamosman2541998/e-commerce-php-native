<?php
if (isset($_SESSION['success'])) {
    if (is_array($_SESSION['success'])) {
        foreach ($_SESSION['success'] as $message) {
            echo "<div class='alert alert-success'>" . htmlspecialchars($message) . "</div>";
        }
    } else {
        echo "<div class='alert alert-success'>" . htmlspecialchars($_SESSION['success']) . "</div>";
    }
    unset($_SESSION['success']);
}
?>


