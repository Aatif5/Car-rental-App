<?php 
include 'nav.php'; 

// REDIRECT NON AGENCY USERS
if (!isset($_SESSION["name"]) and !isset($_SESSION["type"]) or $_SESSION["type"]!='agency') {
  header('Location:index.php');
  die();
}

if(isset($_GET['edit'])){
?>
    <div class="container">
      <div class="alert alert-primary" role="alert">
        <i class="fa-sharp fa-solid fa-check"></i> Edit Successful.
      </div>
    </div>
<?php
}

// SELF SUBMITED FORM
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST)) {

  // SANITIZE INPUT
  $model = test_input($_POST["model"]);
  $number = test_input($_POST["number"]);
  $capacity = test_input($_POST["capacity"]);
  $rent = test_input($_POST["rent"]);
  $agency_id=$_SESSION['id'];
  
  $qr="INSERT INTO `cars` (`model`, `number`, `capacity`, `rent`, `agency_id`) VALUES ('$model', '$number', '$capacity', '$rent', '$agency_id' )";
  $res=mysqli_query($con,$qr);
  
  if($res){
    ?>
    <div class="container">
      <div class="alert alert-primary" role="alert">
        <i class="fa-sharp fa-solid fa-check"></i> Car Added.
      </div>
    </div>
   <?php 
  }
  else{
    ?>
    <div class="container">
      <div class="alert alert-primary" role="alert">
          Failed to Add.
      </div>
    </div>
   <?php 
  }
}
?>
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-sm-12 text-center">
          <h3><i class="fa-sharp fa-solid fa-plus"></i> Add New Car</h3>
        </div>
        <div class="col-sm-6">

        <!-- CAR ADDITION FORM -->
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="input-group mb-3">
              <input
                name="model"
                type="text"
                class="form-control"
                placeholder="Model"
                aria-label="Example text with button addon"
                aria-describedby="button-addon1"
                required
              />
            </div>
            <div class="input-group mb-3">
              <input
                name="number"
                type="text"
                class="form-control"
                placeholder="Number"
                aria-label="Example text with button addon"
                aria-describedby="button-addon1"
                required
              />
            </div>
            <div class="input-group mb-3">
              <input
                name="capacity"
                type="number"
                class="form-control"
                placeholder="Capacity"
                min="2"
                max="12"
                aria-label="Example text with button addon"
                aria-describedby="button-addon1"
                required
              />
            </div>
            <div class="input-group mb-3">
              <input
                name="rent"
                type="number"
                class="form-control"
                placeholder="Rent"
                min="1"
                aria-label="Example text with button addon"
                aria-describedby="button-addon1"
                required
              />
            </div>

            <button type="submit" class="btn btn-primary"><i class="fa-sharp fa-solid fa-plus"></i> Add Car</button>
          </form>
        </div>
        <h3 class="text-center">Added Cars</h3>
      </div>
    </div>

<?php
// FETCH BOOKINGS OF CARS OF AGENCY
$id=$_SESSION['id'];
$qr="SELECT * FROM cars WHERE agency_id='$id' ";
$res=mysqli_query($con,$qr);
?>
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
<?php
  // TO COUNT RECORDS
  $count=0;
  while($dis=mysqli_fetch_assoc($res)){
    $count++;
?>
        <div class="col">
          <div class="card">
            <h5 class="card-header"><i class="fa-sharp fa-solid fa-id-card-clip"></i> Car ID: <?php echo $dis['car_id']; ?></h5>
            <div class="card-body">
              <p class="card-text"><i class="fa-sharp fa-solid fa-car"></i> Vehicle model: <?php echo $dis['model']; ?></p>
              <p class="card-text"><i class="fa-sharp fa-solid fa-address-card"></i> Vehicle Number: <?php echo $dis['number']; ?></p>
              <p class="card-text"><i class="fa-sharp fa-solid fa-money-check-dollar"></i> Rent per day: <?php echo $dis['rent']; ?></p>
              <p class="card-text"><i class="fa-sharp fa-solid fa-user"></i> Seating Capacity: <?php echo $dis['capacity']; ?></p>
              <p class="card-text"><a class="btn btn-primary" href="edit.php?id=<?php echo $dis['car_id']; ?>"><i class="fa-sharp fa-solid fa-edit"></i> Edit</a></p>
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