<?php
  session_start();

  if(!isset($_SESSION['email']))
  {
    header("Location: login.php");
    exit();
  }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="nav">
        <h1>WebPage</h1>
        <div class="nav-buttons">
          <a href="index.html">Home</a>
          <a href="logout.php">Logout</a>
        </div>
  </div>

  <div class="container">
    <h2>Welcome 
      <?php
        echo $_SESSION['email'];
      ?>
    </h2>
    <p style="text-align: center; font-size:18px; margin-top:10px;">You have successfully logged in.</p>
  </div>
</body>
</html>