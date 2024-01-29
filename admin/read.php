<?php
include('dashboard.php');?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Program</title>

    <style>
    body {
        font-family: Arial, sans-serif;
    }
    h1 {
        text-align: center;
    }
    table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 20px;
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
        background-color: #0056b3;
    }
    .deletebtn {
        background-color: #	#d50000;
    }
</style>



</head>

<body>
    <h1>Health Program</h1>
    <a href="insert.php"><button>New</button></a>
    <table border='1' width="100%">
        <tr>
            <th>HID</th><th>Time</th><th>Notification</th><th>Address</th><th>Vacccination</th><th>When to Vaccinate</th><th>Prevention Against</th><th>Action</th> 
        </tr>
        <?php
            $connection= new mysqli("localhost","root","","upahar");
            if($connection->connect_errno!=0){
                die("connection failed");
            }
        $sql="SELECT * FROM health_program";
        if($result = $connection->query($sql))
        {
            while($row = $result->fetch_assoc())
            {
                echo "
                 <tr>
           
                 <td>".$row['hid']."</td>
                 <td>".$row['time']."</td>
                 <td>".$row['notification']."</td>
                 <td>".$row['address']."</td>
                 <td>".$row['vaccination']."</td>
                
                 <td>".$row['when_to_vaccinate']."</td>
               
                <td>".$row['prevention_against']."</td> 
                  
                <td>
                <form action='update.php' method='post'>

               
                <input type='hidden' value='".$row['hid']."' name='vaccine_update'>

                <input type='submit' value = 'update' name='update'>
                </form> 
                <form action='delete.php' method='post'>
                <input type='hidden' value='".$row['hid']."'name='vaccine_delete'>

                <input type='submit'value = 'Delete' class='deletebtn' name='delete'>
                </form>  
                
                </td>           
                  </tr>
                ";
            }
        }

        ?>
    </table>
</body>
</html>