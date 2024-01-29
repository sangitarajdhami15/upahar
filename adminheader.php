<?php
session_start();
if(!isset($_SESSION['admin']))
{
  header("Location:adminlogin.php");
}


if(isset($_POST['logout'])){
  session_destroy();
  header("Location:adminlogin.php");
}

?>
