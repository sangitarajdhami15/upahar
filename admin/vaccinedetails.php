<?php
  if(isset($_POST['vaccine_update']))
  {
    $hid=$_POST['hid'];
    $status=$_POST['status'];
    $connection = new mysqli("localhost", "root", "", "upahar");
    if ($connection->connect_errno != 0) {
        die("Connection failed");
    }
    $sql = "update  FROM health_program";
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Dashboard</title>
    <link rel="stylesheet" href="parentdashboard.css" />
    <link rel="stylesheet" href="../fontawesome/css/all.min.css" />
    <style>
        /* Your CSS styles here */
        body {

        margin:0;
        font-family: Arial, sans-serif;
    }

    .header{
        background-color:#fff;
        padding: 10px;
        text-align: center;
    }
    .container{
        display; flex;
        margin-left:-290px;
        justify-content: space-between;
        padding-left: 0px;
        width: 100%;
    }
    h1 {
        text-align: center;
    }
    table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 20px;
        background-color:#e7f2fd;
    }
    th, td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #e7f2fd;
    }


        .table-container th,
        .table-containet tr,
        .table-container td{
            border: 1px solid #ccc;
        padding: 20px;
        width: 100px; /* Adjust this value as needed */
        }
        .row {
            display: flex;
            flex-wrap: wrap;
        }
        .col {
           width:100px;
            flex: 5;
            box-sizing: border-box;
        }
        
    a .vaccine_done {
        background-color: #15b27b;
        color: white;
        border: none;
        padding: 8px 12px;
        cursor: pointer;
        text-decoration: none;
        border-radius: 4px;
    }
    a .vaccine_done:hover {
        background-color: #15b27b;
    }
    </style>
</head>
<body>
<div class="row">
        <header class="col">
            <i class="fas fa-heartbeat">UPAHAR</i>
            <h1>Parent Dashboard</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="button" value="Logout" name="logout" id="logout">
            </form>
        </header>
    </div>
    <div class="row">
        <div class="col">
            <main>
        <aside>
            <button id="sidebar-toggle" onclick="toggleSidebar()">☰</button>
            <nav>
                <ul>
                    <li><a href="vaccinedetails.php">Vaccines details</a></li>
                </ul>
            </nav>
        </aside>
    </main>
    </div>
        <div class="col" style='padding-right:80px;'>
        <h1>Health Program</h1><br>
        <div class="container">
    <div class="table-container">
    <table border='1' width="100%">
        <tr >
            <th>HID</th>
            <th>Time</th>
            <th>Notification</th>
            <th>Address</th>
            <th>Vacccination</th>
            <th>When to Vaccinate</th>
            <th>Prevention Against</th>
            <th >Action</th> 
            <th>Status</th> 
            
        </tr>
        <?php
        $connection = new mysqli("localhost", "root", "", "upahar");
        if ($connection->connect_errno != 0) {
            die("Connection failed");
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
                    <td>".$row['vaccination']."</td>
                    <td>".$row['when_to_vaccinate']."</td>
                    <td>".$row['prevention_against']."</td>
                    <td>".$row['status']."</td>
                    <td>
                    <form action='update.php' method='post'>
                    <input type='hidden' value='".$row['hid']."' name='vaccine_update'>
                    <input type='submit' value='Update' name='update'>
                </form> 
                        </form>
                    </td>           
                </tr>";
            }
        }
        ?>
    </table>
    </div>
    </div>
    </div>
    </div>
    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('aside');
            sidebar.classList.toggle('collapsed');
        }
    </script>
</body>
</html>
