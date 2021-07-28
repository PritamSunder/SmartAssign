<?php
$name = $_SESSION["name"];
$dbh = new PDO("mysql:host=localhost;dbname=classroom","root","");
$stmt = $dbh-> prepare("select * from logs where name = ?");
$stmt->bindParam(1,$name);
$stmt->execute();
echo "<p>Previous Records: </p>";
while($row = $sql->fetch()){
  echo "<p>".$row['assignment']."".$row['action']."on".$row['cdate']."</p><br>";
}
?>
