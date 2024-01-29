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
        $sql="SELECT * FROM parents NATURAL JOIN parent_profile WHERE email='$email' AND password='$password'";
        $result=$connection->query($sql);
        if($result->num_rows>0)
        {
          session_start();
          $row=$result->fetch_assoc();
          $_SESSION['parents']=$row;
          header("Location:parents/parents_profile.php");
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
<!---Coding By CodingLab | www.codinglabweb.com--->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!--<title>Registration Form in HTML CSS</title>-->
    <!---Custom CSS File--->
    <link rel="stylesheet" href="login.css" />
    <link rel="stylesheet" href="fontawesome/css/all.min.css"/>
  </head>

  <body>
    <section class="container">
      <header><a href="" class="logo"> 
        <i class="fas fa-heartbeat"></i></a>Parent Login Form</header>
      <form action="login.php" method="post" class="form" autocomplete="off">
        

        <div class="input-box">
          <label>Email Address</label>
          <input type="email" placeholder="Enter email address" name="email" required  autocomplete="off" required/>
        </div>

        
        <div class="input-box password"> 
        <label>Password</label>
          <div class="column">
            <input type="password" name="password" pattern="^.{10,}$" placeholder="Enter your password" required />
            <i class='bx bx-hide eye-icon'></i>
          </div>
        </div>
        

        <button type="submit" name="login">Login</button>
        <a href="register.php">New User?</a>
      </form>
    </section>
  </body>
</html>