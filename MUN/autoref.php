<?php 
session_start();

  $conn = mysqli_connect("remotemysql.com","QThHxJOKo8","6gAhstQfGc","QThHxJOKo8");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT id,username,GDP,Money  FROM Everything";
$result = $conn->query($sql);
  $idnum=$_SESSION["id"];


if ($result->num_rows > 0) {

while($row = $result->fetch_assoc()) {
  if ($row["username"] == $_SESSION["usern"]) {
   
  
  $_SESSION["GDP"]=$row["GDP"];
  $_SESSION["Money"]=$row["Money"];
  

	echo "Your balance: ".$row["Money"]."$ (in billions)";


}
}


} else { echo "0 results"; }
$conn->close();
  ?>
