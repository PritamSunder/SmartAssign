<?php
$conn=mysqli_connect("localhost","root","","classroom");
if(!$conn)
{
  echo 'Not connected to server';
}
if(!mysqli_select_db($conn,'classroom'))
{
  echo 'Database not selected';
}

if(count($_POST)>0)
{
$nm=$_POST["name"];
$snm=$_POST["surname"];
$dob=$_POST["dob"];
$em=$_POST["email"];
$pw=$_POST["psw"];
$rol=$_POST["role"];
$prn=$_POST["prn"];
$sql="INSERT INTO `reg`(`First Name`, `Last Name`, `DOB`, `email`, `password`, `role`, `prn`) VALUES ('$nm','$snm','$dob','$em','$pw','$rol','$prn')";
$run=mysqli_query($conn,$sql);
if(!$run)
{
  echo 'Not inserted';
  header("refresh:1; url=reg.php");
}
else {
  header("refresh:1; url=signin.php");
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
<title>Registration</title>
<style>
*{
  margin: 0px;
  padding: 0px;
  font-family: sans-serif;
}

#parent{
position: relative;
margin-bottom: 100px;
}
.form{
  position: absolute;
  width: 500px;
  height: 500px;
  margin-left: 350px;
  margin-top: 70px;
  border: 2px solid black;
  background-color: #b8c6db;
  background-image: linear-gradient(315deg, #b8c6db 0%, #f5f7fa 74%);
  border-radius: 20px;
  text-align: center;
}
.back{
background-color: #080064;
  margin-top: 30px;
  color: white;
  width:700px;
  height: 600px;
  margin-left: 500px;
  border-radius: 40px;

}

.back h2{
  margin-left: 230px;
  font-size: 40px;
  font-variant: small-caps;

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
    margin-left: 20px;
    width: 200px;
    padding-top: 4px;
    padding-bottom: 4px;
}
input[type="date"] {
    margin-left: 7px;
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
.alig{
  margin-left: 16px;
}
#right{
  margin-left: 380px;
}
.gap{
  margin-left: 30px;
}
.inputs{
padding: 20px;
}
.titl{
  padding: 20px;
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
  margin-bottom: -10px;

}
.registerbtn:hover {
	background-color:#5cbf2a;
}
.registerbtn:active {
	position:relative;
	top:1px;
}


</style>
</head>
<body>
<div id="parent">
<div class="form">
<form action="" method="post" autocomplete="off">
  <div class="container">
    <div class="titl">
    <h1>Registration</h1>
  </div>
    <hr>
    <div class="inputs">
    <label for="name"><b>First Name: </b></label>
    <input type="text" placeholder="Enter First name" name="name" id="name" required><br><br>

    <label for="name"><b>Last Name: </b></label>
    <input type="text" placeholder="Enter Last name" name="surname" id="surname" required><br>
    <br>
    <label for="dob"><b>Date of Birth: </b></label>
    <input type = "date" placeholder="Select Date" name="dob" id="dob" required>
    <br><br>

    <label for="email"><b>Email adress: </b></label>
    <input type="text" placeholder="Enter Email" name="email" id="email" style="margin-left:8px;" required><br><br>

    <label for="psw"><b>Password: </b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="psw" required>
    <br><br>
    <label for="prn"><b>PRN number: </b></label>
    <input type="text" placeholder="Enter PRN" name="prn" id="prn" style="margin-left:8px;" required><br><br>
    <label style="margin-right:25px;"><b>Role: </b></label>
    <input type="radio" id="teacher" name="role" value="teacher">
    <label for="teacher">Teacher</label>
    <input type="radio" id="student" name="role" value="student">
    <label for="student">Student</label><br><br>
    <button type="submit" class="registerbtn">Register</button>
</div>
  </div>
  <div class="container signin">
    <p>Already have an account? <a href="signin.php">Sign in</a>.</p>
  </div>
</form>
</div>
<div class="back">
  <br>
  <h2>Get Started</h2><br><br>
  <div id="right">
  <img src="images/login.gif" width="300px" height="270px">
  <h3 class="gap">Create a free Account</h3><br>
  <p class="gap">Access all features of SmartAssign<br> by completing registration</p>
  </div>
</div>
</div>
</body>
</html>
