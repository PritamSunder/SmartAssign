<!DOCTYPE html>
<html>
<link rel="stylesheet" href="css/ui.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
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
  <div id="parent">
    <div class="topnav">
      <div class="welcome">
      <?php
      include 'scripts/connect.php';
      session_start();
      $uem=$_SESSION["email"];
      $name = $_SESSION["name"];
      echo "<p>Welcome ".$name."</p>";
      ?></div>
      <a href="scripts/logout.php">Sign Out</a></div>
      <br><br>
      <div class="logo">
        <img src="images/ul1.png" alt="logo" style="float:left;margin-left: 30px;width:180px;">
      </div>
<?php
if(!isset($_SESSION['email']))
{
    echo "login to your account";
    header("refresh:1;url=signin.php");
    exit();
}
?>
</div>


<!--All Assignments starts here -->


<section class="all_assign">
<?php
$dbh = new PDO("mysql:host=localhost;dbname=classroom","root","");
$star = $dbh-> prepare("select * from assignment");
$star->execute();
?>
<ul>
  <div class="heading"><li>All Assignments:</li></div> <br>
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

  //Pritam's old code (kept for reference of the class elements)

  /*
  echo "<div class='alllist'><div class='space'><li>Subject: ".$rows['subject']." </li><li>Aim: ".$rows['aim']."</li><li>Assigned By: ".$rows['teacher']."</li><li>Deadline: ".$rows['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ? and teacher = ? and subject = ?");
$star1->bindParam(1,$rows['aim']);
$star1->bindParam(2,$uem);
$star1->bindParam(3,$rows['teacher']);
$star1->bindParam(4,$rows['subject']);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  array_push($v,$rows['id']);
  echo "<div class='upldel'><a class='upl' href='upload.php?id=".$rows['id']."'>Upload</a></div></div>";
}
else{
  echo "<div class='upldel'><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' target ='_blank' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br></div></div><br>";
}
*/
}

//here we are checking the arrays
echo "<div class = 'aa' style='border:2px solid black; width:900px;'><p>Subject: AA<br></p>";
if(empty($aa)){
  echo "<p style='color:red;'>No Assignments Posted for this Subject!<p></div>";
}
foreach($aa as $item)
{
$star0 = $dbh-> prepare("select * from assignment where id = ?");
$star0->bindParam(1,$item);
$star0->execute();
$rows = $star0->fetch();
echo "<div class='alllist'><div class='space'><li>Aim: ".$rows['aim']."</li><li>Assigned By: ".$rows['teacher']."</li><li>Deadline: ".$rows['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ? and teacher = ? and subject = ?");
$star1->bindParam(1,$rows['aim']);
$star1->bindParam(2,$uem);
$star1->bindParam(3,$rows['teacher']);
$star1->bindParam(4,$rows['subject']);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  array_push($aav,$rows['id']);
  echo "<div class='upldel'><a class='upl' href='upload.php?id=".$rows['id']."'>Upload</a></div></div>";
}
else{
  echo "<div class='upldel'><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' target ='_blank' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br></div></div><br></div>";
  array_push($aaw,$rows['id']);
}
}


echo "</div><br><div class = 'bce' style='border:2px solid black; width:900px;'><p>Subject: BCE<br></p>";
if(empty($bce)){
  echo "<p style='color:red;'>No Assignments Posted for this Subject!<p></div>";
}
foreach($bce as $item)
{
$star0 = $dbh-> prepare("select * from assignment where id = ?");
$star0->bindParam(1,$item);
$star0->execute();
$rows = $star0->fetch();
echo "<div class='alllist'><div class='space'><li>Aim: ".$rows['aim']."</li><li>Assigned By: ".$rows['teacher']."</li><li>Deadline: ".$rows['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ? and teacher = ? and subject = ?");
$star1->bindParam(1,$rows['aim']);
$star1->bindParam(2,$uem);
$star1->bindParam(3,$rows['teacher']);
$star1->bindParam(4,$rows['subject']);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  array_push($bcev,$rows['id']);
  echo "<div class='upldel'><a class='upl' href='upload.php?id=".$rowi['id']."'>Upload</a></div></div>";
}
else{
  echo "<div class='upldel'><p>".$rowi['status']."</p><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' target ='_blank' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br></div></div><br></div>";
  array_push($bcew,$rows['id']);
}
}


echo "</div><br><div class = 'cn' style='border:2px solid black; width:900px;'><p>Subject: CN<br></p>";
if(empty($cn)){
  echo "<p style='color:red;'>No Assignments Posted for this Subject!<p></div>";
}
foreach($cn as $item)
{
$star0 = $dbh-> prepare("select * from assignment where id = ?");
$star0->bindParam(1,$item);
$star0->execute();
$rows = $star0->fetch();
echo "<div class='alllist'><div class='space'><li>Aim: ".$rows['aim']."</li><li>Assigned By: ".$rows['teacher']."</li><li>Deadline: ".$rows['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ? and teacher = ? and subject = ?");
$star1->bindParam(1,$rows['aim']);
$star1->bindParam(2,$uem);
$star1->bindParam(3,$rows['teacher']);
$star1->bindParam(4,$rows['subject']);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  array_push($cnv,$rows['id']);
  echo "<div class='upldel'><a class='upl' href='upload.php?id=".$rows['id']."'>Upload</a></div></div>";
}
else{
  echo "<div class='upldel'><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' target ='_blank' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br></div></div><br></div>";
  array_push($cnw,$rows['id']);
}
}



echo "</div><br><div class = 'dbms' style='border:2px solid black; width:900px;'><p>Subject: DBMS<br></p>";
if(empty($dbms)){
  echo "<p style='color:red;'>No Assignments Posted for this Subject!<p></div>";
}
foreach($dbms as $item)
{
$star0 = $dbh-> prepare("select * from assignment where id = ?");
$star0->bindParam(1,$item);
$star0->execute();
$rows = $star0->fetch();
echo "<div class='alllist'><div class='space'><li>Aim: ".$rows['aim']."</li><li>Assigned By: ".$rows['teacher']."</li><li>Deadline: ".$rows['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ? and teacher = ? and subject = ?");
$star1->bindParam(1,$rows['aim']);
$star1->bindParam(2,$uem);
$star1->bindParam(3,$rows['teacher']);
$star1->bindParam(4,$rows['subject']);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  array_push($dbmsv,$rows['id']);
  echo "<div class='upldel'><a class='upl' href='upload.php?id=".$rows['id']."'>Upload</a></div></div>";
}
else{
  echo "<div class='upldel'><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' target ='_blank' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br></div></div><br></div>";
  array_push($dbmsw,$rows['id']);
}
}


echo "</div><br><div class = 'mp' style='border:2px solid black; width:900px;'><p>Subject: MP<br></p>";
if(empty($mp)){
  echo "<p style='color:red;'>No Assignments Posted for this Subject!<p></div>";
}
foreach($mp as $item)
{
$star0 = $dbh-> prepare("select * from assignment where id = ?");
$star0->bindParam(1,$item);
$star0->execute();
$rows = $star0->fetch();
echo "<div class='alllist'><div class='space'><li>Aim: ".$rows['aim']."</li><li>Assigned By: ".$rows['teacher']."</li><li>Deadline: ".$rows['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ? and teacher = ? and subject = ?");
$star1->bindParam(1,$rows['aim']);
$star1->bindParam(2,$uem);
$star1->bindParam(3,$rows['teacher']);
$star1->bindParam(4,$rows['subject']);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  array_push($mpv,$rows['id']);
  echo "<div class='upldel'><a class='upl' href='upload.php?id=".$rows['id']."'>Upload</a></div></div>";
}
else{
  echo "<div class='upldel'><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' target ='_blank' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br></div></div><br></div>";
  array_push($mpw,$rows['id']);
}
}


echo "</div><br><div class = 'msd' style='border:2px solid black; width:900px;'><p>Subject: MSD<br></p>";
if(empty($msd)){
  echo "<p style='color:red;'>No Assignments Posted for this Subject!<p></div>";
}
foreach($msd as $item)
{
$star0 = $dbh-> prepare("select * from assignment where id = ?");
$star0->bindParam(1,$item);
$star0->execute();
$rows = $star0->fetch();
echo "<div class='alllist'><div class='space'><li>Aim: ".$rows['aim']."</li><li>Assigned By: ".$rows['teacher']."</li><li>Deadline: ".$rows['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ? and teacher = ? and subject = ?");
$star1->bindParam(1,$rows['aim']);
$star1->bindParam(2,$uem);
$star1->bindParam(3,$rows['teacher']);
$star1->bindParam(4,$rows['subject']);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  array_push($msdv,$rows['id']);
  echo "<div class='upldel'><a class='upl' href='upload.php?id=".$rows['id']."'>Upload</a></div></div>";
}
else{
  echo "<div class='upldel'><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' target ='_blank' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br></div></div><br></div>";
    array_push($msdw,$rows['id']);
}
}



echo "</div><br><div class = 'tcs' style='border:2px solid black; width:900px;'><p>Subject: TCS<br></p>";
if(empty($tcs)){
  echo "<p style='color:red;'>No Assignments Posted for this Subject!<p></div>";
}
foreach($tcs as $item)
{
$star0 = $dbh-> prepare("select * from assignment where id = ?");
$star0->bindParam(1,$item);
$star0->execute();
$rows = $star0->fetch();
echo "<div class='alllist'><div class='space'><li>Aim: ".$rows['aim']."</li><li>Assigned By: ".$rows['teacher']."</li><li>Deadline: ".$rows['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ? and teacher = ? and subject = ?");
$star1->bindParam(1,$rows['aim']);
$star1->bindParam(2,$uem);
$star1->bindParam(3,$rows['teacher']);
$star1->bindParam(4,$rows['subject']);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  array_push($tcsv,$rows['id']);
  echo "<div class='upldel'><a class='upl' href='upload.php?id=".$rows['id']."'>Upload</a></div></div>";
}
else{
  echo "<div class='upldel'><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' target ='_blank' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br></div></div><br></div>";
  array_push($tcsw,$rows['id']);
}
}


echo "</div><br><div class = 'wdl' style='border:2px solid black; width:900px;'><p>Subject: WDL<br></p>";
if(empty($wdl)){
  echo "<p style='color:red;'>No Assignments Posted for this Subject!<p></div>";
}
foreach($wdl as $item)
{
$star0 = $dbh-> prepare("select * from assignment where id = ?");
$star0->bindParam(1,$item);
$star0->execute();
$rows = $star0->fetch();
echo "<div class='alllist'><div class='space'><li>Aim: ".$rows['aim']."</li><li>Assigned By: ".$rows['teacher']."</li><li>Deadline: ".$rows['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ? and teacher = ? and subject = ?");
$star1->bindParam(1,$rows['aim']);
$star1->bindParam(2,$uem);
$star1->bindParam(3,$rows['teacher']);
$star1->bindParam(4,$rows['subject']);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  array_push($wdlv,$rows['id']);
  echo "<div class='upldel'><a class='upl' href='upload.php?id=".$rows['id']."'>Upload</a></div></div>";
}
else{
  echo "<div class='upldel'><a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']   ."</a><a class='del' target ='_blank' href='scripts/delete.php?id=".$rowi['id']."'><i class='fas fa-trash'></i></a><br></div></div><br></div>";
  array_push($wdlw,$rows['id']);
}
}
echo"</div>";




?>
</ul>
</section>


<!--All Assignments code ends here -->


<!--Submitted assignments code starts -->


<section class="sub_assign">
<ul><hr>
<div class="heading"><li>Submitted Assignments:</li></div> <br>
<?php
/*Old code
$stat = $dbh-> prepare("select * from storage where student = ?");
$stat->bindParam(1,$uem);
$stat->execute();
while($row2 = $stat->fetch()){
  echo "<div class='alllist'><div class='space'><li>Subject: ".$row2['subject']." </li><li>Aim: ".$row2['aim']."</li><li>Assigned By: ".$row2['teacher']."</li><li>Deadline: ".$row2['date']."</li></div>";
  echo "<div class='upldel'><a target ='_blank' href='scripts/view.php?id=".$row2['id']."'>".$row2['name']   ."</a><a class='del' target ='_blank' href='scripts/delete.php?id=".$row2['id']."'><i class='fas fa-trash'></i></a><br></div></div><br>";

}*/
echo "<div class = 'aaw' style='border:2px solid black; width:900px;'><p>Subject: AA<br></p>";
if(empty($aaw)){
  echo "<p style='color:red;'>No Assignments Submitted for this Subject!<p></div>";
}
foreach($aaw as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<div class='alllist'><div class='space'><li>Subject: ".$row3['subject']." </li><li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  echo "<div class='upldel'><a class='upl' href='upload.php?id=".$row3['id']."'>Upload</a></div></div>";
}
else{
  echo "</div>";
}
}
}



echo "</div><br><div class = 'bcew' style='border:2px solid black; width:900px;'><p>Subject: BCE<br></p>";
if(empty($bcew)){
  echo "<p style='color:red;'>No Assignments Submitted for this Subject!<p></div>";
}
foreach($bcew as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<div class='alllist'><div class='space'><li>Subject: ".$row3['subject']." </li><li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  echo "<div class='upldel'><a class='upl' href='upload.php?id=".$row3['id']."'>Upload</a></div></div>";
}
else{
  echo "</div>";
}
}
}


echo "</div><br><div class = 'cnw' style='border:2px solid black; width:900px;'><p>Subject: CN<br></p>";
if(empty($cnw)){
  echo "<p style='color:red;'>No Assignments Submitted for this Subject!<p></div>";
}
foreach($cnw as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<div class='alllist'><div class='space'><li>Subject: ".$row3['subject']." </li><li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  echo "<div class='upldel'><a class='upl' href='upload.php?id=".$row3['id']."'>Upload</a></div></div>";
}
else{
  echo "</div>";
}
}
}


echo "</div><br><div class = 'dbmsw' style='border:2px solid black; width:900px;'><p>Subject: DBMS<br></p>";
if(empty($dbmsw)){
  echo "<p style='color:red;'>No Assignments Submitted for this Subject!<p></div>";
}
foreach($dbmsw as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<div class='alllist'><div class='space'><li>Subject: ".$row3['subject']." </li><li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  echo "<div class='upldel'><a class='upl' href='upload.php?id=".$row3['id']."'>Upload</a></div></div>";
}
else{
  echo "</div>";
}
}
}


echo "</div><br><div class = 'mpw' style='border:2px solid black; width:900px;'><p>Subject: MP<br></p>";
if(empty($mpw)){
  echo "<p style='color:red;'>No Assignments Submitted for this Subject!<p></div>";
}
foreach($mpw as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<div class='alllist'><div class='space'><li>Subject: ".$row3['subject']." </li><li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  echo "<div class='upldel'><a class='upl' href='upload.php?id=".$row3['id']."'>Upload</a></div></div>";
}
else{
  echo "</div>";
}
}
}


echo "</div><br><div class = 'msdw' style='border:2px solid black; width:900px;'><p>Subject: MSD<br></p>";
if(empty($msdw)){
  echo "<p style='color:red;'>No Assignments Submitted for this Subject!<p></div>";
}
foreach($msdw as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<div class='alllist'><div class='space'><li>Subject: ".$row3['subject']." </li><li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  echo "<div class='upldel'><a class='upl' href='upload.php?id=".$row3['id']."'>Upload</a></div></div>";
}
else{
  echo "</div>";
}
}
}


echo "</div><br><div class = 'tcsw' style='border:2px solid black; width:900px;'><p>Subject: TCS<br></p>";
if(empty($tcsw)){
  echo "<p style='color:red;'>No Assignments Submitted for this Subject!<p></div>";
}
foreach($tcsw as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<div class='alllist'><div class='space'><li>Subject: ".$row3['subject']." </li><li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  echo "<div class='upldel'><a class='upl' href='upload.php?id=".$row3['id']."'>Upload</a></div></div>";
}
else{
  echo "</div>";
}
}
}


echo "</div><br><div class = 'wdlw' style='border:2px solid black; width:900px;'><p>Subject: WDL<br></p>";
if(empty($wdlw)){
  echo "<p style='color:red;'>No Assignments Submitted for this Subject!<p></div>";
}
foreach($wdlw as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<div class='alllist'><div class='space'><li>Subject: ".$row3['subject']." </li><li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  echo "<div class='upldel'><a class='upl' href='upload.php?id=".$row3['id']."'>Upload</a></div></div>";
}
else{
  echo "</div>";
}
}
}

 ?>
</ul></section>

<br><br>

<!--Submitted Assignments code ends here -->

<!--Pending Assignments code starts here -->
<hr>
<section class="pend_assign">
<ul>
<div class="heading"><li>Pending Assignments:</li></div> <br>
<?php

echo "<div class = 'aav' style='border:2px solid black; width:900px;'><p>Subject: AA<br></p>";
if(empty($aav)){
  echo "<p style='color:red;'>No Assignments Pending for this Subject!<p></div>";
}
foreach($aav as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<div class='alllist'><div class='space'><li>Subject: ".$row3['subject']." </li><li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  echo "<div class='upldel'><a class='upl' href='upload.php?id=".$row3['id']."'>Upload</a></div></div>";
}
else{
  echo "</div>";
}
}
}



echo "</div><br><div class = 'bcev' style='border:2px solid black; width:900px;'><p>Subject: BCE<br></p>";
if(empty($bcev)){
  echo "<p style='color:red;'>No Assignments Pending for this Subject!<p></div>";
}
foreach($bcev as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<div class='alllist'><div class='space'><li>Subject: ".$row3['subject']." </li><li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  echo "<div class='upldel'><a class='upl' href='upload.php?id=".$row3['id']."'>Upload</a></div></div>";
}
else{
  echo "</div>";
}
}
}


echo "</div><br><div class = 'cnv' style='border:2px solid black; width:900px;'><p>Subject: CN<br></p>";
if(empty($cnv)){
  echo "<p style='color:red;'>No Assignments Pending for this Subject!<p></div>";
}
foreach($cnv as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<div class='alllist'><div class='space'><li>Subject: ".$row3['subject']." </li><li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  echo "<div class='upldel'><a class='upl' href='upload.php?id=".$row3['id']."'>Upload</a></div></div>";
}
else{
  echo "</div>";
}
}
}


echo "</div><br><div class = 'dbmsv' style='border:2px solid black; width:900px;'><p>Subject: DBMS<br></p>";
if(empty($dbmsv)){
  echo "<p style='color:red;'>No Assignments Pending for this Subject!<p></div>";
}
foreach($dbmsv as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<div class='alllist'><div class='space'><li>Subject: ".$row3['subject']." </li><li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  echo "<div class='upldel'><a class='upl' href='upload.php?id=".$row3['id']."'>Upload</a></div></div>";
}
else{
  echo "</div>";
}
}
}


echo "</div><br><div class = 'mpv' style='border:2px solid black; width:900px;'><p>Subject: MP<br></p>";
if(empty($mpv)){
  echo "<p style='color:red;'>No Assignments Pending for this Subject!<p></div>";
}
foreach($mpv as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<div class='alllist'><div class='space'><li>Subject: ".$row3['subject']." </li><li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  echo "<div class='upldel'><a class='upl' href='upload.php?id=".$row3['id']."'>Upload</a></div></div>";
}
else{
  echo "</div>";
}
}
}


echo "</div><br><div class = 'msdv' style='border:2px solid black; width:900px;'><p>Subject: MSD<br></p>";
if(empty($msdv)){
  echo "<p style='color:red;'>No Assignments Pending for this Subject!<p></div>";
}
foreach($msdv as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<div class='alllist'><div class='space'><li>Subject: ".$row3['subject']." </li><li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  echo "<div class='upldel'><a class='upl' href='upload.php?id=".$row3['id']."'>Upload</a></div></div>";
}
else{
  echo "</div>";
}
}
}


echo "</div><br><div class = 'tcsv' style='border:2px solid black; width:900px;'><p>Subject: TCS<br></p>";
if(empty($tcsv)){
  echo "<p style='color:red;'>No Assignments Pending for this Subject!<p></div>";
}
foreach($tcsv as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<div class='alllist'><div class='space'><li>Subject: ".$row3['subject']." </li><li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  echo "<div class='upldel'><a class='upl' href='upload.php?id=".$row3['id']."'>Upload</a></div></div>";
}
else{
  echo "</div>";
}
}
}


echo "</div><br><div class = 'wdlv' style='border:2px solid black; width:900px;'><p>Subject: WDL<br></p>";
if(empty($wdlv)){
  echo "<p style='color:red;'>No Assignments Pending for this Subject!<p></div>";
}
foreach($wdlv as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<div class='alllist'><div class='space'><li>Subject: ".$row3['subject']." </li><li>Aim: ".$row3['aim']."</li><li>Assigned By: ".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li></div>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  echo "<div class='upldel'><a class='upl' href='upload.php?id=".$row3['id']."'>Upload</a></div></div>";
}
else{
  echo "</div>";
}
}
}

 ?>
</ul></section>

<!--Pending Assignments code ends here -->

</body>
</html>
