<?php
  session_start(); 
  if(!isset($_SESSION['parents'])) 
  {
    header("Location:../index.php"); 
  }
  $row=$_SESSION['parents']; 
  $email=$row['email'];
  $profile_id=$row['profile_id'];
  
  if(isset($_POST['logout']))
  {
    session_destroy(); 
    header("Location:../index.php");  
  }
?>

<html>
  <head>
    <title>Dashboard </title>
       <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0-beta3/css/all.min.css">
    <!-- Custom styles for this template -->
    <link href="../mycss/dashboard.css" rel="stylesheet">
  </head>
  <style>
  .notification-icon {
    position: relative;
    cursor: pointer;
    margin-left: 10px; /* Adjust the margin as needed */
    }


.notification-badge {
    position: absolute;
    top: 0;
    background-color: red;
    color: white;
    border-radius: 50%;
    padding: 5px 5px;
    font-size: 12px;
}

</style>


  <body>
    
<header class="navbar navbar-light sticky-top bg-light flex-md-nowrap p-0 shadow"  style="background-color: #FFD580;">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="parentdashboard.php">
  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-heart-pulse" viewBox="0 0 16 16">
  <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053.918 3.995.78 5.323 1.508 7H.43c-2.128-5.697 4.165-8.83 7.394-5.857.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17c3.23-2.974 9.522.159 7.394 5.856h-1.078c.728-1.677.59-3.005.108-3.947C13.486.878 10.4.28 8.717 2.01L8 2.748ZM2.212 10h1.315C4.593 11.183 6.05 12.458 8 13.795c1.949-1.337 3.407-2.612 4.473-3.795h1.315c-1.265 1.566-3.14 3.25-5.788 5-2.648-1.75-4.523-3.434-5.788-5Z"/>
  <path d="M10.464 3.314a.5.5 0 0 0-.945.049L7.921 8.956 6.464 5.314a.5.5 0 0 0-.88-.091L3.732 8H.5a.5.5 0 0 0 0 1H4a.5.5 0 0 0 .416-.223l1.473-2.209 1.647 4.118a.5.5 0 0 0 .945-.049l1.598-5.593 1.457 3.642A.5.5 0 0 0 12 9h3.5a.5.5 0 0 0 0-1h-3.162l-1.874-4.686Z"/>
</svg></i>UPAHAR</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
        <div id="notification-badge" class="notification-badge" style="margin-left: 900px;">
            <i class="far fa-bell fa-2x"><a href="scheduled_notification.php"></i>
            <span id="notification-badge" class="notification-badge"></span>
        </div>
        <form action="parentdashboard.php" method="post">
            <input type="submit" value="Logout" name="logout" class="btn" style="margin-left: 1000px;">
        </form>
    </div>
</div>

</header>
<!-- Add this code inside your parent dashboard HTML -->
<!-- Your User Dashboard code -->
<script>
    const socket = new WebSocket('ws://your-websocket-server');

    socket.onmessage = function(event) {
        const data = JSON.parse(event.data);
        const message = data.message;
        // Display the notification to the user
        // You may use JavaScript to create a notification element and add it to the DOM
    };
</script>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
        <a class="nav-link active" aria-current="page" href="parents_profile.php">
              <span data-feather="home"></span>
              My profile
            </a>
            <a class="nav-link active" aria-current="page" href="view_parents_profile.php">
              <span data-feather="home"></span>
               <?php echo $email;?>
            </a>
            <a class="nav-link active" aria-current="page" href="birth_entry.php">
              <span data-feather="home"></span>
              Register Birth
            </a>
            <a class="nav-link active" aria-current="page" href="view_birth_records.php">
              <span data-feather="home"></span>
              View Birth Submission Details
            </a>
          </li>
        </ul>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </nav>