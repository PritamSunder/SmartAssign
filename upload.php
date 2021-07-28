<!DOCTYPE html>
<html>
 <head>
  <title>Submission Portal</title>
</head>
<style>
@import url("https://fonts.googleapis.com/css?family=Hind+Madurai:300,600|Poppins:300&display=swap");

body {
  background: linear-gradient(-45deg, #86A4FF, #D397FF, #81DEFF, #66FF96);
  background-size: 10000% 10000%;
  background-repeat: no-repeat;
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


  .mainform{
    background-color: white;
    position: fixed;
    top: 60px;
    left: 300px;
    border: 2px solid #001034;
    border-radius: 20px;
  }
  form{
    margin-left: 100px;
    margin-top: 50px;
    margin-bottom: 40px;
  }
  .filechoose{
    margin-top:-10px;
    margin-left: 10px;
    padding: 20px;
  }
  .btn{
    background-color: #222870;
    border-radius: 10px;
    border: none;
    color: white;
    padding: 10px 22px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 20px;
    cursor: pointer;
    -webkit-transition-duration: 0.3s; /* Safari */
    transition-duration: 0.3s;
    margin-top: 20px;
  }
  .btn:hover {
    box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
    background-color: #4C5AFF;
  }
  .cancel{
    background-color: #8B0000;
    border-radius: 10px;
    border: none;
    color: white;
    padding: 10px 22px;
    text-align: center;
    text-decoration: none;
    font-family: sans-serif;
    display: inline-block;
    font-size: 20px;
    margin-left: 60px;
    cursor: pointer;
    -webkit-transition-duration: 0.3s; /* Safari */
    transition-duration: 0.3s;
    margin-top: 20px;
  }
  .cancel:hover {
    box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
    background-color: #EF0000;
  }

</style>
<body>
<?php
include 'scripts/connect.php';
session_start();
if(!isset($_SESSION['email']))
{
    echo "login to your account";
    header("refresh:1;url=signin.php");
    exit();
}

$dbh = new PDO("mysql:host=localhost;dbname=classroom","root","");
$uem = $_SESSION['email'];
$prn = $_SESSION['prn'];
$id = isset($_GET['id'])?$_GET['id'] : "";
if(isset($_POST['btn']))
{
$stat = $dbh-> prepare("select * from assignment where id= ?");
$stat->bindParam(1,$id);
$stat->execute();
$row = $stat->fetch();
$name = $_FILES['myfile']['name'];
$type = $_FILES['myfile']['type'];
$data = file_get_contents($_FILES['myfile']['tmp_name']);
$teach = $row['teacher'];
$deadline = $row['date'];
$aim=$row['aim'];
$subject = $row['subject'];
$datesub = date("Y-m-d");
$status="";
if ($datesub > $deadline) {
    $status = "Turned in Late!";
  }
else{
  $status = "Submitted on Time";
}
$statq = $dbh-> prepare("insert into storage values('',?,?,?,?,?,?,?,?,?,?,?)");
$statq->bindParam(1,$name);
$statq->bindParam(2,$type);
$statq->bindParam(3,$data);
$statq->bindParam(4,$teach);
$statq->bindParam(5,$uem);
$statq->bindParam(6,$deadline);
$statq->bindParam(7,$aim);
$statq->bindParam(8,$subject);
$statq->bindParam(9,$prn);
$statq->bindParam(10,$datesub);
$statq->bindParam(11,$status);
$statq->execute();
header("refresh:1;url=sui.php");
}
//header("Location: " . $_SERVER["HTTP_REFERER"]);
?>
<img src="images/logo.png" height="60px" style="padding-left:550px; margin-top:-5px;" >
<section class="mainform">
<div style="margin-left:100px; margin-right:100px;">
  <h2>File Upload</h2>
  <p>Uploaded file will be submitted for the assignment selected.<br>The posted assignment can be deleted in the Student's Portal if required.<br>Please check the requirements of the file before uploading.</p>
<br>
<p>File Requirements</p>
<ul>
  <li>File size should not exceed 2MB.</li>
  <li>Files submitted must be image or pdf only.</li>
  <li>One file to be uploaded per Assignment.</li>
</ul>
</div>
<form method='POST' enctype='multipart/form-data'>
    <div style="border:1px dashed black; width: 500px;height:100px; padding-top:2px;margin-left:30px; margin-top: -20px;" >
    <?php
    $stat = $dbh-> prepare("select * from assignment where id= ?");
    $stat->bindParam(1,$id);
    $stat->execute();
    $row = $stat->fetch();
    echo "<p style='margin:1px;padding-left:30px'>Aim: ".$row['aim']."</p>";
    echo "<p style='margin:1px;padding-left:30px'>Deadline: ".$row['date']."</p>";
     ?>
    <input class="filechoose" type='file' name='myfile' required>
    </div>
    <br>
    <div style="margin-left:150px;">
    <button class='btn' name='btn'>Submit</button>
    <a class="cancel" href="sui.php">Cancel</a>
  </div>
</form>
</section>
</body>
</html>
