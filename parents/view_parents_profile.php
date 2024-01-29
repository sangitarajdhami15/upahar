<?php
include("parentdashboard.php");
$connection = new mysqli("localhost","root","","upahar");
if($connection->connect_error!=0)
{
  die("Database Connectivity Error");
}
if (isset($_POST['register'])) {
    // Collect data from the form
    $email = $_POST['uemail'];

    // Check if a file was uploaded
    if ($_FILES['profile']['error'] === UPLOAD_ERR_OK) 
    {
        $file = $_FILES['profile'];
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];

        // Check file type
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png'];
        $file_info = finfo_open(FILEINFO_MIME_TYPE);
        $file_mime_type = finfo_file($file_info, $file_tmp);

        if (!in_array($file_mime_type, $allowed_types)) {
            echo "Only JPEG, JPG, and PNG files are allowed.";
            exit();
        }

       

        // Move the uploaded file to the desired directory
        $destination = "../uploads/" . $file_name; // Adjust the destination directory as needed
        move_uploaded_file($file_tmp, $destination);

        // SQL query to update the photo file name in the database
        $sql = "UPDATE parent_profile SET photo='$file_name' WHERE email='$email'";

        if (mysqli_query($connection, $sql) === TRUE) {
            echo "Profile photo updated successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
        }
    } 
    else {
        echo "Error uploading the profile photo.";
    }
}
?>
<style>
    /* Custom CSS for .cards */
.cards {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: space-between; /* Arrange the cards evenly */
    padding: 20px;
    margin-top: 20px; /* Adjust margin as needed */
}

/* Custom CSS for .card */
.card {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 45%; /* Adjust width to fit two cards per row */
    box-sizing: border-box; /* Ensure padding is included in the width */
    margin-bottom: 20px; /* Adjust margin as needed */
}

.card input {
    width: 100%; /* Make the input fields fill the card */
    padding: 10px;
    margin-bottom: 10px;
    box-sizing: border-box;
}

.card label {
    font-weight: bold;
}

.card button {
    background-color: #5581b7;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
}

.card button:hover {
    background-color: #335b91;
}

.card a {
    color: #5581b7;
    text-decoration: none;
    margin-left: 10px;
}

.card a:hover {
    text-decoration: underline;
}
table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }
</style>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Parent Dashboard</h1>
        
      </div>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Your Details</h1>
      </div>

<div>
      <table border='1' width="100%" align="center">
        <tr>
            <th style="width:1%">SN</th>
            <th style="width:15%">Title</th>
            <th style="width:25%">Information</th>
            <th style="width:5%">Photo</th>
        </tr>
        <?php
            
                
                $connection= new mysqli("localhost","root","","upahar");
                
                // Checking Database Connection
                if($connection->connect_errno!=0)
                // 0 means connected 
                {
                die("Database Connectivity Error");
                }
                $sql="SELECT * FROM parents NATURAL JOIN parent_profile where parent_profile.email='$email'";
                if($result=$connection->query($sql))
                {
                        foreach($result as $row){}
                }
                
        ?>
            <tr>
            <td>1</td>    
            <td>Your Registration</td>
            <td><?php echo($row['email'])?></td>
            <td rowspan="10"><?php if(($row['photo'])=='')
            {
                echo("<img src='../profile/img.png' name='photo'>");
            }
            else{
                echo ("<img name='photo' src='../uploads/" . $row['photo'] ."' witdth='100 px' height='100px'>");
            }
            ?></td>
            </tr>
            <tr>
            <td>2</td>    
            <td>Father Name</td>
            <td><?php echo($row['father_name'])?></td>
            </tr>  
            <tr>
            <td>3</td>    
            <td>Mother Name</td>
            <td><?php echo($row['mother_name'])?></td>
            </tr>
            <td>4</td>    
            <td>Gender</td>
            <td><?php echo($row['gender'])?></td>
            </tr>
            <td>5</td>    
            <td>Address</td>
            <td><?php echo($row['address'])?></td>
            </tr> 
            
            <td>6</td>    
            <td>Marriage certificate</td>
            <td>
    <?php 
    $file = $row['marriage_certificate'];
    if (empty($file)) {
        echo('<span class="text"> No File Uploaded</span>');
    } else {
        $file_path = '../uploads/' . $file;
        echo '<a href="' . $file_path . '" target="_blank">View</a>';
    }
    ?>
</td>
<tr>
<td>7</td>    
<td>Citizenship certificate</td>
<td>
    <?php 
    $file = $row['citizenship_certificate'];
    if (empty($file)) {
        echo('<span class="text"> No File Uploaded</span>');
    } else {
        $file_path = '../uploads/' . $file;
        echo '<a href="' . $file_path . '" target="_blank">View</a>';
    }
    ?>
</td>

            </tr>
            <tr>
            <td>8</td>    
            <td>Status</td>
            <td><?php echo($row['status'])?></td>
</tr>
    </table>
    <div class="cards">
    <div class="card">
        <form action="view_parents_profile.php" method="post" class="form" enctype="multipart/form-data">
            <div class="input-box">
                <label for="profile">Update your profile photo (JPEG, JPG, PNG, minimum size: 100x100 pixels)</label>
                <input type="file" id="profile" name="profile" accept=".jpeg, .jpg, .png" required />
                <input type="hidden" name="uemail" value="<?php echo $email;?>">
                <button type="submit" name="register">Submit</button>
            </div>
        </form>
    </div>
</div>
    </main>
  </div>
</div>
</body>
</html>
