<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>



<!DOCTYPE html>
<html>
<head>
<title>Seat availability</title>
<style>
.head{
	position: absolute;
    left: 20%;
 }

 
        h1 {
            text-align: center;
            color: #006600;
            font-size: xx-large;
            font-family: 'Gill Sans', 'Gill Sans MT',
            ' Calibri', 'Trebuchet MS', 'sans-serif';
        }
        h3{
            text-align: center;
            color: #00cc66;
            font-family: 'Gill Sans', 'Gill Sans MT',
            ' Calibri', 'Trebuchet MS', 'sans-serif';
        }
.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}


</style>
</head>
<body bgcolor="#f0f0f0">
<div class="head">
<H1>PAYMENT SUCCESSFULL</H1>
<H3>Confirm the Payment with the accounts department of the college and Collect Bus Pass!!</H3>

<center><button onClick="myFunction1()" class="button">LOG OUT</button></center>

</div>
<script>
  function myFunction1() {
    window.location.href="login.html";  
  }
</script> 
</body>
</html>