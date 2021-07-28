<!DOCTYPE html>
<html>
<link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
<link rel="manifest" href="images/site.webmanifest">
<link rel="stylesheet" href="css/ui.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $(".container").on('click', '.a', function () {
    $("#a1").css("display","block");
      $("#b1").css("display","none");
        $("#c1").css("display","none");
  });
  $(".container").on('click', '.b', function () {
    $("#b1").css("display","block");
      $("#c1").css("display","none");
        $("#a1").css("display","none");
  });
  $(".container").on('click', '.c', function () {
    $("#c1").css("display","block");
      $("#b1").css("display","none");
        $("#a1").css("display","none");
  });
});
</script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>

<script>
// Add active class to the current button (highlight it)
var header = document.getElementsByClassName("container");
var btns = header.getElementsByClassName("a","b","c");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("active");
  current[0].className = current[0].className.replace(" active", "");
  this.className += " active";
  });
}
</script>

 <head>
  <title>Student's Portal</title>
  <style>
  ul{
    list-style-type: none;
  }
  .space{
    width:400px;
    height:200px;
  }
  </style>
</head>
<body>
  <div class="home" id="home">
    <div class="header">
    <!--  <p style="text-align:center;font-size:70px;"> <span style="color:#004aad">S</span>mart<span style="color:#004aad">A</span>ssign</p>-->
      <img src="images/logo_bg.png" height="80px" ><br>
    </div></div>
  <div class="topnav">
    <ul>
    <a href="scripts/logout.php">Sign Out</a>
      <?php
      include 'scripts/connect.php';
      session_start();
      $uem=$_SESSION["email"];
      $name = $_SESSION["name"];
      echo "<p class='welcome'>Welcome ".$name."</p>";
      ?>
    </ul>
</div>
      <div class="logo"> <img src="images/role_student2.png" alt="logo" style="float:left;margin-left: 30px;width:150px;"></div>


<?php
if(!isset($_SESSION['email']))
{
    echo "login to your account";
    header("refresh:1;url=signin.php");
    exit();
}
?>
<div class="full-table">
  <div class="date" id="date"></div>
<br>
  <div class="clock">
    <div class="time" id="hour"></div>
    <div class="colon">:</div>
    <div class="time" id="min"></div>
    <div class="colon">:</div>
    <div class="time" id="sec"></div>
  </div>
</div>
<div class="wholepage">

<div class="container">
    <ul>
    <li class="a"><a href="#">All</a></li>
    <li class="b"><a href="#">Submitted</a></li>
    <li class="c"><a href="#">Pending</a></li>
    </ul>
</div>

<!--All Assignments starts here -->

<div class="assignpart">
<?php
$dbh = new PDO("mysql:host=localhost;dbname=classroom","root","");
$star = $dbh-> prepare("select * from assignment");
$star->execute();
?>
<ul>
  <?php
//Below are arrays used to store the pending assignment's ids according to their subjects
$aav = array();
$bcev= array();
$cnv= array();
$dbmsv= array();
$mpv= array();
$msdv= array();
$tcsv= array();
$wdlv= array();
//Below are arrays used to store the submitted assignment's ids according to their subjects
$aaw = array();
$bcew= array();
$cnw= array();
$dbmsw= array();
$mpw= array();
$msdw= array();
$tcsw= array();
$wdlw= array();
//Below are the arrays to sort all assignments according to their subjects
$aa= array();
$bce= array();
$cn= array();
$dbms= array();
$mp= array();
$msd= array();
$tcs= array();
$wdl= array();
//While loop below stores all assignments into respective subject arrays
while($row = $star->fetch()){
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
?>

<section id ="a1"> <?php
//here we are checking the arrays
echo "<li class='section_heading'>All Assignments:</li><hr> <br>";
echo "<p class='sub_name'>Advanced Algorithm<br></p>";
if(empty($aa)){
  echo "<div class='individual'><p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Posted for this Subject!<p></div>";
}
foreach($aa as $item)
{
  echo "<div class='individual'>";
  echo "<div class='info'>";
$star0 = $dbh-> prepare("select * from assignment where id = ?");
$star0->bindParam(1,$item);
$star0->execute();
$rows = $star0->fetch();
echo "<li>Aim: ".$rows['aim']."</li><li>Assigned By: ".$rows['teacher']."</li><li>Deadline: ".$rows['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ? and teacher = ? and subject = ?");
$star1->bindParam(1,$rows['aim']);
$star1->bindParam(2,$uem);
$star1->bindParam(3,$rows['teacher']);
$star1->bindParam(4,$rows['subject']);
$star1->execute();
$rowi = $star1->fetch();
echo "<div class='upldel'>";
if(empty($rowi)){
  array_push($aav,$rows['id']);
  echo "<a class='upl' href='upload.php?id=".$rows['id']."'>Upload <i class='fas fa-upload'></i></a>";
}
else{
  echo "<p style='margin-top:30px'>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
  array_push($aaw,$rows['id']);
}
  echo "</div></div><hr>";
}


echo "<br><p class='sub_name'>Business Comm & Ethics<br></p>";
if(empty($bce)){
  echo "<div class='individual'><p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Posted for this Subject!<p></div>";
}
foreach($bce as $item)
{
  echo "<div class='individual'>";
  echo "<div class='info'>";
$star0 = $dbh-> prepare("select * from assignment where id = ?");
$star0->bindParam(1,$item);
$star0->execute();
$rows = $star0->fetch();
echo "<li>Aim: ".$rows['aim']."</li><li>Assigned By: ".$rows['teacher']."</li><li>Deadline: ".$rows['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ? and teacher = ? and subject = ?");
$star1->bindParam(1,$rows['aim']);
$star1->bindParam(2,$uem);
$star1->bindParam(3,$rows['teacher']);
$star1->bindParam(4,$rows['subject']);
$star1->execute();
$rowi = $star1->fetch();
echo "<div class='upldel'>";
if(empty($rowi)){
  array_push($bcev,$rows['id']);
  echo "<a class='upl' href='upload.php?id=".$rows['id']."'>Upload <i class='fas fa-upload'></i></a>";
}
else{
  echo "<p style='margin-top:30px'>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
  array_push($bcew,$rows['id']);
}
  echo "</div></div><hr>";
}


echo "<br><p class='sub_name'>Computer Network<br></p>";
if(empty($cn)){
  echo "<div class='individual'><p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Posted for this Subject!<p></div>";
}
foreach($cn as $item)
{
  echo "<div class='individual'>";
  echo "<div class='info'>";
$star0 = $dbh-> prepare("select * from assignment where id = ?");
$star0->bindParam(1,$item);
$star0->execute();
$rows = $star0->fetch();
echo "<li>Aim: ".$rows['aim']."</li><li>Assigned By: ".$rows['teacher']."</li><li>Deadline: ".$rows['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ? and teacher = ? and subject = ?");
$star1->bindParam(1,$rows['aim']);
$star1->bindParam(2,$uem);
$star1->bindParam(3,$rows['teacher']);
$star1->bindParam(4,$rows['subject']);
$star1->execute();
$rowi = $star1->fetch();
echo "<div class='upldel'>";
if(empty($rowi)){
  array_push($cnv,$rows['id']);
  echo "<a class='upl' href='upload.php?id=".$rows['id']."'>Upload <i class='fas fa-upload'></i></a>";
}
else{
  echo "<p style='margin-top:30px'>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
  array_push($cnw,$rows['id']);
}
echo "</div></div><hr>";
}



echo "<br><p class='sub_name'>Database Management System<br></p>";
if(empty($dbms)){
  echo "<div class='individual'><p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Posted for this Subject!<p></div>";
}
foreach($dbms as $item)
{
  echo "<div class='individual'>";
    echo "<div class='info'>";
$star0 = $dbh-> prepare("select * from assignment where id = ?");
$star0->bindParam(1,$item);
$star0->execute();
$rows = $star0->fetch();
echo "<li>Aim: ".$rows['aim']."</li><li>Assigned By: ".$rows['teacher']."</li><li>Deadline: ".$rows['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ? and teacher = ? and subject = ?");
$star1->bindParam(1,$rows['aim']);
$star1->bindParam(2,$uem);
$star1->bindParam(3,$rows['teacher']);
$star1->bindParam(4,$rows['subject']);
$star1->execute();
$rowi = $star1->fetch();
echo "<div class='upldel'>";
if(empty($rowi)){
  array_push($dbmsv,$rows['id']);
  echo "<a class='upl' href='upload.php?id=".$rows['id']."'>Upload <i class='fas fa-upload'></i></a>";
}
else{
  echo "<p style='margin-top:30px'>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
  array_push($dbmsw,$rows['id']);
}
  echo "</div></div><hr>";
}


echo "<br><p class='sub_name'>Microprocessor<br></p>";
if(empty($mp)){
  echo "<div class='individual'><p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Posted for this Subject!<p></div>";
}
foreach($mp as $item)
{
  echo "<div class='individual'>";
    echo "<div class='info'>";
$star0 = $dbh-> prepare("select * from assignment where id = ?");
$star0->bindParam(1,$item);
$star0->execute();
$rows = $star0->fetch();
echo "<li>Aim: ".$rows['aim']."</li><li>Assigned By: ".$rows['teacher']."</li><li>Deadline: ".$rows['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ? and teacher = ? and subject = ?");
$star1->bindParam(1,$rows['aim']);
$star1->bindParam(2,$uem);
$star1->bindParam(3,$rows['teacher']);
$star1->bindParam(4,$rows['subject']);
$star1->execute();
$rowi = $star1->fetch();
echo "<div class='upldel'>";
if(empty($rowi)){
  array_push($mpv,$rows['id']);
  echo "<a class='upl' href='upload.php?id=".$rows['id']."'>Upload <i class='fas fa-upload'></i></a>";
}
else{
  echo "<p style='margin-top:30px'>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
  array_push($mpw,$rows['id']);
}
echo "</div></div><hr>";
}


echo "<br><p class='sub_name'>Multimedia Systems<br></p>";
if(empty($msd)){
  echo "<div class='individual'><p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Posted for this Subject!<p></div>";
}
foreach($msd as $item)
{
  echo "<div class='individual'>";
    echo "<div class='info'>";
$star0 = $dbh-> prepare("select * from assignment where id = ?");
$star0->bindParam(1,$item);
$star0->execute();
$rows = $star0->fetch();
echo "<li>Aim: ".$rows['aim']."</li><li>Assigned By: ".$rows['teacher']."</li><li>Deadline: ".$rows['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ? and teacher = ? and subject = ?");
$star1->bindParam(1,$rows['aim']);
$star1->bindParam(2,$uem);
$star1->bindParam(3,$rows['teacher']);
$star1->bindParam(4,$rows['subject']);
$star1->execute();
$rowi = $star1->fetch();
echo "<div class='upldel'>";
if(empty($rowi)){
  array_push($msdv,$rows['id']);
  echo "<a class='upl' href='upload.php?id=".$rows['id']."'>Upload <i class='fas fa-upload'></i></a>";
}
else{
  echo "<p style='margin-top:30px'>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
    array_push($msdw,$rows['id']);
}
echo "</div></div><hr>";
}



echo "<br><p class='sub_name'>Theory of Computer Science<br></p>";
if(empty($tcs)){
  echo "<div class='individual'><p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Posted for this Subject!<p></div>";
}
foreach($tcs as $item)
{
  echo "<div class='individual'>";
    echo "<div class='info'>";
$star0 = $dbh-> prepare("select * from assignment where id = ?");
$star0->bindParam(1,$item);
$star0->execute();
$rows = $star0->fetch();
echo "<li>Aim: ".$rows['aim']."</li><li>Assigned By: ".$rows['teacher']."</li><li>Deadline: ".$rows['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ? and teacher = ? and subject = ?");
$star1->bindParam(1,$rows['aim']);
$star1->bindParam(2,$uem);
$star1->bindParam(3,$rows['teacher']);
$star1->bindParam(4,$rows['subject']);
$star1->execute();
$rowi = $star1->fetch();
echo "<div class='upldel'>";
if(empty($rowi)){
  array_push($tcsv,$rows['id']);
  echo "<a class='upl' href='upload.php?id=".$rows['id']."'>Upload <i class='fas fa-upload'></i></a>";
}
else{
  echo "<p style='margin-top:30px'>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
  array_push($tcsw,$rows['id']);
}
echo "</div></div><hr>";
}


echo "<br><p class='sub_name'>Web Design Lab<br></p>";
if(empty($wdl)){
  echo "<div class='individual'><p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Posted for this Subject!<p></div>";
}
foreach($wdl as $item)
{
  echo "<div class='individual'>";
    echo "<div class='info'>";
$star0 = $dbh-> prepare("select * from assignment where id = ?");
$star0->bindParam(1,$item);
$star0->execute();
$rows = $star0->fetch();
echo "<li>Aim: ".$rows['aim']."</li><li>Assigned By: ".$rows['teacher']."</li><li>Deadline: ".$rows['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ? and teacher = ? and subject = ?");
$star1->bindParam(1,$rows['aim']);
$star1->bindParam(2,$uem);
$star1->bindParam(3,$rows['teacher']);
$star1->bindParam(4,$rows['subject']);
$star1->execute();
$rowi = $star1->fetch();
echo "<div class='upldel'>";
if(empty($rowi)){
  array_push($wdlv,$rows['id']);
  echo "<a class='upl' href='upload.php?id=".$rows['id']."'>Upload <i class='fas fa-upload'></i></a>";
}
else{
  echo "<p style='margin-top:30px'>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
  array_push($wdlw,$rows['id']);
}
echo "</div></div><hr>";
}
echo"";




?>
</ul>
</section>

<!--All Assignments code ends here -->


<!--Submitted assignments code starts -->


<section id="b1">
<ul>

<li  class='section_heading'>Submitted Assignments:</li><hr><br>
<?php

echo "<p class='sub_name'>Advanced Algorithm<br></p>";
if(empty($aaw)){
  echo "<div class='individual'><p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Submitted for this Subject!<p></div>";
}
foreach($aaw as $item) {
  echo "<div class='individual'>";
  echo "<div class='info'>";
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
echo "<div class='upldel'>";
echo "<p style='margin-top:30px'>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del'  href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
array_push($aaw,$rows['id']);
}
echo "</div></div><hr>";
}



echo "<br><p class='sub_name'>Business Comm & Ethics<br></p>";
if(empty($bcew)){
  echo "<div class='individual'><p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Submitted for this Subject!<p></div>";
}
foreach($bcew as $item) {
  echo "<div class='individual'>";
  echo "<div class='info'>";
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
echo "<div class='upldel'>";
echo "<p style='margin-top:30px'>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
array_push($bcew,$rows['id']);
}
echo "</div></div><hr>";
}


echo "<br><p class='sub_name'>Computer Networks<br></p>";
if(empty($cnw)){
  echo "<div class='individual'><p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Submitted for this Subject!<p></div>";
}
foreach($cnw as $item) {
  echo "<div class='individual'>";
  echo "<div class='info'>";
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
echo "<div class='upldel'>";
echo "<p style='margin-top:30px'>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
array_push($cnw,$rows['id']);
}
echo "</div></div><hr>";
}


echo "<br><p class='sub_name'>Database Management System<br></p>";
if(empty($dbmsw)){
  echo "<div class='individual'><p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Submitted for this Subject!<p></div>";
}
foreach($dbmsw as $item) {
  echo "<div class='individual'>";
  echo "<div class='info'>";
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
echo "<div class='upldel'>";
echo "<p style='margin-top:30px'>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
array_push($dbmsw,$rows['id']);
}
echo "</div></div><hr>";
}


echo "<br><p class='sub_name'>Microprocessor<br></p>";
if(empty($mpw)){
  echo "<div class='individual'><p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Submitted for this Subject!<p></div>";
}
foreach($mpw as $item) {
  echo "<div class='individual'>";
  echo "<div class='info'>";
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
echo "<div class='upldel'>";
echo "<p style='margin-top:30px'>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
array_push($mpw,$rows['id']);
}
echo "</div></div><hr>";
}


echo "<br><p class='sub_name'>Multimedia Systems<br></p>";
if(empty($msdw)){
  echo "<div class='individual'><p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Submitted for this Subject!<p></div>";
}
foreach($msdw as $item) {
  echo "<div class='individual'>";
  echo "<div class='info'>";
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
echo "<div class='upldel'>";
echo "<p style='margin-top:30px'>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
  array_push($msdw,$rows['id']);
}
echo "</div></div><hr>";
}


echo "<br><p class='sub_name'>Theory of Computer Science<br></p>";
if(empty($tcsw)){
  echo "<div class='individual'><p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Submitted for this Subject!<p></div>";
}
foreach($tcsw as $item) {
  echo "<div class='individual'>;";
  echo "<div class='info'>";
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
echo "<div class='upldel'>";
echo "<p style='margin-top:30px'>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
array_push($tcsw,$rows['id']);
}
echo "</div></div><hr>";
}


echo "<br><p class='sub_name'>Web Design Lab<br></p>";
if(empty($wdlw)){
  echo "<div class='individual'><p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Submitted for this Subject!<p></div>";
}
foreach($wdlw as $item) {
  echo "<div class='individual'>";
  echo "<div class='info'>";
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
echo "<div class='upldel'>";
echo "<p style='margin-top:30px'>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
array_push($wdlw,$rows['id']);
}
echo "</div></div><hr>";
}

 ?>
</ul>
</section>

<!--Submitted Assignments code ends here -->

<!--Pending Assignments code starts here -->
  <section id="c1">
<ul>
<li class='section_heading'>Pending Assignments:</li><hr> <br>
<?php

echo "<p class='sub_name'>Advanced Algorithm<br></p>";
if(empty($aav)){
  echo "<div class='individual'><p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Pending for this Subject!<p></div>";
}
foreach($aav as $item) {
  echo "<div class='individual'>";
  echo "<div class='info'>";
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
echo "<div class='upldel'>";
  echo "<a class='upl' href='upload.php?id=".$row3['id']."'>Upload <i class='fas fa-upload'></i></a>";
}
echo "</div></div><hr>";
}



echo "<br><p class='sub_name'>Business Comm & Ethics<br></p>";
if(empty($bcev)){
  echo "<div class='individual'><p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Pending for this Subject!<p></div>";
}
foreach($bcev as $item) {
  echo "<div class='individual'>";
  echo "<div class='info'>";
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
echo "<div class='upldel'>";
  echo "<a class='upl' href='upload.php?id=".$row3['id']."'>Upload <i class='fas fa-upload'></i></a>";
}
echo "</div></div><hr>";
}


echo "<br><p class='sub_name'>Computer Networks<br></p>";
if(empty($cnv)){
  echo "<div class='individual'><p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Pending for this Subject!<p></div>";
}
foreach($cnv as $item) {
  echo "<div class='individual'>";
  echo "<div class='info'>";
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
echo "<div class='upldel'>";
  echo "<a class='upl' href='upload.php?id=".$row3['id']."'>Upload <i class='fas fa-upload'></i></a>";

}
echo "</div></div><hr>";
}


echo "<br><p class='sub_name'>Database Management System<br></p>";
if(empty($dbmsv)){
  echo "<div class='individual'><p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Pending for this Subject!<p></div>";
}
foreach($dbmsv as $item) {
  echo "<div class='individual'>";
  echo "<div class='info'>";
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
echo "<div class='upldel'>";
  echo "<a class='upl' href='upload.php?id=".$row3['id']."'>Upload <i class='fas fa-upload'></i></a>";

}
echo "</div></div><hr>";
}


echo "<br><p class='sub_name'>Microprocessor<br></p>";
if(empty($mpv)){
  echo "<div class='individual'><p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Pending for this Subject!<p></div>";
}
foreach($mpv as $item) {
  echo "<div class='individual'>";
  echo "<div class='info'>";
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
echo "<div class='upldel'>";
  echo "<a class='upl' href='upload.php?id=".$row3['id']."'>Upload <i class='fas fa-upload'></i></a>";

}
echo "</div></div><hr>";
}


echo "<br><p class='sub_name'>Multimedia Systems<br></p>";
if(empty($msdv)){
  echo "<div class='individual'><p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Pending for this Subject!<p></div>";
}
foreach($msdv as $item) {
  echo "<div class='individual'>";
  echo "<div class='info'>";
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
echo "<div class='upldel'>";
  echo "<a class='upl' href='upload.php?id=".$row3['id']."'>Upload <i class='fas fa-upload'></i></a>";
}
echo "</div></div><hr>";
}


echo "<br><p class='sub_name'>Theory of Computer Science<br></p>";
if(empty($tcsv)){
  echo "<div class='individual'><p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Pending for this Subject!<p></div>";
}
foreach($tcsv as $item) {
  echo "<div class='individual'>";
  echo "<div class='info'>";
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
echo "<div class='upldel'>";
  echo "<a class='upl' href='upload.php?id=".$row3['id']."'>Upload <i class='fas fa-upload'></i></a>";
}
echo "</div></div><hr>";
}


echo "<br><p class='sub_name'>Web Design Lab<br></p>";
if(empty($wdlv)){
  echo "<div class='individual'><p class='nothing'><i class='fas fa-info-circle'></i> No Assignments Pending for this Subject!<p></div>";
}
foreach($wdlv as $item) {
  echo "<div class='individual'>";
  echo "<div class='info'>";
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
echo "<div class='upldel'>";
  echo "<a class='upl' href='upload.php?id=".$row3['id']."'>Upload <i class='fas fa-upload'></i></a>";
}
echo "</div></div><hr>";
}

 ?>
</ul>
</section>
</div>
</div>

<!--Pending Assignments code ends here -->
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
</script>
</body>
</html>
