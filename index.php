<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="with=device-width, initial-scale=1.0">
    <title>Birth record and program management system</title>
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="fontawesome/css/all.min.css"/>
    <style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins',sans-serif;
  text-decoration: none;
}
body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

main {
    flex: 1; /* This will allow the main content to grow and push the footer to the bottom */
}
footer{
  width: 100%;
  position: ;
  bottom: 0;
  left: 0;
  background: #111;
}
footer .content{
  max-width: 1350px;
  margin: auto;
  padding: 20px;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}
footer .content p,a{
  color: #fff;
}
footer .content .box{
  width: 33%;
  transition: all 0.4s ease;
}
footer .content .topic{
  font-size: 22px;
  font-weight: 600;
  color: #fff;
  margin-bottom: 16px;

}
footer .content p{
  text-align: justify;
}
footer .content .lower .topic{
  margin: 24px 0 5px 0;
}
footer .content .lower i{
  padding-right: 16px;
}
footer .content .middle{
  padding-left: 80px;
}
footer .content .middle a{
  line-height: 32px;
}
footer .content .right input[type="text"]{
  height: 45px;
  width: 100%;
  outline: none;
  color: #d9d9d9;
  background: #000;
  border-radius: 5px;
  padding-left: 10px;
  font-size: 17px;
  border: 2px solid #222222;
}
footer .content .right input[type="submit"]{
  height: 42px;
  width: 100%;
  font-size: 12px;
  color: #d9d9d9;
  background:  #376fb3;
  outline: none;
  border-radius: 5px;
  letter-spacing: 1px;
  cursor: pointer;
  margin-top: 12px;
  transition: all 0.3s ease-in-out;
}
.content .right input[type="submit"]:hover{
  background: none;
  color:  #eb2f06;
}
footer .content .media-icons a{
  font-size: 16px;
  height: 45px;
  width: 45px;
  display: inline-block;
  text-align: center;
  line-height: 43px;
  border-radius: 5px;
  border: 2px solid #222222;
  margin: 30px 5px 0 0;
  transition: all 0.3s ease;
}
.content .media-icons a:hover{
  border-color: #eb2f06;
}
footer .bottom{
  width: 100%;
  text-align: right;
  color: #376fb3;
  padding: 0 40px 5px 0;
}
footer .bottom a{
  color: #eb2f06;
}
footer a{
  transition: all 0.3s ease;
}
footer a:hover{
  color: #eb2f06;
}
@media (max-width:1100px) {
  footer .content .middle{
    padding-left: 50px;
  }
}
@media (max-width:950px){
  footer .content .box{
    width: 50%;
  }
  .content .right{
    margin-top: 40px;
  }
}
@media (max-width:560px){
  footer{
    position: relative;
  }
  footer .content .box{
    width: 100%;
    margin-top: 30px;
  }
  footer .content .middle{
    padding-left: 0;
  }
}
        </style>
</head>
<body>
    <!-- Start Landing Page -->
    <section class="main" id="main">
    <div class="main">
        <a href="" class="logo"> <i class="fas fa-heartbeat"></i>UPAHAR</a>
        <div class="navbar">
                    
            <div class="menu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="login.php">Birth Register</a></li>
                    <li><a href="health.php">Health Programs</a></li>
                    <li><a href="register.php">Register</a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </div>
        </div>
        <div class="content">
            <h1>Stay Safe Stay Healthy<br><span>Take care of mothers and child</span></h1>
            <p class="par"><br></p>
        </section>
</div>
    
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>

    <footer>
   <div class="content">
     <div class="left box">
       <div class="upper">
         <div class="topic">About us</div>
         <img src="uploads/img1.jpg" alt="Description of the image">
         <p>Why do children get so many vaccinations? <br></p>
         <button class="cn"><a href="about.php">Read more....</a></button>
       </div>
       <div class="lower">
         <div class="topic">Contact us</div>
         <div class="phone">
          <i class="fas fa-phone-volume"></i>+977 98047 46822</a>
         </div>
         <div class="email">
          <i class="fas fa-envelope"></i>abc@gmail.com</a>
         </div>
       </div>
     </div>
     <div class="middle box">
       <div class="topic">Our Services</div>
       <li>Parents Registration</li>
       <li>Birth Registration</li>
       <li><a href="#">vaccinations</a></li>
     </div>
     <div class="right box">
       <div class="topic">Subscribe us</div>
       <form action="#">
         <input type="text" placeholder="Enter email address">
         <input type="submit" name="" value="Send">
         <div class="media-icons">
           <a href="#"><i class="fab fa-facebook-f"></i></a>
           <a href="#"><i class="fab fa-instagram"></i></a>
           <a href="#"><i class="fab fa-twitter"></i></a>
         </div>
       </form>
     </div>
   </div>
   <div class="bottom">
     <p>Copyright © 2023 <a href="#"></a> All rights reserved</p>
   </div>
 </footer>
</body>
</html>