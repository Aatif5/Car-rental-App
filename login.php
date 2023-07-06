<?php
// INCLUDE NAVBAR
include 'nav.php';

if (isset($_SESSION["name"]) and isset($_SESSION["type"])) {
  // REDIRECT TO HOME PAGE IF ALREADY LOGGED IN
  header('Location:index.php');
  die();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST)) {
  
  // USER AUTHENTICTION WITH LOGIN CREDENTIALS
  // SELF SUBMITED FORM
  $pass = test_input($_POST["pass"]);
  if(isset($_POST['customer'])){
    $mail = test_input($_POST["customer"]);
    $qr="SELECT * FROM `customers` WHERE `mail`='$mail'";
    $type='customer';
  }
  else if(isset($_POST['agency'])){
    $mail = test_input($_POST["agency"]);
    $qr="SELECT * FROM `agencies` WHERE `mail`='$mail'";
    $type='agency';
  }

  $res=mysqli_query($con,$qr);
  $dis=mysqli_fetch_assoc($res);
  // PASSWORD AUTHENTICATION
  if(isset($dis['password']) and sha1(sha1($pass))==$dis['password']){
    
    // SESSION CREATION
    $_SESSION['name']=$dis['name'];
    $_SESSION['mail']=$dis['mail'];
    $_SESSION['type']=$type;
    $_SESSION['mail']=$mail;
    if($type=='agency'){
      $_SESSION['id']=$dis['agency_id'];
      header('Location: AddNewCars.php');
      die();
    }
    else{
      $_SESSION['id']=$dis['customer_id'];
      header('Location: index.php');
      die();
    }
  }
  else {
    // SHOW INCORRECT DETAILS MESSAGE
   ?>
  <div class="container">
      <div class="row justify-content-md-center">
        <div class="alert alert-primary" role="alert">
          <i class="fa-sharp fa-solid fa-user-xmark"></i> Invalid Credentials or Incorrect Customer/Agency Tab switch.
        </div>
      </div>
    </div>
   <?php 
  }
}
?>
<style>

</style>
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-sm-6 login-tab">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            
            <li class="nav-item" role="presentation">
              <button
                class="nav-link active"
                id="home-tab"
                data-bs-toggle="tab"
                data-bs-target="#home-tab-pane"
                type="button"
                role="tab"
                aria-controls="home-tab-pane"
                aria-selected="true"
              >
              <i class="fa-sharp fa-solid fa-user-tie"></i>
                Customer
              </button>
            </li>

            <li class="nav-item" role="presentation">
              <button
                class="nav-link"
                id="profile-tab"
                data-bs-toggle="tab"
                data-bs-target="#profile-tab-pane"
                type="button"
                role="tab"
                aria-controls="profile-tab-pane"
                aria-selected="false"
              >
              <i class="fa-sharp fa-solid fa-building"></i>
                Car Agency
              </button>
            </li>
          </ul>

          <div class="tab-content" id="myTabContent">

            <div
              class="tab-pane fade show active"
              id="home-tab-pane"
              role="tabpanel"
              aria-labelledby="home-tab"
              tabindex="0"
            >

<!-- CUSTOMER LOGIN FORM -->
              <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                <div class="input-group mb-3">
                  <input
                    name="customer"
                    type="email"
                    class="form-control"
                    placeholder="Email"
                    aria-label="Example text with button addon"
                    aria-describedby="button-addon1"
                    required
                  />
                </div>

                <div class="input-group mb-3">
                  <input
                    name="pass"
                    type="password"
                    class="form-control"
                    placeholder="password"
                    aria-label="Example text with button addon"
                    aria-describedby="button-addon1"
                    required
                  />
                </div>

                <button type="submit" class="btn btn-primary"><i class="fa-sharp fa-solid fa-right-to-bracket"></i> Log in</button>
                <a class="btn btn-primary" href="CustomerRegistration.php"><i class="fa-sharp fa-solid fa-pen-to-square"></i> Register</a>
              </form>

            </div>

            <div
              class="tab-pane fade"
              id="profile-tab-pane"
              role="tabpanel"
              aria-labelledby="profile-tab"
              tabindex="0"
            >
<!-- AGENCY LOGIN FORM -->
              <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                
                <div class="input-group mb-3">
                  <input
                    name="agency"
                    type="email"
                    class="form-control"
                    placeholder="Email"
                    aria-label="Example text with button addon"
                    aria-describedby="button-addon1"
                    required
                  />
                </div>

                <div class="input-group mb-3">
                  <input
                    name="pass"
                    type="password"
                    class="form-control"
                    placeholder="password"
                    aria-label="Example text with button addon"
                    aria-describedby="button-addon1"
                    required
                  />
                </div>
                
                <button type="submit" class="btn btn-primary"><i class="fa-sharp fa-solid fa-right-to-bracket"></i> Log in</button>
                <a class="btn btn-primary" href="AgencyRegistration.php"><i class="fa-sharp fa-solid fa-pen-to-square"></i> Register</a>
              </form>

            </div>
          </div>
        </div>
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