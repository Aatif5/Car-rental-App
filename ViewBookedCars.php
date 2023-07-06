<?php 
include 'nav.php'; 

// REDIRECT NON AGENCY USERS
if (!isset($_SESSION["name"]) and !isset($_SESSION["type"]) or $_SESSION["type"]!='agency') {
  header('Location:index.php');
  die();
}

// FETCH BOOKINGS OF CARS OF AGENCY
$id=$_SESSION['id'];
$qr="SELECT * FROM bookings LEFT JOIN cars ON bookings.car_id = cars.car_id WHERE cars.agency_id='$id' ";
$res=mysqli_query($con,$qr);
?>
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
<?php
  // TO COUNT RECORDS
  $count=0;
  while($dis=mysqli_fetch_assoc($res)){
    $count++;
    $customer_id=$dis['customer_id'];
    $qr2="SELECT `name` FROM customers WHERE customer_id='$customer_id' ";
    $res2=mysqli_query($con,$qr2);
    $dis2=mysqli_fetch_assoc($res2);
?>
        <div class="col">
          <div class="card">
            <h5 class="card-header"><i class="fa-sharp fa-solid fa-id-card-clip"></i> Booking ID: <?php echo $dis['booking_id']; ?></h5>
            <div class="card-body">
              <p class="card-text"><i class="fa-sharp fa-solid fa-car"></i> Vehicle model: <?php echo $dis['model']; ?></p>
              <p class="card-text"><i class="fa-sharp fa-solid fa-id-badge"></i> Customer Name: <?php echo $dis2['name']; ?></p>
              <p class="card-text"><i class="fa-sharp fa-solid fa-address-card"></i> Vehicle Number: <?php echo $dis['number']; ?></p>
              <p class="card-text"><i class="fa-sharp fa-solid fa-money-check-dollar"></i> Rent per day: <?php echo $dis['rent']; ?></p>
              <p class="card-text"><i class="fa-sharp fa-solid fa-user"></i> Seating Capacity: <?php echo $dis['capacity']; ?></p>
              <p class="card-text"><i class="fa-sharp fa-solid fa-calendar-days"></i> Start Date: <?php echo $dis['from_date']; ?></p>
              <p class="card-text"><i class="fa-sharp fa-solid fa-calendar-week"></i> No of Days: <?php echo $dis['days']; ?></p>
            </div>
          </div>
        </div>
<?php
  }
  if($count==0){
    ?>
        <div class="container text-center"><h3>No Bookings available</h3><h1><i class="fa-sharp fa-solid fa-face-sad-tear"></i></h1></div>
    <?php
  }
?>
      </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"
    ></script>

  </body>
</html>
<?php
include 'footer.php';
?>