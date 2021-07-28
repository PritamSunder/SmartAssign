<!DOCTYPE html>
<html>
<link rel="stylesheet" href="css/ui.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
 <head>
  <title>Submission Portal</title>
  <style>
  ul{
    list-style-type: none;
  }
  *{
    margin:0px;
    padding: 0px;
  }
  </style>
  <script>
  $(document).ready(function(){
    $(".container").on('click', '.a', function () {
      $("#a1").css("display","block");
        $("#c1").css("display","none");
    });
    $(".container").on('click', '.c', function () {
      $("#c1").css("display","block");
        $("#a1").css("display","none");
    });
  });
  </script>
</head>
<body>

  <div class="home" id="home">
    <div class="header">
    <!--  <p style="text-align:center;font-size:70px;"> <span style="color:#004aad">S</span>mart<span style="color:#004aad">A</span>ssign</p>-->
      <img src="images/logo.png" height="50px" ><br>
    </div></div>

<div class="topnav">
  <ul>
  <a href="scripts/logout.php">Sign Out</a>
  <?php
  include 'scripts/connect.php';
  session_start();
  $name = $_SESSION["name"];
  echo "<p class='welcome'>Welcome ".$name."</p>";
  ?>
  </ul>
</div>
<div class="logo"> <img src="images/teacher.png" alt="logo" style="float:left;margin-left: 30px;width:150px;"></div>
<?php
if(!isset($_SESSION['email']))
{
    echo "login to your account";
    header("refresh:1;url=signin.php");
    exit();
}
?>

<div class="wholepage">

<div class="container">
    <ul>
    <li class="a"><a href="#">View posted assignments</a></li>
    <li class="c"><a href="#">post a new assignment</a></li>
    </ul>
</div>

<div class='assignpart'>
<section id ="a1">
<form action="tui.php" method="post" autocomplete="off">
  <label for="namesub"><b>Select a Subject: </b></label>
   <select id="namesub" name="namesub" required>
     <option value="" disabled selected>-</option>
     <option value="Advanced Algorithm">AA</option>
     <option value="Business Communication and Ethics">BCE</option>
     <option value="Computer Network">CN</option>
     <option value="Database Management System">DBMS</option>
     <option value="Microprocessor">MP</option>
     <option value="Multimedia System">MSD</option>
     <option value="Theory of Computer Science">TCS</option>
     <option value="Web Design Lab">WDL</option>
   </select>
   <br><br>
<label><b>Enter Assignment Name:</b></label>
<input type="text" placeholder="Aim" name=" name_entered" id="name_entered" required>
<br><br>
<label><b>Deadline:</b></label>
<input type = "date" placeholder="Select Date" name="date" id="datefield" required>
<br><br>
<input type="submit" name="submitbutton" value="Submit"/>
</form>
<?php
$uem=$_SESSION['email'];
if (isset($_POST['name_entered'])) {
    $nam = $_POST['name_entered'];
}
if (isset($_POST['namesub'])) {
    $sub = $_POST['namesub'];
}
$dat=" ";
if (isset($_POST['submitbutton'])){
  if (isset($_POST['date'])) {
    $dat = date('Y-m-d', strtotime($_POST['date']));
  }
  $dbh = new PDO("mysql:host=localhost;dbname=classroom","root","");
  $stmt = $dbh-> prepare("insert into assignment values('',?,?,?,?)");
  $stmt->bindParam(1,$nam);
  $stmt->bindParam(2,$dat);
  $stmt->bindParam(3,$uem);
  $stmt->bindParam(4,$sub);
  $stmt->execute();
    header("refresh:1;url=tui.php");

}



$dbh = new PDO("mysql:host=localhost;dbname=classroom","root","");
$sql = $dbh-> prepare("select * from assignment where teacher = ? order by subject");
$sql->bindParam(1,$uem);
$sql->execute();?></section>


<section id='c1'>
<p>Your Assignments:</p><br>
<ul><?php
$aa= array();
$bce= array();
$cn= array();
$dbms= array();
$mp= array();
$msd= array();
$tcs= array();
$wdl= array();
while($row = $sql->fetch()){

if($row['subject']=='Advanced Algorithm'){
array_push($aa,$row['id']);
}
elseif ($row['subject']=='Business Communication and Ethics') {
array_push($bce,$row['id']);
}
elseif ($row['subject']=='Computer Network') {
array_push($cn,$row['id']);
}
elseif ($row['subject']=='Database Management System') {
array_push($dbms,$row['id']);
}
elseif ($row['subject']=='Microprocessor') {
array_push($mp,$row['id']);
}
elseif ($row['subject']=='Multimedia System') {
array_push($msd,$row['id']);
}
elseif ($row['subject']=='Theory of Computer Science') {
array_push($tcs,$row['id']);
}
elseif ($row['subject']=='Web Design Lab') {
array_push($wdl,$row['id']);
}

/*echo "<div><li>".$row['aim']."<br>".$row['subject']."<br><a target ='_blank' href='scripts/remove.php?id=".$row['id']."'>Remove</a><br><br>"; ?>
<ul><li>
  <?php
  $stat = $dbh-> prepare("select * from storage where aim = ? and subject = ? and teacher = ?");
  $stat->bindParam(1,$row['aim']);
  $stat->bindParam(2,$row['subject']);
  $stat->bindParam(3,$row['teacher']);
  $stat->execute();
  while($row1= $stat->fetch()){

echo "<a target='_blank' href='scripts/assignment.php?id=".$row1['id']."'>".$row1['name']."</a>
</li></div><br>";
}echo "<br>;"*/
}
echo "<p>Subject: Advanced Algorithm<br></p>";
if(empty($aa)){
  echo "<p style='color:red;'>No Assignments Posted for this Subject!<p>";
}
foreach($aa as $item)
{
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  $row = $stati->fetch();
  echo "<li>".$row['aim']."<br>".$row['date']."<br><a href='scripts/remove.php?id=".$row['id']."'>Remove</a><br><br>"; ?>
    <ul><li>
      <?php
      $stat = $dbh-> prepare("select * from storage where aim = ? and subject = ? and teacher = ?");
      $stat->bindParam(1,$row['aim']);
      $stat->bindParam(2,$row['subject']);
      $stat->bindParam(3,$row['teacher']);
      $stat->execute();
      while($row1= $stat->fetch()){

        echo "<p>File: <a target='_blank' href='scripts/assignment.php?id=".$row1['id']."'>".$row1['name']."</a></p>
        </li><p>Submitted by: ".$row1['student']."<br>PRN: ".$row1['prn']."<br>Submitted On:".$row1['datesub']."<br>".$row1['status']."<br>";
        $stat = $dbh-> prepare("select * from grades where id = ?");
        $stat->bindParam(1,$row1['id']);
        $stat->execute();
        $row2= $stat->fetch();
        if(empty($row2)){
          echo"<a href='grade.php?id=".$row1['id']."'>Grade</a>";
        }
        else{
          echo"<p style='color:darkgreen;'><b>Graded</b></p>";
        }
    }
}
echo "<br><p>Subject: Business Communication and Ethics<br></p>";
if(empty($bce)){
  echo "<p style='color:red;'>No Assignments Posted for this Subject!<p>";
}
foreach($bce as $item)
{
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  $row = $stati->fetch();
  echo "<li>".$row['aim']."<br>".$row['date']."<br><a href='scripts/remove.php?id=".$row['id']."'>Remove</a><br><br>"; ?>
    <ul><li>
      <?php
      $stat = $dbh-> prepare("select * from storage where aim = ? and subject = ? and teacher = ?");
      $stat->bindParam(1,$row['aim']);
      $stat->bindParam(2,$row['subject']);
      $stat->bindParam(3,$row['teacher']);
      $stat->execute();
      while($row1= $stat->fetch()){

        echo "<p>File: <a target='_blank' href='scripts/assignment.php?id=".$row1['id']."'>".$row1['name']."</a></p>
        </li><p>Submitted by: ".$row1['student']."<br>PRN: ".$row1['prn']."<br>Submitted On:".$row1['datesub']."<br>".$row1['status']."<br>";
    }
}
echo "<br><p>Subject: Computer Network<br></p>";
if(empty($cn)){
  echo "<p style='color:red;'>No Assignments Posted for this Subject!<p>";
}
foreach($cn as $item)
{
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  $row = $stati->fetch();
  echo "<li>".$row['aim']."<br>".$row['date']."<br><a href='scripts/remove.php?id=".$row['id']."'>Remove</a><br><br>"; ?>
    <ul><li>
      <?php
      $stat = $dbh-> prepare("select * from storage where aim = ? and subject = ? and teacher = ?");
      $stat->bindParam(1,$row['aim']);
      $stat->bindParam(2,$row['subject']);
      $stat->bindParam(3,$row['teacher']);
      $stat->execute();
      while($row1= $stat->fetch()){

        echo "<p>File: <a target='_blank' href='scripts/assignment.php?id=".$row1['id']."'>".$row1['name']."</a></p>
        </li><p>Submitted by: ".$row1['student']."<br>PRN: ".$row1['prn']."<br>Submitted On:".$row1['datesub']."<br>".$row1['status']."<br>";
    }
}
echo "<br><p>Subject: Database Managaement System<br></p>";
if(empty($dbms)){
  echo "<p style='color:red;'>No Assignments Posted for this Subject!<p>";
}
foreach($dbms as $item)
{
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  $row = $stati->fetch();
  echo "<li>".$row['aim']."<br>".$row['date']."<br><a href='scripts/remove.php?id=".$row['id']."'>Remove</a><br><br>"; ?>
    <ul><li>
      <?php
      $stat = $dbh-> prepare("select * from storage where aim = ? and subject = ? and teacher = ?");
      $stat->bindParam(1,$row['aim']);
      $stat->bindParam(2,$row['subject']);
      $stat->bindParam(3,$row['teacher']);
      $stat->execute();
      while($row1= $stat->fetch()){

        echo "<p>File: <a target='_blank' href='scripts/assignment.php?id=".$row1['id']."'>".$row1['name']."</a></p>
        </li><p>Submitted by: ".$row1['student']."<br>PRN: ".$row1['prn']."<br>Submitted On:".$row1['datesub']."<br>".$row1['status']."<br>";
    }
}
echo "<br><p>Subject: Multiprocessor<br></p>";
if(empty($mp)){
  echo "<p style='color:red;'>No Assignments Posted for this Subject!<p>";
}
foreach($mp as $item)
{
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  $row = $stati->fetch();
  echo "<li>".$row['aim']."<br>".$row['date']."<br><a href='scripts/remove.php?id=".$row['id']."'>Remove</a><br><br>"; ?>
    <ul><li>
      <?php
      $stat = $dbh-> prepare("select * from storage where aim = ? and subject = ? and teacher = ?");
      $stat->bindParam(1,$row['aim']);
      $stat->bindParam(2,$row['subject']);
      $stat->bindParam(3,$row['teacher']);
      $stat->execute();
      while($row1= $stat->fetch()){

        echo "<p>File: <a target='_blank' href='scripts/assignment.php?id=".$row1['id']."'>".$row1['name']."</a></p>
        </li><p>Submitted by: ".$row1['student']."<br>PRN: ".$row1['prn']."<br>Submitted On:".$row1['datesub']."<br>".$row1['status']."><br>";
    }
}

echo "<br><p>Subject: Multimedia Systems<br></p>";
if(empty($msd)){
  echo "<p style='color:red;'>No Assignments Posted for this Subject!<p>";
}
foreach($msd as $item)
{
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  $row = $stati->fetch();
  echo "<li>".$row['aim']."<br>".$row['date']."<br><a href='scripts/remove.php?id=".$row['id']."'>Remove</a><br><br>"; ?>
    <ul><li>
      <?php
      $stat = $dbh-> prepare("select * from storage where aim = ? and subject = ? and teacher = ?");
      $stat->bindParam(1,$row['aim']);
      $stat->bindParam(2,$row['subject']);
      $stat->bindParam(3,$row['teacher']);
      $stat->execute();
      while($row1= $stat->fetch()){

        echo "<p>File: <a target='_blank' href='scripts/assignment.php?id=".$row1['id']."'>".$row1['name']."</a></p>
        </li><p>Submitted by: ".$row1['student']."<br>PRN: ".$row1['prn']."<br>Submitted On:".$row1['datesub']."<br>".$row1['status']."<br>";
    }
}
echo "<br><p>Subject: Theory of Computer Science<br></p>";
if(empty($tcs)){
  echo "<p style='color:red;'>No Assignments Posted for this Subject!<p>";
}
foreach($tcs as $item)
{
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  $row = $stati->fetch();
  echo "<li>".$row['aim']."<br>".$row['date']."<br><a href='scripts/remove.php?id=".$row['id']."'>Remove</a><br><br>"; ?>
    <ul><li>
      <?php
      $stat = $dbh-> prepare("select * from storage where aim = ? and subject = ? and teacher = ?");
      $stat->bindParam(1,$row['aim']);
      $stat->bindParam(2,$row['subject']);
      $stat->bindParam(3,$row['teacher']);
      $stat->execute();
      while($row1= $stat->fetch()){

        echo "<p>File: <a target='_blank' href='scripts/assignment.php?id=".$row1['id']."'>".$row1['name']."</a></p>
        </li><p>Submitted by: ".$row1['student']."<br>PRN: ".$row1['prn']."<br>Submitted On:".$row1['datesub']."<br>".$row1['status']."<br>";
    }
}
echo "<br><p>Subject: Web Design Lab<br></p>";
if(empty($wdl)){
  echo "<p style='color:red;'>No Assignments Posted for this Subject!<p>";
}
foreach($wdl as $item)
{
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  $row = $stati->fetch();
  echo "<li>".$row['aim']."<br>".$row['date']."<br><a href='scripts/remove.php?id=".$row['id']."'>Remove</a><br><br>"; ?>
    <ul><li>
      <?php
      $stat = $dbh-> prepare("select * from storage where aim = ? and subject = ? and teacher = ?");
      $stat->bindParam(1,$row['aim']);
      $stat->bindParam(2,$row['subject']);
      $stat->bindParam(3,$row['teacher']);
      $stat->execute();
      while($row1= $stat->fetch()){

        echo "<p>File: <a target='_blank' href='scripts/assignment.php?id=".$row1['id']."'>".$row1['name']."</a></p>
        </li><p>Submitted by: ".$row1['student']."<br>PRN: ".$row1['prn']."<br>Submitted On:".$row1['datesub']."<br>".$row1['status']."<br>";
    }
}
?>
</ul>
<section>
</div></div>
<script>
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();
 if(dd<10){
        dd='0'+dd
    }
    if(mm<10){
        mm='0'+mm
    }

today = yyyy+'-'+mm+'-'+dd;
document.getElementById("datefield").setAttribute("min", today);
</script>
</body>
</html>
