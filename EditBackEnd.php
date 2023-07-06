<?php
session_start();

if (!isset($_SESSION["name"]) and !isset($_SESSION["type"]) or $_SESSION["type"]!='agency') {
          header('Location:index.php');
          die();
}

function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }
        

$car_id=$_POST['id'];
// SANITIZE INPUT
$model = test_input($_POST["model"]);
$number = test_input($_POST["number"]);
$capacity = test_input($_POST["capacity"]);
$rent = test_input($_POST["rent"]);
$agency_id=$_SESSION['id'];

$con=mysqli_connect("sql104.epizy.com","epiz_33436101","9lq2Nl4npZNB9L","epiz_33436101_carsrent") ;
$qr="UPDATE `cars` SET `model`='$model', `number`='$number', `capacity`='$capacity', `rent`='$rent' WHERE `car_id`='$car_id'";
$res=mysqli_query($con,$qr);
if($res){
          header('Location:AddNewCars.php?edit=1');
          die();
}

?>