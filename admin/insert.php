<?php
   
    $connection= new mysqli("localhost","root","","upahar");
    
        if($connection->connect_errno!=0)
        {
        die("<h1>404 Error Not Found</h1>");
        }

        else
        {
            if(isset($_POST['create']))
            {   
                // Storing Variables
                $time=$_POST['time'];
                $notification=$_POST['notification'];
                $address=$_POST['address'];
                $vaccine_name=$_POST['vaccine_name'];
                $vaccinatio_date=$_POST['vaccination_date'];
                $prevention_against=$_POST['prevention_against'];
        
    
                 
                $sql="INSERT INTO health_program(time, notification, address, vaccine_name, vaccination_date, prevention_against) VALUES ('$time','$notification','$address','$vaccine_name','$vaccination_date','$prevention_against')";
                if($result = $connection->query($sql))
                {
                    echo("Insertion Successful");
                }
                
                else
                {
               echo("Error");
                } 
            }
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
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container-fluid {
            max-width: 600px; 
            margin: 0 auto;
            padding: 20px;
        }
        .card {
            background-color: white;
            padding: 5px; 
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 2px;
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
            padding: 8px 15px; /* Adjust the padding */
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
    max-width: 500px; 
    width: 100%; 
    border-collapse: collapse;
    margin-top: 20px; 
}

table, th, td {
    border: 1px solid #ccc; /* Adjust the border */
    padding: 2px; /* Adjust the padding */
    font-size: 5px; /* Adjust the font size */
    text-align: left;
}

    </style>
</head>
<body>
<nav class="sidebar">
    <a href="dashboard.php" class="logo"> 
      <i class="fas fa-heartbeat"></i>UPAHAR</a>

      <div class="menu-content">
        <ul class="menu-items">
        <li class="item">
            <a href="insert.php">
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
            <form action="insert.php" method="post">
              <input type="submit" value="Logout" name="logout">
      </div>
    </nav>

    <nav class="navbar">
      <i class="fa-solid fa-bars" id="sidebar-close"></i>
    </nav><br><br>
<div class="container-fluid">
    <div class="card">
        <h1>Vaccine Details</h1>
        <div style="overflow-x:auto;">
            <section class="modal hidden">
                <div class="flex">
                </div>
                <form action="insert.php" method="POST">
                    <fieldset>
                    <br> 
            <legend>Insert Vaccine Details</legend>

            <!-- Book Name Starts-->
            <label for="time">
                Time:- <input type="text" name="time" id="time" size="50" >
                </label> <br> <br>
            <!-- Book Name Ends-->
            <label for="notification">
                Notification:- <input type="text" name="notification" id="notification" size="50" >
                </label> <br> <br>
                <label for="address">
                Address:- <input type="text" name="address" id="address" size="50" >
                </label> <br> <br>
            <!-- Book Author Starts-->
                <label for="when to vaccinate">
                vaccine_name:- <input type="text" name="vaccine_name" id="vaccine" size="50" >
                </label> <br> <br>
            <!-- Book Author Ends-->

            <!-- Book Price Starts-->
                <label for="vaccination">
                Vaccination_date:- <input type="text" name="vaccination_date" id="vaccination" size="50" >
                </label> <br> <br>
            <!-- Book Price Ends-->

            <!-- Book Publication Starts-->
                <label for="prevention against">
                Prevention Against:- <input type="text" name="prevention_against" id="prevention against" size="50" >
                </label> <br> <br>
            <!-- Book Publication Ends-->

            <!-- Submit Button-->
                <input type="submit" value="Create" name="create">
            <!-- Submit Button Ends--> <br> <br>
            
                    </fieldset>
                </form>
            </section>
        </div>
    </div>
</div>

</body>
</html>





