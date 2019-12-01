<?php 
session_start();


 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initaial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Process page</title>
  <link rel="stylesheet" type="text/css" href="usercompanst.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
        function getData(){
            $.ajax({
                type: 'POST',
                url: 'autoref.php',
                success: function(data){
                    $('#output').html(data);
                }
            });
        }
        getData();
        setInterval(function () {
            getData(); 
        }, 1000);  // it will refresh your data every 1 sec

    });
    </script>
     <script>
    $(document).ready(function(){
        function getData(){
            $.ajax({
                type: 'POST',
                url: 'moneyhacked.php',
                success: function(data){
                    $('#output2').html(data);
                }
            });
        }
        getData();
        setInterval(function () {
            getData(); 
        }, 70);  // it will refresh your data every 1 sec

    });
</script>

</head>
<style >
  
input{
  height: 5vh;
  
  font-size: 100%;
  display: flex;
  text-align:left;
}
 #Send{
  text-align: center;
  padding-left:  20px;
  padding-right: 20px;
}


.recieved{
  position: fixed;
  right: 3%;
  top: 3%;
  width: 30%;
  overflow-y: scroll;
  display: block;
  height: 45%;

}
.sent{
  position: fixed;
  right: 3%;
  bottom: 3%;
  width: 30%;
  overflow-y: scroll;
  display: block;
  height: 45%;
}
td,th{
  padding-right: 30px;

}
h4{
  padding-bottom: 15px;
  max-width: 60%;
  line-height: 26px;
  letter-spacing: 1px;
}
.money2{
  display: flex;
}

</style>
<body>
  <div id="transbox">
    <p class="user"><?php echo $_SESSION['a'], $_SESSION['a']=""; ?><br><?php echo $_SESSION['b'], $_SESSION['b']=""; ?><?php echo $_SESSION['c'], $_SESSION['c']=""; ?><?php echo $_SESSION['e'], $_SESSION['e']=""; ?></p>  
    <div class="transfer">
      <div class="balance">
      <h4>Here you can send money to other countries!<br>
        <?php 
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
                echo "<div class=money id=output></div>";
              }else { echo "<div class=money2>Your balance: "." <div class=money id=output2></div>"."$ (in billions)</div>";}
 
               ?>
             </h4>
    </div>
    <form method="post" action="xxx_upd.php">
    <input type="number" min="0" max="$_SESSION['d']" name="amount" placeholder="Amount..."><br>
    <input list="countries" name="countries" placeholder="Please select a country" ><br>
    <datalist id="countries">
      <?php 
        $conn = mysqli_connect("remotemysql.com","QThHxJOKo8","6gAhstQfGc","QThHxJOKo8");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT username,Money FROM Everything";
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
    <input type="Submit" id="Send" name="Send" value="Send">
    </form>
  </div>
  
  <table class="recieved">
    
    <tr>
    
      <th>Time</th>
      <th>From</th>
      <th>Amount (billion)</th>
      
    
  </tr>
     <?php 
  $conn = mysqli_connect("remotemysql.com","QThHxJOKo8","6gAhstQfGc","QThHxJOKo8");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT Time,Sender,Reciever,Amount FROM Money_Transfer";
$result = $conn->query($sql);


if ($result->num_rows > 0) {

while($row = $result->fetch_assoc()) {
  if($row["Reciever"] == $_SESSION['usern']){
    echo "<tr><td>" . $row["Time"]. "</td><td>" . $row["Sender"] . "</td><td>"
 . $row["Amount"]."$"."</tr></td>";
}
}


} else { echo "0 results"; }

$conn->close();
  ?>
</table>

<table class="sent">
    <p>
    <tr>
    
      <th>Time</th>
      <th>To</th>
      <th>Amount (billion)</th>
      
    
  </tr>
     <?php 
  $conn = mysqli_connect("remotemysql.com","QThHxJOKo8","6gAhstQfGc","QThHxJOKo8");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT Time,Sender,Reciever,Amount FROM Money_Transfer";
$result = $conn->query($sql);


if ($result->num_rows > 0) {

while($row = $result->fetch_assoc()) {
  if($row["Sender"] == $_SESSION['usern']){
    echo "<tr><td>" . $row["Time"]. "</td><td>". $row["Reciever"]. "</td><td>" . $row["Amount"]. "$" ."</tr></td>";
}
}


} else { echo "0 results"; }

$conn->close();
  ?>
</table>


</div>

<nav>
  <div class="logo">
    <h4><?php echo $_SESSION['usern'] ?></h4>
  </div>
  


<ul class="nav-links">
  <li><a href="process.php">Home</a></li>
  <li><a href="usercountrymatrix.php">Country Matrix</a></li>
  <li><a href="usercompan.php">Comm. pannel</a></li>
  <li><a href="nuclearreactordevelopement.php">War</a></li>
  
</ul>
<div class="burger">
  <div class="line1"></div>
  <div class="line2"></div>
  <div class="line3"></div>
</div>
</nav>
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