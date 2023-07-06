<?php 
include 'nav.php'; 
// FETCH AVAILABLE CARS FROM DATABASE
$qr="SELECT * FROM `cars` WHERE `status`='available'";
$res=mysqli_query($con,$qr);

?>
    <div class="container">
      <div id="success"></div>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
<?php
$count=0; // TO COUNT NO OF RECORDS
while($dis=mysqli_fetch_assoc($res)){
  $count++;
  // AVAILABLE CARS
?>
        <div class="col">
          <div class="card"> 
            <h5 class="card-header"><i class="fa-sharp fa-solid fa-car"></i> Vehicle model: <?php echo $dis['model']; ?></h5>
            <div class="card-body">
              <p class="card-text"><i class="fa-sharp fa-solid fa-money-check-dollar"></i> Rent per day: <?php echo $dis['rent']; ?></p>
              <p class="card-text"><i class="fa-sharp fa-solid fa-address-card"></i> Vehicle Number: <?php echo $dis['number']; ?></p>
              <p class="card-text"><i class="fa-sharp fa-solid fa-user"></i> seating capacity: <?php echo $dis['capacity']; ?></p>
  <?php
  if(isset($_SESSION['type']) and $_SESSION['type']=='customer'){
    // BOOK CAR FOR CUSTOMERS ONLY
  ?>
              <form onsubmit="rent(<?php echo $dis['car_id']; ?>)" id="<?php echo $dis['car_id']; ?>">
                <p>
                  <label for="from"><i class="fa-sharp fa-solid fa-calendar-days"></i> Start Date:</label>
                  <input type="date" id="from" name="from" min="<?php echo date('Y-m-d'); ?>" required>
                </p>
                <p>
                <label for="days"><i class="fa-sharp fa-solid fa-calendar-week"></i> No of Days:</label>
                  <select class="form-select" id="days" name="days" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                  </select>
                </p>
                <button type="submit" class="btn btn-primary" id="<?php echo $dis['car_id']; ?>">Rent car</button>
              </form>
<?php
  }
  elseif(!isset($_SESSION['type'])){
    // TO REDIRECT GUEST USERS
?>
                <a href="login.php" class="btn btn-primary"><i class="fa-sharp fa-solid fa-money-bill"></i> Rent car</a>
<?php
  }
?>
            </div>
          </div>
        </div>
<?php
}
if($count==0){
  ?>
        <div class="container text-center"><h3>No cars available</h3><h1><i class="fa-sharp fa-solid fa-face-sad-tear"></i></h1></div>
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

<script>
// AJAX
// FUNCTION TO SEND DATA TO DATABASE AND BOOK THE CAR VIA GET REQUEST
function rent(id) {
  var from = document.getElementById(id).elements.namedItem("from").value;
  var days = document.getElementById(id).elements.namedItem("days").value;
    if (id.length == 0) {
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             
              // successfull transaction
                alert('Booked Successfully');
                document.getElementById("success").innerHTML = '<div class="alert alert-primary" role="alert">'+this.responseText+'</div>';
            }
        };
        xmlhttp.open("GET", "back.php?id="+id+"&from="+from+"&days="+days, true);
        xmlhttp.send();
    }
}
</script>
<?php
include 'footer.php';
?>