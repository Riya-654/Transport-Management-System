<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

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
<label for="routes"><h1>Please select a route</h1></label>
<select name="routes" id="routes">
<option value="route1">Route 1</option>
<option value="route2">Route 2</</option>
<option value="route3">Route 3</</option>
<option value="route4">Route 4</</option>
<option value="route5">Route 5</option>
<option value="route6">Route 6</</option>
<option value="route7">Route 7</</option>
<option value="route8">Route 8</</option>
</select>
</div>
</p>
<p>
<button class="button button1"> <a href="login.html">Proceed to check seat availability</a> </button></p>

</body>
</html>










