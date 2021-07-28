<!DOCTYPE html>
<html>
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
<script>
function myfunction(){
  location.reload();
}
</script>
</head>
<body>
<?php
include 'scripts/connect.php';
session_start();
$uem=$_SESSION["email"];
$name = $_SESSION["name"];
echo "<p>Welcome ".$name."</p><br>";
?>
<button type="button"><a href="scripts/logout.php">Sign Out</a></button>
<br><br>
<?php
if(!isset($_SESSION['email']))
{
    echo "login to your account";
    header("refresh:1;url=signin.php");
    exit();
}

?>
<?php
$dbh = new PDO("mysql:host=localhost;dbname=classroom","root","");
$star = $dbh-> prepare("select * from assignment");
$star->execute();
?>

<ul>
  <?php
$v = array();
while($rows = $star->fetch()){
    echo "<div class='space'><li>Subject:".$rows['subject']." </li><li>Aim: ".$rows['aim']."</li><li>Assigned By:".$rows['teacher']."</li><li>Deadline: ".$rows['date']."</li>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ? and teacher = ? and subject = ? order by subject");
$star1->bindParam(1,$rows['aim']);
$star1->bindParam(2,$uem);
$star1->bindParam(3,$rows['teacher']);
$star1->bindParam(4,$rows['subject']);
$star1->execute();
$rowi = $star1->fetch();
if(empty($rowi)){
  array_push($v,$rows['id']);
  echo "<a href='upload.php?id=".$rows['id']."'>Upload</a>
  </div>";
}
else{
  echo "<a target ='_blank' href='scripts/view.php?id=".$rowi['id']."'>".$rowi['name']."</a><br><a target ='_blank' href='scripts/delete.php?id=".$rowi['id']."'>Delete</a><br></div><br>";
}
}


?>
</ul>
<ul>
<li>Submitted Files:</li>
<?php
$stat = $dbh-> prepare("select * from storage where student = ?");
$stat->bindParam(1,$uem);
$stat->execute();
while($row2 = $stat->fetch()){
  echo "<li>Assignment Name: ".$row2['aim']."<br><a target ='_blank' href='scripts/view.php?id=".$row2['id']."'>".$row2['name']."</a><li>";
}
 ?>
</ul>

<br><br>
<ul>
<li>Pending Assignments:</li><br>
<?php
foreach($v as $item) {
  $stati = $dbh-> prepare("select * from assignment where id = ?");
  $stati->bindParam(1,$item);
  $stati->execute();
  while($row3 = $stati->fetch()){
    echo "<div class='space'><li>Subject:".$row3['subject']." </li><li>Aim: ".$row3['aim']."</li><li>Assigned By:".$row3['teacher']."</li><li>Deadline: ".$row3['date']."</li>";
$star1 = $dbh-> prepare("select * from storage where aim = ? and student = ?");
$star1->bindParam(1,$row3['aim']);
$star1->bindParam(2,$uem);
$star1->execute();
$rowi = $star1->fetch();
if(!empty($rowi)){
  echo "<a href='upload.php?id=".$row3['id']."'>Upload</a>
  </div>";
}
else{
  echo "</div>";
}
}
}
 ?>
</ul>
</body>
</html>
