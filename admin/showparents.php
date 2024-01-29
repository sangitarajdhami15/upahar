<?php
if(isset($_POST['updateParent']))
    {   
        $status=$_POST['status'];
        $update_id=$_POST['parent_id'];         
        $connection= new mysqli("localhost","root","","upahar");
        // Checking Database Connection
        if($connection->connect_errno!=0)
        // 0 means connected 
        {
            die("Database Connectivity Error");
        }
        $updatesql="UPDATE parent_profile SET status='$status' 
        WHERE profile_id='$update_id'";
        if($updateresult=$connection->query($updatesql))
        {
            header("Location:parentdetails.php");
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
    <title>Parents Details</title>
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
      <h1>Parents Records</h1>

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
    <div class="dash-content">
        <div class="activity">
            <div class="title">
                <i class="uil uil-clock-three"></i>
                <span class="text">Parent's Information</span> 
            </div>
        </div>
    </div>
    <table border='1' width="100%" align="center">
        <tr>
            <th style="width:1%">SN</th>
            <th style="width:5%">Title</th>
            <th style="width:10%">Information</th>
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
                $sql="SELECT * FROM parents p JOIN parent_profile pp ON p.email = pp.email where pp.profile_id='$id'";
                if($result=$connection->query($sql))
                {
                        foreach($result as $row){}
                }
                
        ?>
            <tr>
            <td>1</td>    
            <td>Mother Name</td>
            <td><?php echo($row['mother_name'])?></td>
            </tr>
            <tr>
            <td>2</td>    
            <td>Father Name</td>
            <td><?php echo($row['father_name'])?></td>
            </tr>  
            <tr>
            <td>3</td>    
            <td>Email</td>
            <td><?php echo($row['email'])?></td>
            </tr><tr>
            <td>4</td>    
            <td>phoneno</td>
            <td><?php echo($row['phoneno'])?></td>
            </tr><tr>
            <td>5</td>    
            <td>income</td>
            <td><?php echo($row['income'])?></td>
            </tr> <tr>
            <td>6</td>        
            <td>address</td>
            <td><?php echo($row['address'])?></td>
            </tr> <tr>
            <td>7</td>        
            <td>marriage_certificate</td>
            <td>
                <?php 
                $file = $row['marriage_certificate'];
                if ($row['marriage_certificate'] == '')
                {
                    echo('<span class="text"> No File Uploaded</span>');
                    
                }
                elseif(!$row['marriage_certificate'] == '')
                {
                    $file_path = '../uploads/' . $row['marriage_certificate'];
                    echo '<a href="' . $file_path . '" target="_blank">View</a>';
                    echo '</div>';
                }
                ?>
            </td>
            <tr>
            <td>8</td>        
            <td>citizenship_certificate</td>
            <td>
                <?php 
                $file = $row['citizenship_certificate'];
                if ($row['citizenship_certificate'] == '')
                {
                    echo('<span class="text"> No File Uploaded</span>');
                    
                }
                elseif(!$row['citizenship_certificate'] == '')
                {
                    $file_path = '../uploads/' . $row['citizenship_certificate'];
                    echo '<a href="' . $file_path . '" target="_blank">View</a>';
                    echo '</div>';
                }
                ?>
            </td><tr>
            <td>9</td>        
            <td>Verification</td>
            <td><?php echo($row['status'])?></td>
            </tr>
    </table>
            <div class="input-box address">
            <form action="showparents.php" method="post">
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
            <input type="hidden" name="parent_id" value="<?php echo($row['profile_id']);?>">
            <button type="submit" name="updateParent">Update</button>
            </form>    
        </div>
        <?php
            }
            else
            {
            echo("No Parent Selected");
            echo
            ("
            <a href='parentdetails.php'>Here is the list of Parents</a>
            <br><br>
            ");
            }
        ?>   
    </div>
    </main>
    <script src="dashboard.js"></script>
  </body>
</html>