<?php 
session_start();
$user=$_SESSION['usern'];
$currenttime=date("H:i:s");
  $conn = mysqli_connect("remotemysql.com","QThHxJOKo8","6gAhstQfGc","QThHxJOKo8");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    } 
    $sql = "SELECT Time,Countries,onoff FROM Cyber_attack WHERE Countries='$user'";
  $result = $conn->query($sql);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
   if($row["Countries"]== $user){
   	if(($row["Time"]-$currenttime)<00:00:10){
   		$command=mysqli_query($conn,"UPDATE Cyber_attack SET onoff=0 WHERE Countries='$user'");
   	}
    }
 }
}


?>