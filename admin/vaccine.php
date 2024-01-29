<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
}
$row = $_SESSION['admin'];
$email = $row['email'];
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Health</title>
    <link rel="stylesheet" href="dashboard.css" />
    <link rel="stylesheet" href="../fontawesome/css/all.min.css" />
  </head>
  <body>
    <nav class="sidebar">
      <a href="dashboard.php" class="logo"> 
        <i class="fas fa-heartbeat"></i>UPAHAR</a><br><br>
                <div class="submenu-item">
                  <span>vaccines details</span></i><a href="vaccine.php"></a>
                </ul>
                </li>
</div>
    </nav>

    <nav class="navbar">
      <i class="fa-solid fa-bars" id="sidebar-close"></i>
    </nav>

    <main class="main">
      <br><br><br>
    <form action="">
      </form>

    <style>
    body {
        
        font-family: Arial, sans-serif;
    }
    h1 {
        text-align: center;
    }
    table {
        border-collapse: collapse;
        width: 90%;
        margin-top: 10px;
    }
    th, td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
    a .button-update {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 8px 12px;
        cursor: pointer;
        text-decoration: none;
        border-radius: 4px;
    }
    a .button-update:hover {
        background-color:#749BC2;
    }
</style>



</head>

<body>
    <h1>Health Program</h1>
    <div class="overlay hidden"></div>
    <a href="insert.php"><button>New</button></a>
    <table border='1' width="100%">
        <tr>
            <th>HID</th>
            <th>Time</th>
            <th>Notification</th>
            <th>Address</th>
            <th>vaccine_name</th>
            <th>Vacccination_date</th>
            <th>Prevention Against</th>
            <th>Site</th>
            <th>Status</th>
            <th>Action</th> 
          
            
        </tr>
        <?php
            $connection= new mysqli("localhost","root","","upahar");
            if($connection->connect_errno!=0){
                die("connection failed");
            }
            $sql = "SELECT * FROM health_program";
            if ($result = $connection->query($sql)) {
                while ($row = $result->fetch_assoc()) {

                    echo "
                        <tr>
                            <td>".$row['hid']."</td>
                            <td>".$row['time']."</td>
                            <td>".$row['notification']."</td>
                            <td>".$row['address']."</td>
                            <td>".$row['vaccine_name']."</td>
                            <td>".$row['vaccination_date']."</td>
                            <td>".$row['prevention_against']."</td>
                            <td>".$row['site']."</td>
                            <td>".$row['status']."</td>
                            <td>
                                <form action='update.php' method='post'>
                                    <input type='hidden' value='".$row['hid']."' name='vaccine_update'>
                                    <input type='submit' value='Update' name='update'>
                                </form>
                            
          
                        </tr>";
                }
            }
        ?>
    </table>
   
</body>
</html>