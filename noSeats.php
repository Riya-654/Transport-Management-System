<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);
    $srn=$user_data['srn'];
    $rr=$user_data['route'];


   

?>

<?php
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        header("Location: login.html");
    }

?>

<!DOCTYPE html>
<html>
<head>
<title>Seat Reservation</title>
<style>
.head{
	position: absolute;
    left:5%;
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
<H1>SEATS OF THIS ROUTE HAVE BEEN COMPLETELY BOOKED</H1>
<p>Currently there are no seats available for selected route. Please select another route number or click on the notify button to get notified when alternate arrangements are made.</p>





<center><button onClick="myFunction1()" class="button">CHANGE ROUTE NUMBER</button></center><br/>
<center><button onClick="myFunction2()" class="button">NOTIFY ME</button></center>






</div>
<script>
  function myFunction1() {
    window.location.href="index.php";  
  }

  function myFunction2() {
    window.location.href="thankyou.html";  
  }
</script> 
</body>
</html>