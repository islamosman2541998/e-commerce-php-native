<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>PHP</title>

   
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 

  
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <style>
  .navbar a {
    color: white;
    font-size: 15px;
    font-weight: bold;
  }
  .navbar,
  .navbar>.container{
    background-color: teal;
  }

  </style>
    

  </head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader" >
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="padding-0">
      <nav class="navbar navbar-expand-lg badge-dark ">
        <div class="container">
          <span class="navbar-brand" href="index.php"><h2> <em>cafataria</em></h2></span>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="index.php">All Products
                  <span class="sr-only">(current)</span>
                </a>
              </li> 
              <?php if($_SESSION['user_id'] == 1){
              echo '<li class="nav-item">
                <a class="nav-link" href="orders.php">Orders</a>
              </li> 
               <li class="nav-item">
                <a class="nav-link" href="checks.php">Checks</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="admin.php">Add Product</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="allproducts_admin.php">Edit Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="allusers.php">All Users</a>
              </li>';
              }
              ?>
              
              <li class="nav-item">
                <a class="nav-link" href="my_orders.php">My Orders</a>
              </li>
          
              <li class="nav-item">
                <a class="nav-link" href="login.php">Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>