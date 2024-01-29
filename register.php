<?php
    if(isset($_POST['register'])) 
    {
      $full_name=$_POST['full_name'];
      $email=$_POST['email'];
      $phoneno=$_POST['phoneno'];
      $address=$_POST['address'];
      $gender=$_POST['gender'];
      $password=md5($_POST['password']);


      $connection = new mysqli("localhost","root","","upahar");
      if($connection->connect_error!=0)
      {
        die("Database Connectivity Error");
      }
      $select="SELECT * FROM parents WHERE email='$email' AND phoneno='$phoneno'";
      $result=$connection->query($select);
      if($result->num_rows>0)
      {
        echo("<script> alert('User Already Exists or Please Try Again');</script>");
       
      }
      else
      {
        $sql="INSERT INTO parents(full_name,email,password,gender,phoneno,address) VALUES
      ('$full_name','$email','$password','$gender','$phoneno','$address')";
      $result=$connection->query($sql);
      if($result)
      {
        header("Location:login.php");
        if($gender=='Mother')
        {
        $profile="INSERT INTO parent_profile(email,mother_name) VALUES ('$email','$full_name')";
        }
        else if($gender=='Father')
        {
          $profile="INSERT INTO parent_profile(email,father_name) VALUES ('$email','$full_name')";
        }
      $r=$connection->query($profile);
      }
      else{
        echo("
        <script> alert('Please Try Again');</script>
        ");
      }
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
    <link rel="stylesheet" href="register.css" />
    <link rel="stylesheet" href="fontawesome/css/all.min.css"/>
  </head>
  <script>
      document.addEventListener("DOMContentLoaded", function() {
        var password = document.querySelector('input[name="password"]');
        var confirm = document.querySelector('input[name="confirm"]');
        var form = document.querySelector("form");

        form.addEventListener("submit", function(event) {
          if (password.value !== confirm.value) {
            event.preventDefault(); 
            showError("Password and confirm password do not match");
          }
        });

        function showError(message) {
          var errorContainer = document.createElement("div");
          errorContainer.classList.add("error-message");
          errorContainer.textContent = message;

          var existingError = document.querySelector(".error-message");
          if (existingError) {
            existingError.remove();
          }
          form.appendChild(errorContainer);
        }
      });
  </script>
  <body>
    <section class="container">
      <header><a href="" class="logo"> <i class="fas fa-heartbeat"></i></a>Parent Registration Form</header>
      <form action="register.php" method="post" class="form" autocomplete="off">
        <div class="input-box">
          <label>Full Name</label>
          <input type="text" placeholder="Enter full name" name="full_name" 
          pattern="^[A-Za-z\s]+$" value="<?php if(isset($_POST['register'])) {echo $full_name;} ?>" required />
        </div>

        <div class="input-box">
          <label>Email Address</label>
          <input type="email" placeholder="Enter email address" name="email" required  autocomplete="off" required/>
        </div>

        <div class="column">
          <div class="input-box">
            <label>Phone Number</label>
            <input type="text" placeholder="Enter phone number" name="phoneno" pattern="^\d{10}$"  autocomplete="off" required />
          </div>
        </div>
        <div class="gender-box">
          <h3>Gender</h3>
          <div class="gender-option">
          <div class="gender">
              <input type="radio" id="check-female" name="gender" value="Mother" />
              <label for="check-female">Mother</label>
            </div>
            <div class="gender">
              <input type="radio" id="check-male" name="gender" value="Father" checked />
              <label for="check-male">Father</label>
            </div>
          </div>
        </div>
        <div class="input-box password">
        <label>Password</label>
          <div class="column">
            <input type="password" name="password" pattern="^.{10,}$" placeholder="Minimum 10 Characters" required />
            <input type="password" name="confirm"  pattern="^.{10,}$" placeholder="Confirm Password" required />
            <div class="error-message" id="password-error"></div>
          </div>
        </div>
        
        <div class="input-box address">
          <label>Address</label>
          <input type="text" placeholder="Enter street address" value="<?php if(isset($_POST['register'])) {echo $address;} ?>"
          name="address" pattern="^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9\s]+$"" required />
        </div>

        <button type="submit" name="register">Register</button>
        <a href="login.php">Already Registered?</a>
      </form>
    </section>
  </body>
</html>