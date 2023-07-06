<?php 
include 'nav.php'; 

// REDIRECT NON AGENCY USERS
if (!isset($_SESSION["name"]) and !isset($_SESSION["type"]) or $_SESSION["type"]!='agency') {
  header('Location:index.php');
  die();
}
if(isset($_GET['id'])){
          $car_id=$_GET['id'];
          // FETCH AVAILABLE CARS FROM DATABASE
          $qr="SELECT * FROM `cars` WHERE car_id='$car_id' ";
          $res=mysqli_query($con,$qr);
          $dis=mysqli_fetch_assoc($res);
?>
<div class="container">
          <div class="row justify-content-center">
                    <!-- CAR ADDITION FORM -->
                    <form method="post" action="EditBackEnd.php">
                              
                              <div class="input-group mb-3">
                              <input
                              name="model"
                              type="text"
                              class="form-control"
                              aria-label="Example text with button addon"
                              aria-describedby="button-addon1"
                              value="<?php echo $dis['model'];?>"
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
                              value="<?php echo $dis['number'];?>"
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
                              value="<?php echo $dis['capacity'];?>"
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
                              value="<?php echo $dis['rent'];?>"
                              required
                              />
                              </div>

                              <input type="hidden" name="id" value="<?php echo $car_id;?>">
                              <button type="submit" class="btn btn-primary"><i class="fa-sharp fa-solid fa-edit"></i> Edit</button>
                    </form>
          </div>
</div>
<?php
}
else{
  header('Location:index.php');
  die();
}
?>
        
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