<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);
    $srn=$user_data['srn'];
    $rr=$user_data['route'];


    $query = "select * from drivers where Route_No='$rr'";
    $res1 = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($res1);

    if($rr=="1"){
        $q1 = "SELECT Time,Fee FROM r1";
    }
    elseif($rr=="2"){
        $q1 = "SELECT Time,Fee FROM r2";
    }
    elseif($rr=="3"){
        $q1 = "SELECT Time,Fee FROM r3";
    }
    elseif($rr=="4"){
        $q1 = "SELECT Time,Fee FROM r4";
    
    }
    elseif($rr=="5"){
        $q1 = "SELECT Time,Fee FROM r5";
        
    }
    elseif($rr=="6"){
        $q1 = "SELECT Time,Fee FROM r6";
    
    }
    elseif($rr=="7"){
        $q1 = "SELECT Time,Fee FROM r7";
    
    }
    elseif($rr=="8"){
        $q1 = "SELECT Time,Fee FROM r8";
    }

    $res2 = mysqli_query($con, $q1);
    $data1 = mysqli_fetch_assoc($res2);

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
<title>Reservation Details</title>
<style>
.head{
	position: absolute;
    left: 40%;
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
<H1>SEAT RESERVED</H1>
<H3>TRANSPORT DETAILS</H3>
<center>Student SRN: <?php echo $user_data['srn']; ?></center><br/>
<center>Student Name: <?php echo $user_data['firstName']; ?>  <?php echo $user_data['lastName']; ?></center><br/>

<center>Selected Route No.: <?php echo $user_data['route']; ?></center><br/>
<center>PickUp Point: <?php echo $user_data['pickup']; ?></center><br/>
<center>PickUp Time: <?php echo $data1['Time']; ?> am</center>

<H3>DRIVER DETAILS</H3>
<center>Driver Name: <?php echo $data['DNAME']; ?></center><br/>
<center>Driver Phone Number: <?php echo $data['PHONE_NUMBER']; ?></center><br/>

<H3>TOTAL FEES</H3>
<center>Total Amount: <?php echo $data1['Fee']; ?></center><br/>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

    <center><input type="submit" class="button" value="LOGOUT" style = "font-size:20px" /></center>

</form>



</div>

</body>
</html>