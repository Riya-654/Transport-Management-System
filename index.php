<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);


  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    $route_no = $_POST['routes'];
    //echo "You have selected :" .$route_no;

    $query1 = "select Seats from drivers where Route_No='$route_no'";
    $res1 = mysqli_query($con, $query1);
    $data = mysqli_fetch_assoc($res1);
    $seat=$data['Seats'];
    //echo "Seats Avail :" .$seat;
    
    if($seat != 0){
      $srn=$user_data['srn'];
      $query = "update registration set route='$route_no' where srn='$srn'";
      mysqli_query($con, $query);
      header("Location: seatAvail.php");
    }
    else{
      header("Location: noSeats.php");
    }


    


  }

?>

<!DOCTYPE html>
<html>
<head>
<title>route selection</title>
<style>
.head{
	position: absolute;
	top:7%;
	left:40%;
 }
.icon{
  position: absolute;
  top: 25%;
  left:48%;
 }
.drop{
	position: absolute;
	top: 60%;
	left:42%;
}
.line{
	position: absolute;
	top: 40%;
	left:40%;
	color:"grey";
}
.button {
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 20px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
 }
 .button1 {
  background-color: white; 
  color: black; 
  border: 2px solid #c0ded9;
  position: absolute;
  top:85%;
  left:40%;
}

.button1:hover {
  background-color: #c2d4dd;
  color: white;
}
 
</style>
</head>
<body bgcolor="#f0f0f0">
<div class="head">
<H1>ROUTE SELECTION</H1>
<center>Hello, <?php echo $user_data['srn']; ?></center>
</div>
<div class="icon">
<a href="XYZUniversity_busroutes.pdf"><img src="route_icon.png" height="100px" width="100px"></a></div>
<div class="line">
<H2>Click to view route information</H2>
</div>
<p>
<div class="drop">
<form id="routeForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
<label for="routes"><h1>Please select a route</h1></label>
<center>
<select name="routes" id="routes">
<option value="1">Route 1</option>
<option value="2">Route 2</option>
<option value="3">Route 3</option>
<option value="4">Route 4</option>
<option value="5">Route 5</option>
<option value="6">Route 6</option>
<option value="7">Route 7</option>
<option value="8">Route 8</option>
</select></center><br/><br/>
<input type="submit" class="btn btn-primary" value=" Proceed to check seat availability" style = "font-size:20px" />
</form>
</div>
</p>




</body>
</html>


