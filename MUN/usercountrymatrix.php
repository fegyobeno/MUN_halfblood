<!--UPDATE `Everything` SET `Money` = '4500' WHERE `Everything`.`id` = 6;-->
<?php
  session_start();
 ?>
<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initaial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Process page</title>
  <link rel="stylesheet" type="text/css" href="usercountrymatrixst.css">
  <title>Country Matrix</title>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
        function getData(){
            $.ajax({
                type: 'POST',
                url: 'autoref.php',
                success: function(data){
                    $('#output2').html(data);
                }
            });
        }
        getData();
        setInterval(function () {
            getData(); 
        }, 1000);  // it will refresh your data every 1 sec

    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
        function getData(){
            $.ajax({
                type: 'POST',
                url: 'moneyhacked.php',
                success: function(data){
                    $('#output').html(data);
                }
            });
        }
        getData();
        setInterval(function () {
            getData(); 
        }, 50);  // it will refresh your data every 1 sec

    });
</script>
  <style>

.money2{
  
  display: flex;

}

</style>
</head>
<body>

  
  <div id="transbox">
    <h1 class="user"></h1>  
    <div class="inf">
      <p>Country: <?php echo $_SESSION["usern"]; ?>
                      
      </p>
      <p>GDP: <?php echo $_SESSION["GDP"] ?></p>
      <p><?php 
                $conn = mysqli_connect("remotemysql.com","QThHxJOKo8","6gAhstQfGc","QThHxJOKo8");
                if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
                } 
                 $user=$_SESSION['usern'];
                 $cyber=0;
                 $sql2 = "SELECT Countries,onoff FROM Cyber_attack WHERE Countries='$user'";
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {
               while($row = $result2->fetch_assoc()){
                if($row["onoff"] == 1){
                    $cyber=1;
                }else $cyber = 0;
               }
               }else echo "0 results";
               if($cyber == 0){ 
               echo "<div class=money id=output2></div>";
               }else { echo "<div class=money2>Your balance: "." <div class=money id=output></div>"."$ (in billions)</div>";}
 
               ?></p>
      </div>

    

  


</div>
</div>
<nav>
  <div class="logo">
    <h4><?php echo $_SESSION["usern"] ;?></h4>
  </div>
  
<ul class="nav-links">
  <li><a href="process.php">Home</a></li>
  <li><a href="usercountrymatrix.php">Country Matrix</a></li>
  <li><a href="usercompan.php">Comm. pannel</a></li>
  <li><a href="nuclearreactordevelopement.php?war_group=1">War</a></li>
  
</ul>
<div class="burger">
  <div class="line1"></div>
  <div class="line2"></div>
  <div class="line3"></div>
</div>
</nav>
  </div>
<?php 

$user=$_SESSION['usern'];
$currenttime=date("H:i:s");
$current=strtotime($currenttime);

  $conn = mysqli_connect("remotemysql.com","QThHxJOKo8","6gAhstQfGc","QThHxJOKo8");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    } 
    $sql = "SELECT Time,Countries,onoff FROM Cyber_attack WHERE Countries='$user'";
  $result = $conn->query($sql);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
   if($row["Countries"]== $user){
    $time=$row["Time"];
    $time2=strtotime($time);
    if((($current-$time2)/60)>20){
      $command=mysqli_query($conn,"UPDATE Cyber_attack SET onoff=0 WHERE Countries='$user'");
    }
    }
 }
}
?>
  
<script src="sidebar.js"></script>
  
</body>
</html>