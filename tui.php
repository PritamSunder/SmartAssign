<!DOCTYPE html>
<html>
<link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
<link rel="manifest" href="images/site.webmanifest">
<link rel="stylesheet" href="css/ui.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
 <head>
  <title>Teacher's Portal</title>
  <style>
  ul{
    list-style-type: none;
  }
  *{
    margin:0px;
    padding: 0px;
  }
  input[type="text"] {
    margin-left:10px;
      width: 150px;
      padding-top: 4px;
      padding-bottom: 4px;
  }
.sel{
  margin-left:10px;
  width:80px;
  height: 30px;
}
input[type="date"]{
  margin-left: 10px;
  width: 150px;
  padding-top: 4px;
  padding-bottom: 4px;
}

  </style>
  <script>
  $(document).ready(function(){
    $(".container").on('click', '.a', function () {
      $("#a1").css("display","block");
      $("#b1").css("display","none");
      $("#c1").css("display","none");
      $("#d1").css("display","none");
          $("li.a").css("background-color","#4C5AFF");
          $("li.b").css("background-color","#303AA6");
          $("li.c").css("background-color","#303AA6");
          $("li.d").css("background-color","#303AA6");
    });
    $(".container").on('click', '.b', function () {
      $("#b1").css("display","block");
      $("#c1").css("display","none");
      $("#a1").css("display","none");
      $("#d1").css("display","none");
          $("li.b").css("background-color","#4C5AFF");
          $("li.a").css("background-color","#303AA6");
          $("li.c").css("background-color","#303AA6");
          $("li.d").css("background-color","#303AA6");
    });
    $(".container").on('click', '.c', function () {
      $("#c1").css("display","block");
      $("#b1").css("display","none");
      $("#a1").css("display","none");
      $("#d1").css("display","none");
          $("li.c").css("background-color","#4C5AFF");
          $("li.b").css("background-color","#303AA6");
          $("li.a").css("background-color","#303AA6");
          $("li.d").css("background-color","#303AA6");
    });
    $(".container").on('click', '.d', function () {
      $("#d1").css("display","block");
      $("#b1").css("display","none");
      $("#c1").css("display","none");
      $("#a1").css("display","none");
          $("li.d").css("background-color","#4C5AFF");
          $("li.b").css("background-color","#303AA6");
          $("li.c").css("background-color","#303AA6");
          $("li.a").css("background-color","#303AA6");
    });
  });
  </script>
</head>
<body>

  <div class="home" id="home">
    <div class="header">
    <!--  <p style="text-align:center;font-size:70px;"> <span style="color:#004aad">S</span>mart<span style="color:#004aad">A</span>ssign</p>-->
      <img src="images/logo.png" height="60px" ><br>
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
<div class="full-table">
  <div class="clock">
    <div class="time" id="hour"></div>
    <div class="colon">:</div>
    <div class="time" id="min"></div>
    <div class="colon">:</div>
    <div class="time" id="sec"></div>

  </div><br>
      <div class="date" id="date"></div>
</div>

<div class="wholepage">

  <div class="container">
      <ul>
      <li class="a" style="background-color:#4C5AFF"><a href="#">View</a></li>
      <li class="b"><a href="#">Post</a></li>
      <li class="c"><a href="#">Compiler</a></li>
      <li class="d"><a href="#">History</a></li>
      </ul>
  </div>

<div class='assignpart'>
<section id ="b1">
  <p class='section_heading'>Post Assignment</p><hr><br>
<form action="tui.php" method="post">
  <label for="namesub"><b>Subject: </b></label>
   <select class="sel" id="namesub" name="namesub" required>
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
<label style="padding-left: 30px;"><b>Assignment Name: </b></label>
<input type="text" placeholder="Aim" name=" name_entered" id="name_entered" required>
<label style="padding-left: 30px;"><b>Deadline: </b></label>
<input type = "date" placeholder="Select Date" name="date" id="datefield" required>
<input type="submit" class="upl" style="margin-left:330px; margin-top: 50px;" name="submitbutton" value="Assign"/>
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
  echo "<script>window.location.href='tui.php'</script>";
}



$dbh = new PDO("mysql:host=localhost;dbname=classroom","root","");
$sql = $dbh-> prepare("select * from assignment where teacher = ? order by subject");
$sql->bindParam(1,$uem);
$sql->execute();?></section>


<section id='a1'>
<p class='section_heading'>Your Assignments:</p><hr><br>
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

}
echo "<p class='sub_name'>Advanced Algorithm<br></p>";
if(empty($aa)){
  echo "<p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Posted for this Subject!<p><hr>";
}
foreach($aa as $item)
{
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  $row = $stati->fetch();
  echo "<div class='exp_heading'><div class='aim'>".$row['aim']."</div><div class='deadline'>Deadline: ".$row['date']."</div><div class='stats'><a class ='stats_btn' href='scripts/stats.php?id=".$row['aim']."'><i class='fas fa-chart-pie'></i></a></div><div class='remove'><a class='remove_btn' href='scripts/remove.php?id=".$row['id']."'><i class='fas fa-trash'></i></a></div></div><br><hr>";
      $stat = $dbh-> prepare("select * from storage where aim = ? and subject = ? and teacher = ?");
      $stat->bindParam(1,$row['aim']);
      $stat->bindParam(2,$row['subject']);
      $stat->bindParam(3,$row['teacher']);
      $stat->execute();
      while($row1= $stat->fetch()){

        echo "<div class='individual'><div class='info'><p><b>File:‎‎ ‎‎‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎</b><a target='_blank' href='scripts/assignment.php?id=".$row1['id']."'>".$row1['name']."</a></p>
        <p><b>Submitted by:  ‎  ‎ </b>".$row1['student']."<br><b>PRN:  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎ ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎</b>".$row1['prn']."<br><b>Submitted On:  ‎ </b>".$row1['datesub']."</p></div><div class='upldel' style='margin-top:-15px;'><p><br>".$row1['status']."<br>";
        $grade = $dbh-> prepare("select * from grades where id = ?");
        $grade->bindParam(1,$row1['id']);
        $grade->execute();
        $row2= $grade->fetch();
        echo "<a class='p_d' target='_blank' href='scripts/detection.php?id=".$row1['id']."'>Scan</a><br>";
        if(empty($row2)){
          echo"<a class='grade' href='grade.php?id=".$row1['id']."'>Grade </a>";
        }
        else{
          echo"<p style='color: seagreen;'><b>Graded: ".$row2['grade']."/10 </b></p>";
        }
        echo "</div></div>";

        echo "<hr>";
  }
}

echo "<br><p class='sub_name'>Business Communication and Ethics<br></p>";
if(empty($bce)){
  echo "<p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Posted for this Subject!<p><hr>";
}
foreach($bce as $item)
{
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  $row = $stati->fetch();
  echo "<div class='exp_heading'><div class='aim'>".$row['aim']."</div><div class='deadline'>Deadline: ".$row['date']."</div><div class='stats'><a class ='stats_btn' href='scripts/stats.php?id=".$row['aim']."'><i class='fas fa-chart-pie'></i></a></div><div class='remove'><a class='remove_btn' href='scripts/remove.php?id=".$row['id']."'><i class='fas fa-trash'></i></a></div></div><br><hr>";
      $stat = $dbh-> prepare("select * from storage where aim = ? and subject = ? and teacher = ?");
      $stat->bindParam(1,$row['aim']);
      $stat->bindParam(2,$row['subject']);
      $stat->bindParam(3,$row['teacher']);
      $stat->execute();
      while($row1= $stat->fetch()){

        echo "<div class='individual'><div class='info'><p><b>File:‎‎ ‎‎‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎</b><a target='_blank' href='scripts/assignment.php?id=".$row1['id']."'>".$row1['name']."</a></p>
        <p><b>Submitted by:  ‎  ‎ </b>".$row1['student']."<br><b>PRN:  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎ ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎</b>".$row1['prn']."<br><b>Submitted On:  ‎ </b>".$row1['datesub']."</p></div><div class='upldel' style='margin-top:-15px;'><p><br>".$row1['status']."<br>";
        $grade = $dbh-> prepare("select * from grades where id = ?");
        $grade->bindParam(1,$row1['id']);
        $grade->execute();
        $row2= $grade->fetch();
        echo "<a class='p_d' target='_blank' href='scripts/detection.php?id=".$row1['id']."'>Scan</a><br>";
        if(empty($row2)){
          echo"<a class='grade' href='grade.php?id=".$row1['id']."'>Grade </a>";
        }
        else{
          echo"<p style='color: seagreen;'><b>Graded: ".$row2['grade']."/10 </b></p>";
        }
        echo "</div></div>";

        echo "<hr>";
  }
}
echo "<br><p class='sub_name'>Computer Network<br></p>";
if(empty($cn)){
  echo "<p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Posted for this Subject!<p><hr>";
}
foreach($cn as $item)
{
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  $row = $stati->fetch();
  echo "<div class='exp_heading'><div class='aim'>".$row['aim']."</div><div class='deadline'>Deadline: ".$row['date']."</div><div class='stats'><a class ='stats_btn' href='scripts/stats.php?id=".$row['aim']."'><i class='fas fa-chart-pie'></i></a></div><div class='remove'><a class='remove_btn' href='scripts/remove.php?id=".$row['id']."'><i class='fas fa-trash'></i></a></div></div><br><hr>";
      $stat = $dbh-> prepare("select * from storage where aim = ? and subject = ? and teacher = ?");
      $stat->bindParam(1,$row['aim']);
      $stat->bindParam(2,$row['subject']);
      $stat->bindParam(3,$row['teacher']);
      $stat->execute();
      while($row1= $stat->fetch()){

        echo "<div class='individual'><div class='info'><p><b>File:‎‎ ‎‎‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎</b><a target='_blank' href='scripts/assignment.php?id=".$row1['id']."'>".$row1['name']."</a></p>
        <p><b>Submitted by:  ‎  ‎ </b>".$row1['student']."<br><b>PRN:  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎ ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎</b>".$row1['prn']."<br><b>Submitted On:  ‎ </b>".$row1['datesub']."</p></div><div class='upldel' style='margin-top:-15px;'><p><br>".$row1['status']."<br>";
        $grade = $dbh-> prepare("select * from grades where id = ?");
        $grade->bindParam(1,$row1['id']);
        $grade->execute();
        $row2= $grade->fetch();
        echo "<a class='p_d' target='_blank' href='scripts/detection.php?id=".$row1['id']."'>Scan</a><br>";
        if(empty($row2)){
          echo"<a class='grade' href='grade.php?id=".$row1['id']."'>Grade </a>";
        }
        else{
          echo"<p style='color: seagreen;'><b>Graded: ".$row2['grade']."/10 </b></p>";
        }
        echo "</div></div>";

        echo "<hr>";
  }
}
echo "<br><p class='sub_name'>Database Managaement System<br></p>";
if(empty($dbms)){
  echo "<p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Posted for this Subject!<p><hr>";
}
foreach($dbms as $item)
{
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  $row = $stati->fetch();
  echo "<div class='exp_heading'><div class='aim'>".$row['aim']."</div><div class='deadline'>Deadline: ".$row['date']."</div><div class='stats'><a class ='stats_btn' href='scripts/stats.php?id=".$row['aim']."'><i class='fas fa-chart-pie'></i></a></div><div class='remove'><a class='remove_btn' href='scripts/remove.php?id=".$row['id']."'><i class='fas fa-trash'></i></a></div></div><br><hr>";
      $stat = $dbh-> prepare("select * from storage where aim = ? and subject = ? and teacher = ?");
      $stat->bindParam(1,$row['aim']);
      $stat->bindParam(2,$row['subject']);
      $stat->bindParam(3,$row['teacher']);
      $stat->execute();
      while($row1= $stat->fetch()){

        echo "<div class='individual'><div class='info'><p><b>File:‎‎ ‎‎‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎</b><a target='_blank' href='scripts/assignment.php?id=".$row1['id']."'>".$row1['name']."</a></p>
        <p><b>Submitted by:  ‎  ‎ </b>".$row1['student']."<br><b>PRN:  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎ ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎</b>".$row1['prn']."<br><b>Submitted On:  ‎ </b>".$row1['datesub']."</p></div><div class='upldel' style='margin-top:-15px;'><p><br>".$row1['status']."<br>";
        $grade = $dbh-> prepare("select * from grades where id = ?");
        $grade->bindParam(1,$row1['id']);
        $grade->execute();
        $row2= $grade->fetch();
        echo "<a class='p_d' target='_blank' href='scripts/detection.php?id=".$row1['id']."'>Scan</a><br>";
        if(empty($row2)){
          echo"<a class='grade' href='grade.php?id=".$row1['id']."'>Grade </a>";
        }
        else{
          echo"<p style='color: seagreen;'><b>Graded: ".$row2['grade']."/10 </b></p>";
        }
        echo "</div></div>";

        echo "<hr>";
  }
}
echo "<br><p class='sub_name'>Multiprocessor<br></p>";
if(empty($mp)){
  echo "<p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Posted for this Subject!<p><hr>";
}
foreach($mp as $item)
{
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  $row = $stati->fetch();
  echo "<div class='exp_heading'><div class='aim'>".$row['aim']."</div><div class='deadline'>Deadline: ".$row['date']."</div><div class='stats'><a class ='stats_btn' href='scripts/stats.php?id=".$row['aim']."'><i class='fas fa-chart-pie'></i></a></div><div class='remove'><a class='remove_btn' href='scripts/remove.php?id=".$row['id']."'><i class='fas fa-trash'></i></a></div></div><br><hr>";
      $stat = $dbh-> prepare("select * from storage where aim = ? and subject = ? and teacher = ?");
      $stat->bindParam(1,$row['aim']);
      $stat->bindParam(2,$row['subject']);
      $stat->bindParam(3,$row['teacher']);
      $stat->execute();
      while($row1= $stat->fetch()){

        echo "<div class='individual'><div class='info'><p><b>File:‎‎ ‎‎‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎</b><a target='_blank' href='scripts/assignment.php?id=".$row1['id']."'>".$row1['name']."</a></p>
        <p><b>Submitted by:  ‎  ‎ </b>".$row1['student']."<br><b>PRN:  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎ ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎</b>".$row1['prn']."<br><b>Submitted On:  ‎ </b>".$row1['datesub']."</p></div><div class='upldel' style='margin-top:-15px;'><p><br>".$row1['status']."<br>";
        $grade = $dbh-> prepare("select * from grades where id = ?");
        $grade->bindParam(1,$row1['id']);
        $grade->execute();
        $row2= $grade->fetch();
        echo "<a class='p_d' target='_blank' href='scripts/detection.php?id=".$row1['id']."'>Scan</a><br>";
        if(empty($row2)){
          echo"<a class='grade' href='grade.php?id=".$row1['id']."'>Grade </a>";
        }
        else{
          echo"<p style='color: seagreen;'><b>Graded: ".$row2['grade']."/10 </b></p>";
        }
        echo "</div></div>";

        echo "<hr>";
  }
}

echo "<br><p class='sub_name'>Multimedia Systems<br></p>";
if(empty($msd)){
  echo "<p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Posted for this Subject!<p><hr>";
}
foreach($msd as $item)
{
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  $row = $stati->fetch();
  echo "<div class='exp_heading'><div class='aim'>".$row['aim']."</div><div class='deadline'>Deadline: ".$row['date']."</div><div class='stats'><a class ='stats_btn' href='scripts/stats.php?id=".$row['aim']."'><i class='fas fa-chart-pie'></i></a></div><div class='remove'><a class='remove_btn' href='scripts/remove.php?id=".$row['id']."'><i class='fas fa-trash'></i></a></div></div><br><hr>";
      $stat = $dbh-> prepare("select * from storage where aim = ? and subject = ? and teacher = ?");
      $stat->bindParam(1,$row['aim']);
      $stat->bindParam(2,$row['subject']);
      $stat->bindParam(3,$row['teacher']);
      $stat->execute();
      while($row1= $stat->fetch()){

        echo "<div class='individual'><div class='info'><p><b>File:‎‎ ‎‎‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎</b><a target='_blank' href='scripts/assignment.php?id=".$row1['id']."'>".$row1['name']."</a></p>
        <p><b>Submitted by:  ‎  ‎ </b>".$row1['student']."<br><b>PRN:  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎ ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎</b>".$row1['prn']."<br><b>Submitted On:  ‎ </b>".$row1['datesub']."</p></div><div class='upldel' style='margin-top:-15px;'><p><br>".$row1['status']."<br>";
        $grade = $dbh-> prepare("select * from grades where id = ?");
        $grade->bindParam(1,$row1['id']);
        $grade->execute();
        $row2= $grade->fetch();
        echo "<a class='p_d' target='_blank' href='scripts/detection.php?id=".$row1['id']."'>Scan</a><br>";
        if(empty($row2)){
          echo"<a class='grade' href='grade.php?id=".$row1['id']."'>Grade </a>";
        }
        else{
          echo"<p style='color: seagreen;'><b>Graded: ".$row2['grade']."/10 </b></p>";
        }
        echo "</div></div>";

        echo "<hr>";
  }
}
echo "<br><p class='sub_name'>Theory of Computer Science<br></p>";
if(empty($tcs)){
  echo "<p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Posted for this Subject!<p><hr>";
}
foreach($tcs as $item)
{
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  $row = $stati->fetch();
  echo "<div class='exp_heading'><div class='aim'>".$row['aim']."</div><div class='deadline'>Deadline: ".$row['date']."</div><div class='stats'><a class ='stats_btn' href='scripts/stats.php?id=".$row['aim']."'><i class='fas fa-chart-pie'></i></a></div><div class='remove'><a class='remove_btn' href='scripts/remove.php?id=".$row['id']."'><i class='fas fa-trash'></i></a></div></div><br><hr>";
      $stat = $dbh-> prepare("select * from storage where aim = ? and subject = ? and teacher = ?");
      $stat->bindParam(1,$row['aim']);
      $stat->bindParam(2,$row['subject']);
      $stat->bindParam(3,$row['teacher']);
      $stat->execute();
      while($row1= $stat->fetch()){

        echo "<div class='individual'><div class='info'><p><b>File:‎‎ ‎‎‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎</b><a target='_blank' href='scripts/assignment.php?id=".$row1['id']."'>".$row1['name']."</a></p>
        <p><b>Submitted by:  ‎  ‎ </b>".$row1['student']."<br><b>PRN:  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎ ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎</b>".$row1['prn']."<br><b>Submitted On:  ‎ </b>".$row1['datesub']."</p></div><div class='upldel' style='margin-top:-15px;'><p><br>".$row1['status']."<br>";
        $grade = $dbh-> prepare("select * from grades where id = ?");
        $grade->bindParam(1,$row1['id']);
        $grade->execute();
        $row2= $grade->fetch();
        echo "<a class='p_d' target='_blank' href='scripts/detection.php?id=".$row1['id']."'>Scan</a><br>";
        if(empty($row2)){
          echo"<a class='grade' href='grade.php?id=".$row1['id']."'>Grade </a>";
        }
        else{
          echo"<p style='color: seagreen;'><b>Graded: ".$row2['grade']."/10 </b></p>";
        }
        echo "</div></div>";

        echo "<hr>";
  }
}
echo "<br><p class='sub_name'>Web Design Lab<br></p>";
if(empty($wdl)){
  echo "<p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Posted for this Subject!<p><hr>";
}
foreach($wdl as $item)
{
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  $row = $stati->fetch();
  echo "<div class='exp_heading'><div class='aim'>".$row['aim']."</div><div class='deadline'>Deadline: ".$row['date']."</div><div class='stats'><a class ='stats_btn' href='scripts/stats.php?id=".$row['aim']."'><i class='fas fa-chart-pie'></i></a></div><div class='remove'><a class='remove_btn' href='scripts/remove.php?id=".$row['id']."'><i class='fas fa-trash'></i></a></div></div><br><hr>";
      $stat = $dbh-> prepare("select * from storage where aim = ? and subject = ? and teacher = ?");
      $stat->bindParam(1,$row['aim']);
      $stat->bindParam(2,$row['subject']);
      $stat->bindParam(3,$row['teacher']);
      $stat->execute();
      while($row1= $stat->fetch()){

        echo "<div class='individual'><div class='info'><p><b>File:‎‎ ‎‎‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎</b><a target='_blank' href='scripts/assignment.php?id=".$row1['id']."'>".$row1['name']."</a></p>
        <p><b>Submitted by:  ‎  ‎ </b>".$row1['student']."<br><b>PRN:  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎ ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎  ‎</b>".$row1['prn']."<br><b>Submitted On:  ‎ </b>".$row1['datesub']."</p></div><div class='upldel' style='margin-top:-15px;'><p><br>".$row1['status']."<br>";
        $grade = $dbh-> prepare("select * from grades where id = ?");
        $grade->bindParam(1,$row1['id']);
        $grade->execute();
        $row2= $grade->fetch();
        echo "<a class='p_d' target='_blank' href='scripts/detection.php?id=".$row1['id']."'>Scan</a><br>";
        if(empty($row2)){
          echo"<a class='grade' href='grade.php?id=".$row1['id']."'>Grade </a>";
        }
        else{
          echo"<p style='color: seagreen;'><b>Graded: ".$row2['grade']."/10 </b></p>";
        }
        echo "</div></div>";

        echo "<hr>";
  }
}
?>
</ul>
</section>
<section id="c1" style="height:800px;">
<div style="margin-top:-30px; margin-left:-10px;">
  <ul class="tabs">
        <li>
          <input type="radio" checked name="tabs" id="tab1">
          <label for="tab1">Python</label>
          <div id="tab-content1" class="tab-content animated fadeIn">
            <p class = "section_heading" ><br>Python Compiler</p>
            <button id="btn1" style="float:right">Refresh</button><br><br>
            <iframe height="400px" width="100%" id="iframeid1" src="https://repl.it/@tejas190899/SmartAssignpy?lite=true" scrolling="no" frameborder="no" allowtransparency="true" allowfullscreen="true" sandbox="allow-forms allow-pointer-lock allow-popups allow-same-origin allow-scripts allow-modals"></iframe>
          </div>
        </li>
        <li>
          <input type="radio" name="tabs" id="tab2">
          <label for="tab2">Java</label>
          <div id="tab-content2" class="tab-content animated fadeIn">
              <p class = "section_heading" ><br>Java Compiler</p>
              <button id="btn2" style="float:right">Refresh</button><br><br>
           <iframe height="400px" width="100%" id="iframeid2" src="https://repl.it/@tejas190899/SmartAssignjava?lite=true" scrolling="no" frameborder="no" allowtransparency="true" allowfullscreen="true" sandbox="allow-forms allow-pointer-lock allow-popups allow-same-origin allow-scripts allow-modals"></iframe>
           </div>
        </li>
        <li>
          <input type="radio" name="tabs" id="tab3">
          <label for="tab3">Html5</label>
          <div id="tab-content3" class="tab-content animated fadeIn">
              <p class = "section_heading" ><br>HTML Compiler</p>
            <button id="btn3" style="float:right">Refresh</i> </button><br><br>
            <iframe height="400px" width="100%" id="iframeid3" src="https://repl.it/@tejas190899/SmartAssignwebdev?lite=true" scrolling="no" frameborder="no" allowtransparency="true" allowfullscreen="true" sandbox="allow-forms allow-pointer-lock allow-popups allow-same-origin allow-scripts allow-modals"></iframe>
          </div>
        </li>
</ul>
<br>
<div style="clear:both"></div>
</div>
</section>
<section id="d1">
  <?php
  $name = $_SESSION["email"];
  $stmt = $dbh-> prepare("select * from logs where name = ?");
  $stmt->bindParam(1,$name);
  $stmt->execute();
  echo "<p class='section_heading'>Your History: </p><hr><br>";
  echo "<table>";
  echo "<tr><th>Activity</th><th>Assignment Name</th><th>Subject</th><th>Date and Time</th></tr>";
  while($row = $stmt->fetch()){
    echo "<tr><td>".$row['action']."</td><td>".$row['assignment']."</td><td>".$row['subject']."</td><td>".$row['cdate']."</td></tr><br>";
  }
  echo "</table>";

  echo "<a href='scripts/clear_tui.php?id=".$uem."' class='upl' style='margin-left:600px;'>Clear History</a>"
  ?>
</form>
</section>
</div></div>
<script>
    function reload1() {
        document.getElementById('iframeid1').src += '';
    }
    function reload2() {
        document.getElementById('iframeid2').src += '';
    }
    function reload3() {
        document.getElementById('iframeid3').src += '';
    }
    btn1.onclick = reload1;
    btn2.onclick = reload2;
    btn3.onclick = reload3;
</script>
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
<script>
function date() {
    var today = new Date();
    document.getElementById('date').innerHTML = today.toDateString();
}


function clock() {
    var today = new Date();
    var hour = zeros(twelveHour(today.getHours()));
    var minutes = zeros(today.getMinutes());
    var seconds = zeros(today.getSeconds());
    // console.log(today.toLocaleTimeString());
    document.getElementById('hour').innerHTML = hour;
    document.getElementById('min').innerHTML = minutes;
    document.getElementById('sec').innerHTML = seconds;
}

function twelveHour(hour) {
    if (hour > 12) {
        return hour -= 12
    } else if (hour === 0) {
        return hour = 12;
    } else {
        return hour
    }
}
// adds zero infront of single digit number
function zeros(num) {
    if (num < 10) {
        num = '0' + num
    };
    return num;
}

function dateTime() {
    date();
    clock();
    setTimeout(dateTime, 500);
}

dateTime()
// END
</script><hr>
</body>
<footer style="text-align:center; padding: 50px;">
  <span>&copy; Smart Assign, 2020. All Rights Reserved</span>
</footer>
</html>
