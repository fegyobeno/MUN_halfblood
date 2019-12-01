<?php 
session_start();

  date_default_timezone_get('Hungary,Budapest');
  $target=$_POST['countries'];
  $user=$_SESSION['usern'];
  $conn = mysqli_connect("remotemysql.com","QThHxJOKo8","6gAhstQfGc","QThHxJOKo8");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    } 
    if( ($target == "UK") or ($target == "France") or ($target == "Russia") or ($target == "USA") or ($target == "Sweden") or ($target == "Netherlands") or ($target == "Switzerland") or ($target == "PRC") or ($target == "DPRK") or ($target == "Iran") or ($target == "Italy") or ($target == "Canada") or ($target == "Germany") or ($target == "UAE") or ($target == "Japan")){
  $sql = "SELECT username,Money FROM Everything";
  $result = $conn->query($sql);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
   if($row["username"]== $user){
    $oldmoney= $row["Money"];
    $newmoney=($oldmoney-200);
 }

}
}else { echo "0 results"; }
 $time=date("H:i:s");
 $sql2 = "SELECT Time,Countries,onoff FROM Cyber_attack WHERE Countries='$target'";
  $result = $conn->query($sql2);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()){
  if($row["onoff"] != 1){
    if($row["countries"] != $user){
  $command = mysqli_query($conn, "UPDATE Everything SET Money=$newmoney WHERE username='$user'");
  $command2 = mysqli_query($conn, "UPDATE Cyber_attack SET onoff=1 WHERE Countries='$target'");
  $command3 = mysqli_query($conn, "UPDATE Cyber_attack SET Time='$time' WHERE Countries='$target'");
}
}else $_SESSION['underattack']="This country is already under attack!";
}
}
}else $_SESSION['valid']="Please select a valid country!";

header("Location:cyberattack.php");
$conn->close();

 ?>