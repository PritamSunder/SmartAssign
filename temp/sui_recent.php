<!DOCTYPE html>
<html>
<link rel="stylesheet" href="css/ui.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $(".container").on('click', '#a', function () {
    $("#a1").css("display","block");
      $("#b1").css("display","none");
        $("#c1").css("display","none");
  });
  $(".container").on('click', '#b', function () {
    $("#b1").css("display","block");
      $("#c1").css("display","none");
        $("#a1").css("display","none");
  });
  $(".container").on('click', '#c', function () {
    $("#c1").css("display","block");
      $("#b1").css("display","none");
        $("#a1").css("display","none");
  });
});
</script>

 <head>
  <title>Submission Portal</title>
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

      <?php
      include 'scripts/connect.php';
      session_start();
      $uem=$_SESSION["email"];
      $name = $_SESSION["name"];
      echo "<p>Welcome ".$name."</p>";
      ?>
      <a href="scripts/logout.php">Sign Out</a>
      <br><br>

        <img src="images/ul1.png" alt="logo" style="float:left;margin-left: 30px;width:180px;">


<?php
if(!isset($_SESSION['email']))
{
    echo "login to your account";
    header("refresh:1;url=signin.php");
    exit();
}
?>

<div class="container">
    <ul>
    <li id="a"><a href="#">All assignments</a></li>
    <li id="b"><a href="#">Submitted</a></li>
    <li id="c"><a href="#">Pending</a></li>
    </ul>
</div>
<!--All Assignments starts here -->

<section class="all_assign">
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
?> <div id ="a1"> <?php
//here we are checking the arrays
echo "<li>All Assignments:</li> <br>";
echo "<p>Subject: Advanced Algorithm<br></p>";
if(empty($aa)){
  echo "<p style='color:red;'>No Assignments Posted for this Subject!<p>";
}
foreach($aa as $item)
{
$star0 = $dbh-> prepare("select * from assignment where id = ?");
$star0->bindParam(1,$item);
$star0->execute();
$rows = $star0->fetch();
echo "<li>Aim: ".$rows['aim']."</li><li>Assigned By: ".$rows['teacher']."</li><li>Deadline: ".$rows['date']."</li>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ? and teacher = ? and subject = ?");
$star1->bindParam(1,$rows['aim']);
$star1->bindParam(2,$uem);
$star1->bindParam(3,$rows['teacher']);
$star1->bindParam(4,$rows['subject']);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  array_push($aav,$rows['id']);
  echo "<a class='upl' href='upload.php?id=".$rows['id']."'>Upload</a>";
}
else{
  echo "<p>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' target ='_blank' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
  array_push($aaw,$rows['id']);
}
}


echo "<br><p>Subject: Business Comm & Ethics<br></p>";
if(empty($bce)){
  echo "<p style='color:red;'>No Assignments Posted for this Subject!<p>";
}
foreach($bce as $item)
{
$star0 = $dbh-> prepare("select * from assignment where id = ?");
$star0->bindParam(1,$item);
$star0->execute();
$rows = $star0->fetch();
echo "<li>Aim: ".$rows['aim']."</li><li>Assigned By: ".$rows['teacher']."</li><li>Deadline: ".$rows['date']."</li>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ? and teacher = ? and subject = ?");
$star1->bindParam(1,$rows['aim']);
$star1->bindParam(2,$uem);
$star1->bindParam(3,$rows['teacher']);
$star1->bindParam(4,$rows['subject']);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  array_push($bcev,$rows['id']);
  echo "<a class='upl' href='upload.php?id=".$rows['id']."'>Upload</a>";
}
else{
  echo "<p>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' target ='_blank' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
  array_push($bcew,$rows['id']);
}
}


echo "<br><p>Subject: Computer Network<br></p>";
if(empty($cn)){
  echo "<p style='color:red;'>No Assignments Posted for this Subject!<p>";
}
foreach($cn as $item)
{
$star0 = $dbh-> prepare("select * from assignment where id = ?");
$star0->bindParam(1,$item);
$star0->execute();
$rows = $star0->fetch();
echo "<li>Aim: ".$rows['aim']."</li><li>Assigned By: ".$rows['teacher']."</li><li>Deadline: ".$rows['date']."</li>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ? and teacher = ? and subject = ?");
$star1->bindParam(1,$rows['aim']);
$star1->bindParam(2,$uem);
$star1->bindParam(3,$rows['teacher']);
$star1->bindParam(4,$rows['subject']);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  array_push($cnv,$rows['id']);
  echo "<a class='upl' href='upload.php?id=".$rows['id']."'>Upload</a>";
}
else{
  echo "<p>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' target ='_blank' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
  array_push($cnw,$rows['id']);
}
}



echo "<br><p>Subject: Database Management System<br></p>";
if(empty($dbms)){
  echo "<p style='color:red;'>No Assignments Posted for this Subject!<p>";
}
foreach($dbms as $item)
{
$star0 = $dbh-> prepare("select * from assignment where id = ?");
$star0->bindParam(1,$item);
$star0->execute();
$rows = $star0->fetch();
echo "<li>Aim: ".$rows['aim']."</li><li>Assigned By: ".$rows['teacher']."</li><li>Deadline: ".$rows['date']."</li>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ? and teacher = ? and subject = ?");
$star1->bindParam(1,$rows['aim']);
$star1->bindParam(2,$uem);
$star1->bindParam(3,$rows['teacher']);
$star1->bindParam(4,$rows['subject']);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  array_push($dbmsv,$rows['id']);
  echo "<a class='upl' href='upload.php?id=".$rows['id']."'>Upload</a>";
}
else{
  echo "<p>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' target ='_blank' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
  array_push($dbmsw,$rows['id']);
}
}


echo "<br><p>Subject: Microprocessor<br></p>";
if(empty($mp)){
  echo "<p style='color:red;'>No Assignments Posted for this Subject!<p>";
}
foreach($mp as $item)
{
$star0 = $dbh-> prepare("select * from assignment where id = ?");
$star0->bindParam(1,$item);
$star0->execute();
$rows = $star0->fetch();
echo "<li>Aim: ".$rows['aim']."</li><li>Assigned By: ".$rows['teacher']."</li><li>Deadline: ".$rows['date']."</li>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ? and teacher = ? and subject = ?");
$star1->bindParam(1,$rows['aim']);
$star1->bindParam(2,$uem);
$star1->bindParam(3,$rows['teacher']);
$star1->bindParam(4,$rows['subject']);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  array_push($mpv,$rows['id']);
  echo "<a class='upl' href='upload.php?id=".$rows['id']."'>Upload</a>";
}
else{
  echo "<p>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' target ='_blank' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
  array_push($mpw,$rows['id']);
}
}


echo "<br><p>Subject: Multimedia Systems<br></p>";
if(empty($msd)){
  echo "<p style='color:red;'>No Assignments Posted for this Subject!<p>";
}
foreach($msd as $item)
{
$star0 = $dbh-> prepare("select * from assignment where id = ?");
$star0->bindParam(1,$item);
$star0->execute();
$rows = $star0->fetch();
echo "<li>Aim: ".$rows['aim']."</li><li>Assigned By: ".$rows['teacher']."</li><li>Deadline: ".$rows['date']."</li>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ? and teacher = ? and subject = ?");
$star1->bindParam(1,$rows['aim']);
$star1->bindParam(2,$uem);
$star1->bindParam(3,$rows['teacher']);
$star1->bindParam(4,$rows['subject']);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  array_push($msdv,$rows['id']);
  echo "<a class='upl' href='upload.php?id=".$rows['id']."'>Upload</a>";
}
else{
  echo "<p>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' target ='_blank' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
    array_push($msdw,$rows['id']);
}
}



echo "<br><p>Subject: Theory of Computer Science<br></p>";
if(empty($tcs)){
  echo "<p style='color:red;'>No Assignments Posted for this Subject!<p>";
}
foreach($tcs as $item)
{
$star0 = $dbh-> prepare("select * from assignment where id = ?");
$star0->bindParam(1,$item);
$star0->execute();
$rows = $star0->fetch();
echo "<li>Aim: ".$rows['aim']."</li><li>Assigned By: ".$rows['teacher']."</li><li>Deadline: ".$rows['date']."</li>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ? and teacher = ? and subject = ?");
$star1->bindParam(1,$rows['aim']);
$star1->bindParam(2,$uem);
$star1->bindParam(3,$rows['teacher']);
$star1->bindParam(4,$rows['subject']);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  array_push($tcsv,$rows['id']);
  echo "<a class='upl' href='upload.php?id=".$rows['id']."'>Upload</a>";
}
else{
  echo "<p>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' target ='_blank' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
  array_push($tcsw,$rows['id']);
}
}


echo "<br><p>Subject: Web Design Lab<br></p>";
if(empty($wdl)){
  echo "<p style='color:red;'>No Assignments Posted for this Subject!<p>";
}
foreach($wdl as $item)
{
$star0 = $dbh-> prepare("select * from assignment where id = ?");
$star0->bindParam(1,$item);
$star0->execute();
$rows = $star0->fetch();
echo "<li>Aim: ".$rows['aim']."</li><li>Assigned By: ".$rows['teacher']."</li><li>Deadline: ".$rows['date']."</li>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ? and teacher = ? and subject = ?");
$star1->bindParam(1,$rows['aim']);
$star1->bindParam(2,$uem);
$star1->bindParam(3,$rows['teacher']);
$star1->bindParam(4,$rows['subject']);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  array_push($wdlv,$rows['id']);
  echo "<a class='upl' href='upload.php?id=".$rows['id']."'>Upload</a>";
}
else{
  echo "<p>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' target ='_blank' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
  array_push($wdlw,$rows['id']);
}
}
echo"";




?>
</ul>
</div>
</section>

<!--All Assignments code ends here -->


<!--Submitted assignments code starts -->


<section class="sub_assign">
<div id="b1">
<ul>

<li>Submitted Assignments:</li><br>
<?php

echo "<p>Subject: Advanced Algorithm<br></p>";
if(empty($aaw)){
  echo "<p style='color:red;'>No Assignments Submitted for this Subject!<p>";
}
foreach($aaw as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
echo "<p>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' target ='_blank' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
array_push($aaw,$rows['id']);
}
echo "";
}



echo "<br><p>Subject: Business Comm & Ethics<br></p>";
if(empty($bcew)){
  echo "<p style='color:red;'>No Assignments Submitted for this Subject!<p>";
}
foreach($bcew as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
echo "<p>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' target ='_blank' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
array_push($bcew,$rows['id']);
}
echo "";
}


echo "<br><p>Subject: Computer Networks<br></p>";
if(empty($cnw)){
  echo "<p style='color:red;'>No Assignments Submitted for this Subject!<p>";
}
foreach($cnw as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
echo "<p>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' target ='_blank' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
array_push($cnw,$rows['id']);
}
echo "";
}


echo "<br><p>Subject: Database Management System<br></p>";
if(empty($dbmsw)){
  echo "<p style='color:red;'>No Assignments Submitted for this Subject!<p>";
}
foreach($dbmsw as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
echo "<p>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' target ='_blank' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
array_push($dbmsw,$rows['id']);
}
echo "";
}


echo "<br><p>Subject: Microprocessor<br></p>";
if(empty($mpw)){
  echo "<p style='color:red;'>No Assignments Submitted for this Subject!<p>";
}
foreach($mpw as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
echo "<p>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' target ='_blank' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
array_push($mpw,$rows['id']);
}
echo "";
}


echo "<br><p>Subject: Multimedia Systems<br></p>";
if(empty($msdw)){
  echo "<p style='color:red;'>No Assignments Submitted for this Subject!<p>";
}
foreach($msdw as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
echo "<p>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' target ='_blank' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
  array_push($msdw,$rows['id']);
}
echo "";
}


echo "<br><p>Subject: Theory of Computer Science<br></p>";
if(empty($tcsw)){
  echo "<p style='color:red;'>No Assignments Submitted for this Subject!<p>";
}
foreach($tcsw as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
echo "<p>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' target ='_blank' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
array_push($tcsw,$rows['id']);
}
echo "";
}


echo "<br><p>Subject: Web Design Lab<br></p>";
if(empty($wdlw)){
  echo "<p style='color:red;'>No Assignments Submitted for this Subject!<p>";
}
foreach($wdlw as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
echo "<p>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' target ='_blank' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br><br>";
array_push($wdlw,$rows['id']);
}
echo "";
}

 ?>
</ul>
</div>
</section>

<br><br>

<!--Submitted Assignments code ends here -->

<!--Pending Assignments code starts here -->
<section class="pend_assign">
  <div id="c1">
<ul>
<li>Pending Assignments:</li> <br>
<?php

echo "<p>Subject: Advanced Algorithm<br></p>";
if(empty($aav)){
  echo "<p style='color:red;'>No Assignments Pending for this Subject!<p>";
}
foreach($aav as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
  echo "<a class='upl' href='upload.php?id=".$row3['id']."'>Upload</a>";
}
echo "";
}



echo "4<br><p>Subject: Business Comm & Ethics<br></p>";
if(empty($bcev)){
  echo "<p style='color:red;'>No Assignments Pending for this Subject!<p>";
}
foreach($bcev as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
  echo "<a class='upl' href='upload.php?id=".$row3['id']."'>Upload</a>";
}
echo "";
}


echo "<br><p>Subject: Computer Networks<br></p>";
if(empty($cnv)){
  echo "<p style='color:red;'>No Assignments Pending for this Subject!<p>";
}
foreach($cnv as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
  echo "<a class='upl' href='upload.php?id=".$row3['id']."'>Upload</a>";

}
echo "";
}


echo "<br><p>Subject: Database Management System<br></p>";
if(empty($dbmsv)){
  echo "<p style='color:red;'>No Assignments Pending for this Subject!<p>";
}
foreach($dbmsv as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
  echo "<a class='upl' href='upload.php?id=".$row3['id']."'>Upload</a>";

}
echo "";
}


echo "<br><p>Subject: Microprocessor<br></p>";
if(empty($mpv)){
  echo "<p style='color:red;'>No Assignments Pending for this Subject!<p>";
}
foreach($mpv as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
  echo "<a class='upl' href='upload.php?id=".$row3['id']."'>Upload</a>";

}
echo "";
}


echo "<br><p>Subject: Multimedia Systems<br></p>";
if(empty($msdv)){
  echo "<p style='color:red;'>No Assignments Pending for this Subject!<p>";
}
foreach($msdv as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
  echo "<a class='upl' href='upload.php?id=".$row3['id']."'>Upload</a>";
}
echo "";
}


echo "<br><p>Subject: Theory of Computer Science<br></p>";
if(empty($tcsv)){
  echo "<p style='color:red;'>No Assignments Pending for this Subject!<p>";
}
foreach($tcsv as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
  echo "<a class='upl' href='upload.php?id=".$row3['id']."'>Upload</a>";
}
echo "";
}


echo "<br><p>Subject: Web Design Lab<br></p>";
if(empty($wdlv)){
  echo "<p style='color:red;'>No Assignments Pending for this Subject!<p>";
}
foreach($wdlv as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
  echo "<a class='upl' href='upload.php?id=".$row3['id']."'>Upload</a>";
}
echo "";
}

 ?>
</ul>
</div>
</section>


<!--Pending Assignments code ends here -->

</body>
</html>
