<?php
if (isset($_POST['vaccine_edit'])) {
    // Other code...

    // Establish database connection
    $conn = new mysqli("localhost", "root", "", "upahar");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $time = $_POST['time'];
    $notification = $_POST['notification'];
    $address = $_POST['address'];
    $vaccine_name = $_POST['vaccine_name'];
    $vaccination_date = $_POST['vaccination_date'];
    $prevention_against = $_POST['prevention_against'];
    $status = $_POST['status'];
    $hid = $_POST['hid'];

    // Prepare the SQL statement with placeholders
    $sql = "UPDATE health_program SET time=?, notification=?, address=?, vaccine_name=?, vaccination_date=?, prevention_against=?, status=? WHERE hid=?";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param('sssssssi', $time, $notification, $address, $vaccine_name, $vaccination_date, $prevention_against, $status, $hid);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            header("location: update.php");
            exit();
        } else {
            echo "Error executing update statement: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    // Close connection
    $conn->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Page</title>
    <link rel="stylesheet" href="dashboard.css" />
    <link rel="stylesheet" href="../fontawesome/css/all.min.css" />

<style>
 /* Style for the modal */
 body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container-fluid {
            max-width: 500px;
            margin: 0 auto;
            padding: 5px;
        }

        .card {
            background-color: white;
            padding: 5px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 2px;
        }

        .modal {
            display: none;
            position: ;
            /* Add your desired position */
            z-index: 1;
            left: 0;
            top: 0;
            width: 50% !important;
            /* Adjust the width */
            height: 50% !important;
            /* Adjust the height */
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 10px;
            border: 1px solid #888;
            width: 50% !important;
            /* Adjust the width */
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        h1 {
            margin-top: 0;
        }

        form {
            margin-top: 5px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"] {
            width: calc(100% - 12px);
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            padding: 8px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        a button {
            padding: 8px 15px;
            /* Adjust the padding */
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }

        a button:hover {
            background-color: #1d7a33;
        }

        table {
            max-width: 100px;
            width: 50%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
            /* Adjust the border */
            padding: 2px;
            /* Adjust the padding */
            font-size: 5px;
            /* Adjust the font size */
            text-align: left;
        }
    </style>
</head>
<body>
    <form>
<nav class="sidebar">
    <a href="dashboard.php" class="logo"> 
      <i class="fas fa-heartbeat"></i>UPAHAR</a>

      <div class="menu-content">
        <ul class="menu-items">
        <li class="item">
            <a href="vaccine.php">
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
            <form action="update.php" method="post">
              <input type="submit" value="Logout" name="logout">
      </div>
    </nav>

    <!-- Modal -->
    <nav class="navbar">
      <i class="fa-solid fa-bars" id="sidebar-close"></i>
    </nav><br><br>
    <div class="container-fluid">
    <div class="card">
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
    </span>
    </div>
    </div>

    <?php
    if(isset($_POST['update']))
    {
        ?>
    
    <form action="update.php" method="POST">
    <?php
     $conn= new mysqli("localhost","root","","upahar");
    if($conn->connect_errno!=0)
    {
        die("connection failed");
    }
    $hid=$_POST['vaccine_update'];
    $sql="SELECT * FROM health_program where hid='$hid'";
            if($result = $conn->query($sql))
            { $row = $result->fetch_assoc();}
       
        ?>
        <fieldset> 

<br><br>
<legend>Update Vaccine Details</legend>
<label for="time">
    Time:- <input type="text" name="time" size="50" value="<?php echo $row['time']?>">
    </label> <br> <br>
<!-- Book Name Ends-->
<label for="notification">
    Notification:- <input type="text" name="notification"  size="50"value="<?php echo $row['notification']?>">
    </label> <br> <br>
    <label for="address">
    Address:- <input type="text" name="address" size="50" value="<?php echo $row['address']?>">
    </label> <br> <br>
<!-- Book Author Starts-->
    <label for="vaccine_name">
    Vaccine_name:- <input type="text" name="vaccine_name" value="<?php echo $row['vaccine_name']?>" size="50" >
    </label> <br> <br>
<!-- Book Author Ends-->

<!-- Book Price Starts-->
    <label for="vaccination_date">
    Vaccination_date:- <input type="text" name="vaccination_date" value="<?php echo $row['vaccination_date']?>" size="50" >
    </label> <br> <br>
<!-- Book Price Ends-->

<!-- Book Publication Starts-->
    <label for="prevention against">
    Prevention Against:- <input type="text" name="prevention_against" value="<?php echo $row['prevention_against']?>" size="50" >
    </label> <br> <br>

    <label for="dropdown">Status:</label>
     <select id="dropdown" name="status">
    <option value="vaccinated">Vaccinated</option>
    <option value="notvaccinated">Not Vaccinated</option>
</select>
<br><br>

<!-- Book Publication Ends-->

<input type="submit" value="Update" name="vaccine_edit">
<input type="hidden" name="hid" value="<?php echo $hid?>">
            <!-- Submit Button Ends--> <br> <br>

</fieldset>
        
</form>
    <?php
    }
    ?>
    <script src="script.js"></script>
</body>

</html>