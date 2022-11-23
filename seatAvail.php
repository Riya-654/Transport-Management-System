<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);
    $srn=$user_data['srn'];

    $query = "select route from registration where srn='$srn'";
    $res1 = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($res1);
    $rr=$data['route'];

    if($rr=="1"){
        $q1 = "SELECT PickUp,Time,Fee FROM r1 ORDER BY Time";
    }
    elseif($rr=="2"){
        $q1 = "SELECT PickUp,Time,Fee FROM r2 ORDER BY Time";
    }
    elseif($rr=="3"){
        $q1 = "SELECT PickUp,Time,Fee FROM r3 ORDER BY Time";
    }
    elseif($rr=="4"){
        $q1 = "SELECT PickUp,Time,Fee FROM r4 ORDER BY Time";
    
    }
    elseif($rr=="5"){
        $q1 = "SELECT PickUp,Time,Fee FROM r5 ORDER BY Time";
        
    }
    elseif($rr=="6"){
        $q1 = "SELECT PickUp,Time,Fee FROM r6 ORDER BY Time";
    
    }
    elseif($rr=="7"){
        $q1 = "SELECT PickUp,Time,Fee FROM r7 ORDER BY Time";
    
    }
    elseif($rr=="8"){
        $q1 = "SELECT PickUp,Time,Fee FROM r8 ORDER BY Time";
    }

    $res2 = mysqli_query($con, $q1);
    $res3=mysqli_query($con, $q1);


?>
<?php
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $pick = $_POST['pick'];
        $query = "update registration set pickup='$pick' where srn='$srn'";
        mysqli_query($con, $query);
        $query2 = "update registration set booked=1 where srn='$srn'";
        mysqli_query($con, $query2);
        #echo '<script>alert("Done")</script>';
        header("Location: payment.php");
    }

?>
<!DOCTYPE html>
<html>
<head>
<title>Seat availability</title>
<style>
.head{
	position: absolute;
    left: 30%;

	
 }

table {
            font-size: large;
            border: 1px solid black;
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
 
        td {
            background-color: #E4F5D4;
            border: 1px solid black;
        }
 
        th,
        td {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        td {
            font-weight: lighter;
        }
 
.dropdown {
  position: relative;
  display: inline-block;
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
<H1>Seats are Available</H1>
<H3>CHOOSE A PICKUP POINT</H3>
<center>Hello, <?php echo $user_data['srn']; ?></center><br/>

<table>
            <tr>
                <th>PICKUP POINT</th>
                <th>TIME</th>
                <th>AMOUNT</th>
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php
                // LOOP TILL END OF DATA
                while($row = mysqli_fetch_assoc($res2)) {
            ?>
            <tr>
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                <td><?php echo $row['PickUp'];?></td>
                <td><?php echo $row['Time'];?></td>
                <td><?php echo $row['Fee'];?></td>
            </tr>
            <?php
                }
            ?>
        </table><br/><br/>
<center>
    <div class="dropdown">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <select name="pick">
    <?php while($rows = mysqli_fetch_assoc($res3)) { ?>

    <option value="<?php echo $rows['PickUp'];?>"> <?php echo $rows['PickUp'];?>  </option>
           
     <?php }?>
    </select><br/><br/>
    <input type="submit" class="button" value="CONFIRM" style = "font-size:20px" />
</form>
    </div>
    </center>
    <br/><br/>
</div>

</body>
</html>


