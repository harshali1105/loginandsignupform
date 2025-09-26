<?php

session_start();

  $login = false;
  $error = "";
if(isset($_POST['submit'])){ 
    $server = "127.0.0.1";
    $username = "root";
    $password = "";
    $database = "userdb";
    $port = 3307;

    $con = mysqli_connect($server, $username, $password, $database, $port);

    if(!$con){
        die("connection to this database failed due to ". mysqli_connect_error());
    }
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM `users` WHERE `email`='$email' and `password`='$password'";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) == 1){
        
      $_SESSION['email'] = $email;
      header("Location: welcome.php");
      exit();
    }
    else{
        $error  = "Invalid email or passoword";
    }

    $con->close();
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
  </head>
  <body>
    <div class="nav">
        <h1>WebPage</h1>
        <div class="nav-buttons">
          <a href="index.html">Home</a>
          <a href="javascript:history.back()">Back</a>
        </div>
    </div>
    <div class="container">
        <h2>Login</h2>
        <?php if($error != "") { ?>
  <p style="color:red; text-align:center;"><?php echo $error; ?></p>
<?php } ?>

        <form action="login.php" method="POST">
          <input type="email" id="email" name="email" placeholder="Enter Your Email" required />
          <input type="password" id="password" name="password" placeholder="Enter Your Password" required />
          <i class="fa-solid fa-eye" id="togglePassword" style="position:absolute; right:330px; top:51%; transform:translateY(-50%); cursor:pointer;"></i>
          <button type="submit" name="submit" class="btn">Submit</button>
          <p>Don't have an account ? <a href="register.php">Register here</a></p>
        </form>
    </div>

    <script>
        const toggle = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        toggle.addEventListener('click', function () 
        {
          const type = password.type === 'password' ? 'text' : 'password';
          password.type = type;
          this.classList.toggle('fa-eye-slash');
        });
</script>
  </body>
</html>
