

 <?php
if (isset($_SESSION['errors']) && is_array($_SESSION['errors'])) {
   
    foreach ($_SESSION['errors'] as $error) {
        echo "<div class='errorMessage'>" . $error . "</div>";
        
    }
    
    unset($_SESSION['errors']); 
}
?> 



