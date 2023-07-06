<?php 
include 'nav.php'; 

// REDIRECT GUEST USERS
if (isset($_SESSION["name"]) and isset($_SESSION["type"])) {
  header('Location:index.php');
  die();
}

// SHOW ERROR MESSAGES
if(isset($_GET['error']) and $_GET['error']==1){
?>
      <div class="container">
        <div class="alert alert-primary" role="alert">
          <i class="fa-sharp fa-solid fa-user-xmark"></i> Mail already in use, please Log in.
        </div>
      </div>
<?php
}

// SELF SUBMITED FORM
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST)) {

  // SANITIZE INPUT
  $name = test_input($_POST["name"]);
  $pass = test_input($_POST["pass"]);
  $mail = test_input($_POST["mail"]);
    
    // MAIL ASSOCIATION CHECK
    $qr="SELECT * FROM `customers` WHERE `mail`='$mail'";
    $res=mysqli_query($con,$qr);
    $dis=mysqli_fetch_assoc($res);
    if ($dis){
      // THROW ERROR MESSAGE
      header("Location: CustomerRegistration.php?error=1");
      die();
    }

    // PASSWORD ENCRYPTION
    $pass=sha1(sha1($pass));

    // REGISTER SUCCESSFULLY
    $qr="INSERT INTO `customers`(`name`, `password`, `mail`) VALUES ('$name','$pass','$mail')";
    $res=mysqli_query($con,$qr);

    // CREATE SESSION
    $_SESSION['name']=$name;
    $_SESSION['type']='customer';
    $_SESSION['mail']=$mail;
    $qr2="SELECT `customer_id` FROM customers WHERE mail='$mail' ";
    $res2=mysqli_query($con,$qr2);
    $dis2=mysqli_fetch_assoc($res2);
    $_SESSION['id']=$dis2['customer_id'];

    header("Location: index.php");
    die();
  }
?>
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-sm-12 text-center">
          <h3><i class="fa-sharp fa-solid fa-user-tie"></i> Customer registration</h3>
        </div>
        <div class="col-sm-6">

          <!-- REGISTRATION FORM -->
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="input-group mb-3">
              <input
                name='name'
                type="text"
                class="form-control"
                placeholder="Name"
                aria-label="Example text with button addon"
                aria-describedby="button-addon1"
                required
              />
            </div>
            <div class="input-group mb-3">
              <input
                name='mail'
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
                name='pass'
                type="password"
                class="form-control"
                placeholder="password"
                aria-label="Example text with button addon"
                aria-describedby="button-addon1"
                required
              />
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa-sharp fa-solid fa-pen-to-square"></i> Register</button>
            <a class="btn btn-primary" href="login.php"><i class="fa-sharp fa-solid fa-right-to-bracket"></i> Log in</a>
          </form>
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