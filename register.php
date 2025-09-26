<?php
$error = "";
$insert = false;
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
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    if(!preg_match("/^[a-zA-Z]+$/", $name)){
        $error = "Name must contain only characters (A–Z or a–z).";
    }
    elseif(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{6,}$/", $pass)){
        $error = "Password must have 1 small, 1 capital, 1 number, 1 special char, min 6 length.";
    }
    else{
        $sql = "INSERT INTO `users`(`name`, `email`, `password`) VALUES ('$name','$email','$pass')";
        if(mysqli_query($con, $sql)){
            $insert = true;
        } else {
            $error = "Error: " . mysqli_error($con);
        }
    }

    $con->close();
}


    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <link rel="" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
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
        <h2>Register</h2>
        <?php if($error != "") { ?>
            <p style="color:red; text-align:center;"><?php echo $error; ?></p>
        <?php } elseif($insert) { ?>
            <p style="color:green; text-align:center;">Registration successful!</p>
        <?php } ?>
        <form action="register.php" method="post">
            <input type="text" name="name" placeholder="Enter Your Name" required />
            <input type="email" name="email" placeholder="Enter Your Email" required />
            <input type="password" name="password" placeholder="Enter Your Password" required />
            <button type="submit" name="submit">Submit</button>
            <p>Already have an account ? <a href="login.php">Login here</a></p>
        </form>
    </div>
</body>
</html>