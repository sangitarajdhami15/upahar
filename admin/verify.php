<?php
// ... Your existing code ...
if(isset($_POST['details_verify']))
{
    $conn= new mysqli("localhost","root","","upahar");
    if($conn->connect_errno!=0)
    {
        die("connection failed");
    }
    $profile_id=$_POST['profile'];
    $father_name=$_POST['father_name'];
    $mother_name=$_POST['mother'];
    $phoneno=$_POST['phoneno'];
    $income=$_POST['income'];
    $address=$_POST['address'];
    $citizenship_certificate=$_POST['citizenship_certificate'];
    $marriage_certificate=$_POST['marriage_certificate'];

  $sql="UPDATE parent_profile SET father_name='$father_name', mother_name='$mother_name', phoneno='$phoneno', income='$income', address='$address', citizenship_certificate='$citizenship_certificate', marriage_certificate='$marriage_certificate'";
  if($result = $conn->query(sql))
   {
    echo("<script> alert('parents verified successfully');</script>");
    header("location:verify.php");
   }
    else{
        echo "Error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="dashboard.css" />
    <link rel="stylesheet" href="../fontawesome/css/all.min.css" />
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container-fluid {
            max-width: 400px; 
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
<body>
<div class="container-fluid">
    <div class="card">
        <h1>Parents Details</h1>
        <div style="overflow-x:auto;">
            <section class="modal hidden">
                <div class="flex">
                </div>
                <form action="verify.php" method="POST">
                    <fieldset>
                    <br> 
            <legend>update Details</legend>

            <!-- Book Name Starts-->
            <label for="father_name">
                Father Name:- <input type="text" name="father_name" id="name" size="50" >
                </label> <br> <br>
            <!-- Book Name Ends-->
            <label for="mother_name">
                Mother Name:- <input type="text" name="mother_name" id="name" size="50" >
                </label> <br> <br>
                <label for="phoneno">
                Phoneno:- <input type="text" name="phoneno" id="phoneno" size="50" >
                </label> <br> <br>
            <!-- Book Author Starts-->
                <label for="income">
                income:- <input type="text" name="income" id="income" size="50" >
                </label> <br> <br>
            <!-- Book Author Ends-->

            <!-- Book Price Starts-->
                <label for="address">
                Address:- <input type="text" name="address" id="address" size="50" >
                </label> <br> <br>
            <!-- Book Price Ends-->

            <!-- Book Publication Starts-->
                <label for="citizenship_certificate">
                Citizenship_Certificate:- <input type="text" name="citizenship_certificate" id="citizenship_certificate" size="50" >
                </label> <br> <br>
            <!-- Book Publication Ends-->

            <!-- Submit Button-->
                <input type="submit" value="Verify" name="verify">
            <!-- Submit Button Ends--> <br> <br>
            
                    </fieldset>
                </form>
            </section>
            <a href="verify.php"><button>Update and Delete</button></a>
        </div>
    </div>
</div>
    
</body>
</html>
