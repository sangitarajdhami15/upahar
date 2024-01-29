<?php
  session_start(); 
  if(!isset($_SESSION['admin'])) 
  {
    header("Location:index.php"); 
  }
  $row=$_SESSION['admin']; 
  $email=$row['email']; 
  if(isset($_POST['logout']))
  {
    session_destroy(); 
    header("Location:index.php");  
  }
  $connection= new mysqli("localhost","root","","upahar");
            if($connection->connect_errno!=0){
                die("connection failed");
            }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sidebar Menu for Admin Dashboard | CodingNepal</title>
    <link rel="stylesheet" href="dashboard.css" />
    <link rel="stylesheet" href="../fontawesome/css/all.min.css" />
  </head>
  <body>
    <nav class="sidebar">
    <a href="dashboard.php" class="logo"> 
      <i class="fas fa-heartbeat"></i>UPAHAR</a>

      <div class="menu-content">
        <ul class="menu-items">
        <li class="item">
            <a href="">
              <?php 
                echo($email);
              ?>
            </a>
          </li>
          <li class="item">
            <div class="submenu-item">
            <i class="fa-sharp fa-solid fa-syringe"></i>
            <a href="vaccine.php">Health Programs</a>
            </div>
          <li class="item">
            <div class="submenu-item">
            <i class="fa-solid fa-book-medical"></i>
              <span>Records</span>
              <i class="fa-solid fa-chevron-right"></i>
            </div>

            <ul class="menu-items submenu">
              <div class="menu-title">
                <i class="fa-solid fa-chevron-left"></i>
                forms
              </div>
              <li class="item">
                <a href="birthrecords.php">Birth records</a>
              </li>
          <li class="item">
            <a href="parentdetails.php">Parents details</a>
          </li>
            </form>
          </li>  
        </ul>
        <li class="item">
            <form action="dashboard.php" method="post">
              <input type="submit" value="Logout" name="logout">
      </div>
    </nav>

    <nav class="navbar">
      <i class="fa-solid fa-bars" id="sidebar-close"></i>
    </nav>

    <script src="dashboard.js"></script>
  </body>
</html>