<?php
if(isset($_POST['updateBirth']))
    {   
        $status=$_POST['status'];
        $update_id=$_POST['birth_id'];         
        $connection= new mysqli("localhost","root","","upahar");
        // Checking Database Connection
        if($connection->connect_errno!=0)
        // 0 means connected 
        {
            die("Database Connectivity Error");
        }
        $updatesql="UPDATE birth_records SET birth_verification_status='$status' 
        WHERE birth_id='$update_id'";
        if($updateresult=$connection->query($updatesql))
        {
            header("Location:birthrecords.php");
        } 
        else
        {
            echo("Error");
        }           
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Birth Details</title>
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
</head>

<body>

<section class="dashboard">
    <div class="top">
        <i class="uil uil-bars sidebar-toggle"></i>
        <img src="images/profile.jpg" alt="">
    </div>
    <div class="dash-content">
        <div class="activity">
            <div class="title">
                <i class="uil uil-clock-three"></i>
                <span class="text">Birth's Information</span> 
            </div>
        </div>
    </div>
    <table border='1' width="100%" align="center">
        <tr>
            <th style="width:1%">SN</th>
            <th style="width:5%">Title</th>
            <th style="width:10%">Information</th>
            <th style="width:10%">Parents Detail</th>
        </tr>
        <?php
             if(isset($_POST['show']))
            {
                $id=$_POST['show_id'];
                
                $connection= new mysqli("localhost","root","","upahar");
                
                // Checking Database Connection
                if($connection->connect_errno!=0)
                // 0 means connected 
                {
                die("Database Connectivity Error");
                }
                $sql = " SELECT 
                pp.mother_name, 
                pp.father_name, 
                br.gender, 
                br.birthdate, 
                br.birthtime, 
                br.weight, 
                br.birth_certificate,
                br.birth_verification_status,
                br.submitted_time,
                br.birth_id,
                br.profile_id
            FROM 
                parent_profile AS pp
            INNER JOIN 
                birth_records AS br 
            ON 
                pp.profile_id = br.profile_id
            WHERE br.birth_id='$id'";
                if($result=$connection->query($sql))
                {
                    foreach($result as $row){
                ?>
                    <tr>
                    <td>1</td>    
                    <td>Birth Date</td>
                    <td><?php echo($row['birthdate'])?></td>
                    <td rowspan="5">
             <?php
                        echo "MotherName:- ".$row['mother_name']."<br>";
                        echo "Father Name:- ".$row['father_name'];
                       
                        echo("
                        <form action='showparents.php' method='post'>
                        <input type='hidden' value='".$row['profile_id']."' name='show_id'>
                        <input type='submit' value = 'Show' name='show'>
                        </form>
                        ");
                        
             ?>

                    </td>
                    </tr>
                    <tr>
                    <td>2</td>    
                    <td>Birth Time </td>
                    <td><?php echo($row['birthtime'])?></td>
                    </tr>  
                    <tr>
                    <td>3</td>    
                    <td>Gender</td>
                    <td><?php echo($row['gender'])?></td>
                    </tr><tr>
                    <td>4</td>    
                    <td>Weight</td>
                    <td><?php echo($row['weight'])?></td>
                    </td></tr>
                    <tr>
                    <td>5</td>    
                    <td>Status</td>
                    <td><?php echo($row['birth_verification_status'])?></td>
                    </td></tr>
                    <tr>
                    <td>6</td>    
                    <td>Submission Time</td>
                    <td><?php echo($row['submitted_time'])?></td>
                    </td></tr>
                    <tr>
                    <td>7</td>        
                    <td>Birth_certificate</td>
                    <td>
                        <?php 
                        $file = $row['birth_certificate'];
                        if ($row['birth_certificate'] == '')
                        {
                            echo('<span class="text"> No File Uploaded</span>');
                            
                        }
                        else if(!$row['birth_certificate'] == '')
                        {
                            $file_path = '../uploads/' . $row['birth_certificate'];
                            echo '<a href="' . $file_path . '" target="_blank">View</a>';
                            echo '</div>';
                        }
                        ?>
                    </td>
                </tr>
            <?php }
                }
            }
                ?>
    </table>
            <div class="input-box address">
            <form action="showbirth.php" method="post">
            <label>Update Parent Status</label> <br> <br>
            <div class="column">
                <div class="select-box">
                    <select name="status" >
                    <option hidden>Update Status</option>
                        <option value="Rejected">Rejected</option>
                        <option value="Approved">Approved</option>
                    </select>
                </div>
            </div> <br> <br>
            <input type="hidden" name="birth_id" value="<?php echo($row['birth_id']);?>">
            <button type="submit" name="updateBirth">Update</button>
            </form>    
        </div>
           
    </div>
    </main>
    <script src="dashboard.js"></script>
  </body>
</html>