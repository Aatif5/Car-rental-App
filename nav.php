<?php

//STARTING THE SESSION
session_start();

//CONECTION TO DATABASE
$con=mysqli_connect("sql104.epizy.com","epiz_33436101","9lq2Nl4npZNB9L","epiz_33436101_carsrent") ;

//INPUT CLEANING FUNCTION
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="import" href="component.html">
    <title>Car Rent</title>

    <!--  BOOTSTRAP CDN LINKS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
      integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
      integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD"
      crossorigin="anonymous"
    ></script>

    <!-- FONT AWESOME FOR ICONS-->
    <script src="https://kit.fontawesome.com/418a9e9611.js" crossorigin="anonymous"></script>

    <!-- STYLE SHEETS -->
    <link rel="stylesheet" href="./style.css" />

  </head>
  <body class="bg-dark">
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><i class="fa-sharp fa-solid fa-car-side"></i> CarRent.com</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarText"
          aria-controls="navbarText"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="index.php"><i class="fa-sharp fa-solid fa-money-check-dollar"></i> Rent Cars</a>
            </li>
<?php
if(!isset($_SESSION['name'])){
// GUEST USERS (USERS NOT LOGGED IN)
?>
            <li class="nav-item">
              <a class="nav-link" href="login.php"><i class="fa-sharp fa-solid fa-right-to-bracket"></i> Login</a>
            </li>
            </ul>
<?php 
} 
else if($_SESSION['type']=='agency'){
// AGENCY USERS
?>
            <li class="nav-item">
              <a class="nav-link" href="ViewBookedCars.php"><i class="fa-sharp fa-solid fa-ticket"></i> Bookings</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="AddNewCars.php"><i class="fa-sharp fa-solid fa-plus"></i> Add Cars</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php"><i class="fa-sharp fa-solid fa-right-from-bracket"></i> Logout</a>
            </li>
            </ul>
            <b class="navbar-text"><i class="fa-sharp fa-solid fa-user"></i> <?php echo 'Agency: '.$_SESSION['name'];?></b>
<?php 
} 
else{
// CUSTOMERS
?>
            <li class="nav-item">
              <a class="nav-link" href="logout.php"><i class="fa-sharp fa-solid fa-right-from-bracket"></i> Logout</a>
            </li>
            </ul>
            <b class="navbar-text"><i class="fa-sharp fa-solid fa-user"></i> <?php echo 'Customer: '.$_SESSION['name'];?></b>
<?php 
}
?>
          
        </div>
      </div>
    </nav>