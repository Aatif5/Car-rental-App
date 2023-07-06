<?php
session_start();

if (!isset($_SESSION["name"]) and !isset($_SESSION["type"]) or $_SESSION["type"]!='agency') {
          header('Location:index.php');
          die();
}

$car_id=$_GET['id'];
$con=mysqli_connect("sql104.epizy.com","epiz_33436101","9lq2Nl4npZNB9L","epiz_33436101_carsrent") ;
$qr="UPDATE `cars` SET `status`='booked' WHERE `car_id`='$car_id'";
$res=mysqli_query($con,$qr);
$customer_id=$_SESSION['id'];
$from=$_GET['from'];
$days=$_GET['days'];
$qr="INSERT INTO `bookings`(`customer_id`, `car_id`, `from_date`, `days`) VALUES ('$customer_id','$car_id','$from','$days')";
$res=mysqli_query($con,$qr);
echo "Booked";

?>