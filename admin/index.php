<?php
    if(isset($_POST['login'])) 
    { 
        $email=$_POST['email']; 
        $password=md5($_POST['password']);
        $connection= new mysqli("localhost","root","","upahar");
        if($connection->connect_errno!=0)
        {
            die("Database Connectivity Error");
        }
        $sql="SELECT * FROM admin WHERE email='$email' AND password='$password'";
        $result=$connection->query($sql);
        if($result->num_rows>0)
        {
          session_start();
          $row=$result->fetch_assoc();
          $_SESSION['admin']=$row;
          header("Location:dashboard.php");
        }
        else
        {
          echo
            ("
              <script> 
                alert(' Wrong Email Or Password ');
              </script>
            ");
        }
    }
?>


<!DOCTYPE html>
<!-- Coding By CodingNepal - www.codingnepalweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page | CodingNepal</title>
    <link rel="stylesheet" href="adminlogin.css">
</head>
<body>
    <nav>
    
    </nav>
    <div class="form-wrapper">
        <h2>Sign In</h2>
        <form action="index.php" method="POST" auto-complete="off">
            <div class="form-control">
                <input type="email" name="email" id="email" placeholder="Email Address" value="<?php if(isset($_POST['login'])) {echo $email;} ?>" auto-complete="off" required/>
                
            </div>
            <div class="form-control">
                <input type="password" name="password" id="password" placeholder="Password" required/>
            </div>
            <button type="submit" name="login">Login</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>