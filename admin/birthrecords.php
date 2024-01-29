<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "upahar";

        // Create connection
        $connection = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // Sanitize input to prevent SQL injection
        $birthid = $connection->real_escape_string($_POST['birth_records']);

        // Prepare the SQL statement with a parameterized query
        $sql = "DELETE FROM birth_records WHERE birth_id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("s", $birth_id);

        if ($stmt->execute()) {
            // Redirect after successful deletion
            header("location: birthrecords.php");
            exit();
        } else {
            echo "Error deleting record: " . $connection->error;
        }

        $stmt->close();
        $connection->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Birth Records</title>
    <link rel="stylesheet" href="dashboard.css" />
    <link rel="stylesheet" href="../fontawesome/css/all.min.css" />
  </head>
  <body>
    <?php
    include('dashboard.php');
    ?>
    <main class="main">
      <br><br><br>
    <form action="">
      </form>
      
      <h1>Birth Records</h1>

    <style>
        .container{
            padding-top: 50px;
            padding-right: 30px;
            padding-bottom: 50px;
            padding-left: 80px;
            margin: 25px 50px 75px 100px;
        }
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
        padding:15px;
    }
    th, td {
        border: 1px solid #ccc;
        padding: 15px;
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
        background-color:#d50000;
    }
</style>

<body>
    <table class="table">
   

        <tr>
            <th>SN</th><th>Submission time</th>
            <th>Birth Date</th><th>Birth Time</th><th>Gender</th><th>Weight</th><th>Birth Certificate</th><th>Status</th><th>Action</th>  
        </tr>
        <?php
            $connection= new mysqli("localhost","root","","upahar");
            if($connection->connect_errno!=0){
                die("connection failed");
            }
        $sql="SELECT * FROM birth_records";
        if($result = $connection->query($sql))
        {
            while($row = $result->fetch_assoc())
            {
                if(!empty($row['birth_certificate']))
                {
                    $file_success="Uploaded";
                }
                else{
                    $file_success="No File Uploaded";
                }
                echo "
                 <tr>
                
                 <td>".$row['birth_id']."</td>
                 <td>{$row['submitted_time']}</td>
                 <td>".$row['birthdate']."</td>
                 <td>".$row['birthtime']."</td>
                 <td>".$row['gender']."</td>
                 <td>".$row['weight']."</td>
                 <td>".$file_success."</td>
                 <td>".$row['birth_verification_status']."</td>
                  
                <td>
                <form action='showbirth.php' method='post'>

               
                <input type='hidden' value='".$row['birth_id']."' name='show_id'>

                <input type='submit' value = 'show' name='show'>
                </form>  
                
                </td>           
                  </tr>
                ";
            }
        }

        ?>
    </table>
    </div>
</body>
</html>
    </main>

    <script src="dashboard.js"></script>
  </body>
</html>

