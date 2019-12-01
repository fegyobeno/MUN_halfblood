<?php 
session_start();
$conn = mysqli_connect("remotemysql.com","QThHxJOKo8","6gAhstQfGc","QThHxJOKo8");
$amount="";
$country="";
$sql="";
$_SESSION['a']="";
$_SESSION['b']="";

mysqli_close($conn);
 $conn = mysqli_connect("remotemysql.com","QThHxJOKo8","6gAhstQfGc","QThHxJOKo8");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if (isset($_POST['Send'])) {
  if ( ($_POST['countries'] == "UK") or ($_POST['countries'] == "France") or ($_POST['countries'] == "Russia") or ($_POST['countries'] == "USA") or ($_POST['countries'] == "Sweden") or ($_POST['countries'] == "Netherlands") or ($_POST['countries'] == "Switzerland") or ($_POST['countries'] == "PRC") or ($_POST['countries'] == "DPRK") or ($_POST['countries'] == "Iran") or ($_POST['countries'] == "Italy") or ($_POST['countries'] == "Canada") or ($_POST['countries'] == "Germany") or ($_POST['countries'] == "UAE") or ($_POST['countries'] == "Japan")){
  if($_POST['countries'] != $_SESSION['usern']){
    if($_POST['amount'] > 0){
      
    $conn = mysqli_connect("remotemysql.com","QThHxJOKo8","6gAhstQfGc","QThHxJOKo8");
  $amount=$_POST['amount'];
  $country=$_POST['countries'];
  $oldmoney=0;
  $oldmoney2=0;
  $messTime=date("H:i:s");
  $user=$_SESSION['usern'];


  
 $sql = "SELECT username,Money  FROM Everything WHERE username='$country'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        $oldmoney= $row["Money"];
        echo $row["Money"];
    }
    
} 
 $sql = "SELECT Money  FROM Everything WHERE username='$_SESSION[usern]'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        $oldmoney2= $row["Money"];
        $_SESSION['d']=$oldmoney2;
        echo $row["Money"];
    }
    if ($amount <= $oldmoney2) {
      $newmoney2=$oldmoney2-$amount;
          $newmoney=$oldmoney+$amount;
    }else {
      $_SESSION['c']="You do not have enough money for this action!";
    }
}
 


  
  $command = mysqli_query($conn,"UPDATE Everything SET Money=$newmoney WHERE username='$country'");
 $command2 = mysqli_query($conn,"UPDATE Everything SET Money=$newmoney2 WHERE username='$_SESSION[usern]'");
 $command3 = mysqli_query($conn,"INSERT INTO Money_Transfer (Time,Sender,Reciever,Amount) VALUES ('$messTime','$user','$country','$amount')");

}else {
    $_SESSION['a']="You have to give a valid amount!";
  }
}else{
  $_SESSION['b']="Please choose a valid Country!";
 }
  }else {
  $_SESSION['b']="Please choose a valid Country!";
 }
}
 
header("Location:usercompan.php");

$conn->close();

 ?>