<!--INSERT INTO War (Construction,Completed,Cost,Timetaken,Construction_id) VALUES ("Mining Uranium","Not Completed","1000","3","8");-->
<!--g…
Run SQL query/queries on table QThHxJOKo8.War: Documentation
UPDATE War SET Construction_id=1 WHERE Timetaken=10;
UPDATE War SET Construction_id=2 WHERE Timetaken=9;
UPDATE War SET Construction_id=3 WHERE Timetaken=8;
UPDATE War SET Construction_id=4 WHERE Timetaken=7;
UPDATE War SET Construction_id=5 WHERE Timetaken=6;
UPDATE War SET Construction_id=6 WHERE Timetaken=5;
UPDATE War SET Construction_id=7 WHERE Timetaken=4;
//$_GET["name"
-->
<?php 
session_start();
header("refresh: 30");
$notpermanentusername = $_SESSION["usern"]; 
if(isset($_GET["war_group"]))
{
  $notpermanentwar_group = $_GET["war_group"];
}
else
{
  die();
}
$connection = mysqli_connect("remotemysql.com","QThHxJOKo8","6gAhstQfGc","QThHxJOKo8");
if (!$connection) {
   die("Connection failed: " . mysqli_connect_error());
}

$command = "SELECT max(Construction_id) as maxid FROM War WHERE war_group = $notpermanentwar_group;";
$query = mysqli_query($connection,$command);
if (!$query) {
  die("Query failed: " .mysqli_error($connection) );
}
if ( $connection->affected_rows > 0 ){
  $row= $query->fetch_assoc(); 
  $max_war_stage=$row["maxid"];
}
else
{
   $max_war_stage=0;
}

function mydate($epoch){
  if ($epoch > 0){ return date('d/m/Y h:i:s', $epoch); }
  else {return "Not yet completed";}
};


//$connectionn = mysqli_connect("remotemysql.com","QThHxJOKo8","6gAhstQfGc","QThHxJOKo8");
//mysqli_close($connectionn);
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.first{
  position: all;
}

body{
  background-image: url(https://wallpaperaccess.com/full/204728.jpg);
  background-repeat: no-repeat;
  background-color: #cccccc;
  height: 100%;
  
  background-repeat: no-repeat;
  background-size: cover;
  
}

table {
  font-family: arial, sans-serif;
  color: white;
  border-collapse: collapse;
  width: 50%;
  position: relative;
  
  }

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: rgba(0,0,0,0.5);
    
}
tr:nth-child(odd) {
  background-color: #122436;
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

p {
  text-align: right;
  font-size:60px;
  margin-top: 0px;
  position: absolute;
  top: 10%;
  right: 3%;
  color: white;
}
</style>
</head>
<body id="body">



<?php
//function evolve(){
  $stage_quantity=0;
if (isset($_POST['stage1']))
{
  $nextstage = 1;
  $stage_quantity=1000;
}
elseif (isset($_POST['stage2']))
{
  $nextstage = 2;
  $stage_quantity=1000;
} 
elseif (isset($_POST['stage3']))
{
  $nextstage = 3;
  $stage_quantity=1000;
} 
elseif (isset($_POST['stage4']))
{
  $nextstage = 4;
  $stage_quantity=1000;
} 
elseif (isset($_POST['stage5']))
{
  $nextstage = 5;
} 
elseif (isset($_POST['stage6']))
{
  $nextstage = 6;
} 
elseif (isset($_POST['stage7']))
{
  $nextstage = 7;
} 
elseif (isset($_POST['stage8']))
{
  $nextstage = 8;
} 
elseif (isset($_POST['stage9']))
{
  $nextstage = 9;
} 
elseif (isset($_POST['stage10']))
{
  $nextstage = 10;
} 
elseif (isset($_POST['stage_final']))
{
  //$nextstage = 10;
  //what should we do here???
  $nextstage=0;
} 
elseif (isset($_POST['stage_ongoing']))
{
  //$nextstage = 10;
  //what should we do here???
  $nextstage=0;
} 
else
$nextstage=0;

if ($nextstage>0) {


        $query_cost = mysqli_query($connection,"SELECT Cost, Timetaken FROM War WHERE Construction_id='$nextstage' AND war_group='$notpermanentwar_group'");
        if ( $connection->affected_rows == 0 )
            {
              $message="War table is empty";
             echo "<script> alert('$message'); </script>";
            }
            
        $row= $query_cost ->fetch_assoc(); 
        $developementcost=$row["Cost"];
        $developementtime = $row["Timetaken"];

        $query = "SELECT Money FROM Everything WHERE username = '$notpermanentusername' ";
        $query_money = mysqli_query($connection,$query);
        if (!$query_money) {
              die("Query failed: " .mysqli_error($connection) );
            }
        if ( $connection->affected_rows == 0 )
            {
                            $message="MSG3".$notpermanentusername.$query;

              echo "<script> alert('$message'); </script>";
            }

        $row=$query_money ->fetch_assoc();
        $sessionmoney=$row["Money"];

        //$developementcost = (int)$developementcost;
        //$developementcost = intval($developementcost);
        //$sessionmoney = intval($_SESSION["Money"])
        $newmoney = $sessionmoney-$developementcost;
        

        if ($developementcost<$sessionmoney) {

            $completion_time = time() + $developementtime;
            $command = mysqli_query($connection,"INSERT INTO War_Country (username, Construction_id, completion_time, war_group, quantity) VALUES ('$notpermanentusername', $nextstage, $completion_time, $notpermanentwar_group,$stage_quantity) ;");
            if (!$command) {
              die("Query failed: " .mysqli_error($connection) );
            }
            $command = mysqli_query($connection,"UPDATE Everything SET Money=$newmoney WHERE username= '$notpermanentusername' ");
            if (!$command) {
              die("Query failed: " .mysqli_error($connection) );
            }
            mysqli_close($connection);
        }
        else {
          $message = "Your finantial status does not allow you this upgrade!  \\n $sessionmoney is less than $developementcost!";
          echo "<script>alert('$message');</script>";
        }
            

} // isset stage 1

//}

?>






<ul>
  <li><a href="process.php">HOME</a></li>
  <li><a <?php if ($notpermanentwar_group==1) {echo "class=\"active\"";} ?> href="nuclearreactordevelopement.php?war_group=1">Nuclear reactor developement</a></li>
  <li><a <?php if ($notpermanentwar_group==2) {echo 'class="active"';} ?> href="nuclearreactordevelopement.php?war_group=2">Nuclear bomb developement</a></li>
  <li><a <?php if ($notpermanentwar_group==3) {echo 'class="active"';} ?> href="nuclearreactordevelopement.php?war_group=3">Quantum computer developement</a></li>
  <li><a <?php if ($notpermanentwar_group==4) {echo "class=\"active\"";} ?> href="armament.php?war_group=4">Armament</a></li>
  <li><a href="cyberattack.php">Cyber Attack</a></li>
  <li style="float:right"><a href="#about">Surrender</a></li>
</ul>



<form method=post>
<div>
  <?php 
        $connection = mysqli_connect("remotemysql.com","QThHxJOKo8","6gAhstQfGc","QThHxJOKo8");
        if (!$connection) {
          die("Connection failed: " . mysqli_connect_error());
        }

        $current_phase = 1;
        $query = mysqli_query($connection,"SELECT MAX(completion_time) as maxtime FROM War_Country WHERE username='$notpermanentusername' AND war_group='$notpermanentwar_group' and Construction_id = $current_phase; ");

        if ( $connection->affected_rows == 0 )
            {
                $current_phase = 1;
            }
        $row= $query ->fetch_assoc(); 
        $completion_time=$row["maxtime"];

  if (time() > $completion_time){
        $button_name = "stage".($current_phase);
        $button_value = "Upgrade phase".($current_phase);
      }
      else
      {
        $button_name = "stage_ongoing";
        $button_value = "Still upgrading to phase".($current_phase);

      }

     echo '<input  type="submit" class="button" name="'.$button_name.'" value="'.$button_value.'">'; 

     //button 2
     $current_phase = 2;
        $query = mysqli_query($connection,"SELECT MAX(completion_time) as maxtime FROM War_Country WHERE username='$notpermanentusername' AND war_group='$notpermanentwar_group' and Construction_id = $current_phase; ");

        if ( $connection->affected_rows == 0 )
            {
                $current_phase = 1;
            }
        $row= $query ->fetch_assoc(); 
        $completion_time=$row["maxtime"];

  if (time() > $completion_time){
        $button_name = "stage".($current_phase);
        $button_value = "Upgrade phase".($current_phase);
      }
      else
      {
        $button_name = "stage_ongoing";
        $button_value = "Still upgrading to phase".($current_phase);

      }

     echo '<input  type="submit" class="button" name="'.$button_name.'" value="'.$button_value.'">';


     //button 3
     $current_phase = 3;
        $query = mysqli_query($connection,"SELECT MAX(completion_time) as maxtime FROM War_Country WHERE username='$notpermanentusername' AND war_group='$notpermanentwar_group' and Construction_id = $current_phase; ");

        if ( $connection->affected_rows == 0 )
            {
                $current_phase = 1;
            }
        $row= $query ->fetch_assoc(); 
        $completion_time=$row["maxtime"];

  if (time() > $completion_time){
        $button_name = "stage".($current_phase);
        $button_value = "Upgrade phase".($current_phase);
      }
      else
      {
        $button_name = "stage_ongoing";
        $button_value = "Still upgrading to phase".($current_phase);

      }

     echo '<input  type="submit" class="button" name="'.$button_name.'" value="'.$button_value.'">';

     //button 4
     $current_phase = 4;
        $query = mysqli_query($connection,"SELECT MAX(completion_time) as maxtime FROM War_Country WHERE username='$notpermanentusername' AND war_group='$notpermanentwar_group' and Construction_id = $current_phase; ");

        if ( $connection->affected_rows == 0 )
            {
                $current_phase = 1;
            }
        $row= $query ->fetch_assoc(); 
        $completion_time=$row["maxtime"];

  if (time() > $completion_time){
        $button_name = "stage".($current_phase);
        $button_value = "Upgrade phase".($current_phase);
      }
      else
      {
        $button_name = "stage_ongoing";
        $button_value = "Still upgrading to phase".($current_phase);

      }

     echo '<input  type="submit" class="button" name="'.$button_name.'" value="'.$button_value.'">';
  ?>
  <!--
  <input  type="submit" class="button" name="stage1" value="Phase one">
  <input  type="submit" class="button" name="stage2" value="Phase two">
  <input  type="submit" class="button" name="stage3" value="Phase three">
  <input  type="submit" class="button" name="stage4" value="Phase four">
  <input  type="submit" class="button" name="stage5" value="Phase five">
  <input  type="submit" class="button" name="stage6" value="Phase six">
  <input  type="submit" class="button" name="stage7" value="Phase seven">
  -->
</div>
</form>      

<table>
   <tr>
    
      <th>Construction Phase</th>
      <th>Cost [10^9$]</th>
      <th>Time [s]</th>
      <th>End date of the upgrade</th>
      <th>Quantity</th>
  </tr>

<?php 
  $conn = mysqli_connect("remotemysql.com","QThHxJOKo8","6gAhstQfGc","QThHxJOKo8");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "
SELECT Construction,Cost,Timetaken, completion_time as maxct, quantity as sumquantity  
FROM War LEFT OUTER JOIN 
(SELECT * FROM War_Country WHERE War_Country.username='$notpermanentusername') as wc
ON (War.war_group = wc.war_group and War.Construction_id = wc.Construction_id) 
WHERE War.war_group='$notpermanentwar_group' ";

$result = $conn->query($sql);
if (!$result) {
  die("Query failed: <br><br><br> " .mysqli_error($conn)."<br>" );
}

if ($result->num_rows > 0) {

while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["Construction"]. "</td><td>".
 $row["Cost"]. "</td><td>" . $row["Timetaken"]."</td><td>".
 mydate($row["maxct"])."</td><td>".
 $row["sumquantity"].
 "</td></tr>";
}
echo "</table>";
} else { echo "0 results"; }
$conn->close();
  ?>

</table>
<div>
<p id="Stoppwatch">Stopwatch</p>
</div>
<script>
// Set the date we're counting down to
var countDownDate = new Date("Dec 8, 2019 15:37:25").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("Stoppwatch").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("Stoppwatch").innerHTML = "End of the session";
  }
}, 1000);
</script>



<div class="logo">
    <h4><?php echo $_SESSION["usern"] ;?></h4>
  </div>
<div class="logo">
    <h4><?php echo $sessionmoney ;?></h4>
  </div>
  
  <div class="logo">
    <h4><?php echo $developementcost;?></h4>
  </div>
</body>
</html>
