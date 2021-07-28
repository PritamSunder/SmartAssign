<?php

require 'scripts/connect.php';
session_start();

if(count($_POST)>0)
{

$uem=" ";
$upw=" ";
$uem=$_POST['email'];
$upw=$_POST['psw'];
$sql="SELECT * from `reg` WHERE `email`='$uem' AND `password`='$upw' ";
//$sql="SELECT * from `reg` WHERE `email`=".$_POST['email']." AND `password`=".$_POST['psw']." ";
$run = mysqli_query($conn,$sql);
$row = mysqli_num_rows($run);
$rw=mysqli_fetch_array($run);
if(is_array($rw)){
$_SESSION["name"]=$rw["First Name"];
$_SESSION["surname"]=$rw["Last Name"];
$_SESSION["dob"]=$rw["DOB"];
$_SESSION["email"]=$rw["email"];
$_SESSION["password"]=$rw["password"];
$_SESSION["role"]=$rw["role"];
$_SESSION["prn"]=$rw["prn"];
}
else {
  echo "fetch unsuccessful";
}

if (empty($uem) || empty($upw))
{
  echo 'fields cannot be empty';
  header("refresh:2;url=signin.php");
}
else if($row<1){
echo 'username or password is wrong';
header("refresh:2;url=signin.php");
}
else{
if($_SESSION['role'] == 'teacher')
{
header("refresh:1;url=tui.php");
}
else {
  header("refresh:1;url=sui.php");

}
}
}



?>
<!DOCTYPE html>
<html>
<head>
  <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
  <link rel="manifest" href="images/site.webmanifest">
  <title>Sign In</title>
  <style>
  .form{
    position: absolute;
    width: 500px;
    height: 400px;
    margin-left: 450px;
    margin-top: 70px;
    border: 2px solid black;
    background-color: #b8c6db;
    background-image: linear-gradient(315deg, #b8c6db 0%, #f5f7fa 74%);
    border-radius: 20px;
    text-align: center;
  }
  .registerbtn {
  	background-color:#44c767;
  	border:1px solid #18ab29;
  	display:inline-block;
  	cursor:pointer;
  	color:#ffffff;
  	font-family:Arial;
  	font-size:15px;
  	padding:8px 28px;
  	text-decoration:none;
  	text-shadow:0px 1px 0px #2f6627;
    margin-bottom: 10px;

  }
  .registerbtn:hover {
  	background-color:#5cbf2a;
  }
  .registerbtn:active {
  	position:relative;
  	top:1px;
  }
  body {
    background: linear-gradient(-45deg, #86A4FF, #D397FF, #81DEFF, #66FF96);
  	background-size: 400% 400%;
    font-family: "Poppins", sans-serif;
  	animation: gradient 15s ease infinite;
  }

  @keyframes gradient {
  	0% {
  		background-position: 0% 50%;
  	}
  	50% {
  		background-position: 100% 50%;
  	}
  	100% {
  		background-position: 0% 50%;
  	}
  }


input[type="text"] {
    margin-left: 60px;
    width: 200px;
    padding-top: 4px;
    padding-bottom: 4px;
}

input[type="password"] {
    margin-left: 27px;
    width: 200px;
    padding-top: 4px;
    padding-bottom: 4px;
}
.containersignin a{
  text-decoration: none;
}
  </style>
</head>
<body>
<div class="form">
<form action="" method="post" autocomplete="off">
  <div class="container">
    <h1>Sign In</h1>
    <p>Fill in the details to sign in.</p>
    <hr><br><br>
    <label for="email"><b>Email: </b></label>
    <input type="text" placeholder="Enter Email" name="email" id="email" required><br><br>

    <label for="psw"><b>Password: </b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="psw" required><br><br>


    <button type="submit" class="registerbtn">Sign in</button>
  </div>
  <div class="containersignin">
    <p>Don't have an account? <a href="reg.php">Sign Up</a>.</p>
    <p><a href="contact_us.html">Forgot password?</a></p>
  </div>
</form>
</div>
</body>
</html>
