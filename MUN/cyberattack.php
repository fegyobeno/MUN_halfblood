<?php session_start(); 

$notpermanentwar_group = $_GET["war_group"];



?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body{
  background-image: url(https://wallpaperaccess.com/full/204728.jpg);
  background-repeat: no-repeat;
  background-color: #cccccc;
  height: 100%;
  
  background-repeat: no-repeat;
  background-size: cover;
  
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
  border-right:1px solid #bbb;
}

li:last-child {
  border-right: none;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color: #111;
}

.active {
  background-color: #800000;
}
</style>
</head>
<body>



<ul>
  <li><a href="process.php">HOME</a></li>
  <li><a <?php if ($notpermanentwar_group==1) {echo "class=\"active\"";} ?> href="nuclearreactordevelopement.php?war_group=1">Nuclear reactor developement</a></li>
  <li><a <?php if ($notpermanentwar_group==2) {echo 'class="active"';} ?> href="nuclearreactordevelopement.php?war_group=2">Nuclear bomb developement</a></li>
  <li><a <?php if ($notpermanentwar_group==3) {echo 'class="active"';} ?> href="nuclearreactordevelopement.php?war_group=3">Quantum computer developement</a></li>
  <li><a <?php if ($notpermanentwar_group==4) {echo "class=\"active\"";} ?> href="armament.php?war_group=4">Armament</a></li>
  <li><a href="cyberattack.php">Cyber Attack</a></li>
  <li style="float:right"><a href="#about">Surrender</a></li>
</ul>


<p><?php echo $_SESSION['underattack'], $_SESSION['underattack']=""; ?><br><?php echo $_SESSION['valid'], $_SESSION['valid']=""; ?></p>
 <form method="post" action="cyber_upd.php">
   
   <input list="countries" name="countries" placeholder="Please select a country" ><br>
   <datalist list="countries" name="countries" id="countries">

      <?php 
        $conn = mysqli_connect("remotemysql.com","QThHxJOKo8","6gAhstQfGc","QThHxJOKo8");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT username FROM Everything";
$result = $conn->query($sql);
if ($result->num_rows > 0) {

while($row = $result->fetch_assoc()) {
  if ($row["username"] != $_SESSION['usern']) {
    # code...
  
echo "<option value=$row[username]>";
}
}
} else { echo "0 results"; }
$conn->close();
       ?>

    </datalist>
    <button type="submit" class="attackbtn" name="attackbtn">Submit Attack</button>
 </form>

</body>
</html>
