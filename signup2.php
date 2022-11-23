<!DOCTYPE HTML>  
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.error {
  color: #FF0000;
  font-size: 12px;
}
body {
  font-family: Arial, Helvetica, sans-serif;
  background-image:url("ap.jpg");
  background-position:center;
  background-repeat:no-repeat;
  }

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 30px;
}



/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 10px;
  margin: 3px 0 15px 0;
  display: inline-block;
  border: none;
  background:#f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

a {
  color: dodgerblue;
}


.signin {
  background-color: #f1f1f1;
  text-align: center;
}
</style>
</head>
<body> 

<?php 
session_start();

	include("connection.php");
	include("functions.php");

    $SRN=$firstName=$lastName=$gName=$gender=$dob=$email=$phn=$batch=$psw=$psw2="";
    $srnErr=$fnErr=$lnErr=$gnErr=$genErr=$dobErr=$mailErr=$phnErr=$batchErr=$pwdErr=$rpwdErr = "";

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{          
        
        if (empty($_POST["SRN"])) {
            $srnErr = "SRN is required";} 
        else {
          $SRN=$_POST["SRN"];
          $query = "select * from registration where srn = '$SRN' limit 1";
          $result = mysqli_query($con, $query);
          $user_data = mysqli_fetch_assoc($result);
          //echo "query:  " .$result;

          if($user_data){
            $srnErr = "An account with this srn already exists";}
          $pattern='/PES[123]UG\d{2}..\d{3}/i';
          $SRN=test_input($_POST['SRN']);
          if(!preg_match($pattern,$SRN)){
              $srnErr = "Format of SRN is wrong";}            
          }

        if(empty($_POST['firstName'])){
            $fnErr="First Name is required";
        }else{
            $firstName=test_input($_POST['firstName']);
        }

        if(empty($_POST['lastName'])){
            $lnErr="Last Name is required";
        }else{
            $lastName=test_input($_POST['lastName']);
        }

        if(empty($_POST['gName'])){
            $gnErr="Guardian Name is required";
        }else{
            $gName=test_input($_POST['gName']);
        }
                
        if(empty($_POST['gender'])){
            $genErr="Gender is required";
        }else{
            $gender=$_POST['gender'];
        }

        if(empty($_POST['dob'])){
            $dobErr="Date of Birth is required";
        }else{
            $dob=$_POST['dob'];
        }
        
        if(empty($_POST['email'])){
            $mailErr="Email ID is required";
        }else{
            $email=test_input($_POST['email']);
            $pattern='/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix';
            if(!preg_match($pattern,$email)){
                $mailErr = "Invalid email ID";
            }
        }

        if(empty($_POST['phn'])){
            $phnErr="Phone No. is required";
        }else{
            $phn=$_POST['phn'];
            $pattern='/[9876]\d{9}/';
            if(!preg_match($pattern,$phn)){
                $phnErr = "Invalid phone no.";
            }
        }

        if(empty($_POST['batch'])){
            $batchErr="Batch is required";
        }else{
            $batch=$_POST['batch'];
        }

        if(empty($_POST['psw'])){
            $pwdErr="Password is required";
        }else{
            $psw=test_input($_POST['psw']);
            if(strlen($psw)<8){
                $pwdErr="Password should be of 8 characters atleast";
            }
        }

        if(empty($_POST['psw2'])){
            $rpwdErr="Enter the Password Again";
        }else{
            $psw2=test_input($_POST['psw2']);
            if($psw2!=$psw){
                $rpwdErr="Passwords don't match";
            }
        }

        if(empty($srnErr) && empty($fnErr) && empty($lnErr) && empty($gnErr) && empty($genErr) && empty($dobErr) && empty($mailErr) && empty($phnErr) && empty($batchErr) && empty($pwdErr) && empty($rpwdErr)){
            $query = "insert into registration(srn,firstName,lastName,gName,gender,dob,email,phn,batch,psw) values('$SRN','$firstName','$lastName','$gName','$gender','$dob','$email','$phn','$batch','$psw')";
			mysqli_query($con, $query);
			echo '<script>alert("Registration Successful!")</script>';
			//header("Location: login.html");
			echo '<script type="text/javascript">';
        	echo 'window.location.href="login.html";';
        	echo '</script>';
			die;
        }
       
        
	}
?>


<form id="reg-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <p class="error">* All Fields are Required</p>
    <hr>

    <div class="form-group">
        <label for="SRN">SRN</label>&nbsp<span class="error">* <?php echo $srnErr;?></span>
        <input
          type="text"
          class="form-control"
          id="SRN"
          name="SRN"
          value="<?php echo $SRN;?>"
        />
        
  </div>
  <br>
  <div class="form-group">
    <label for="firstName">First Name</label>&nbsp<span class="error">* <?php echo $fnErr;?></span>
    <input
      type="text"
      class="form-control"
      id="firstName"
      name="firstName"
      value="<?php echo $firstName;?>"
    />
  </div>
  <br>
  <div class="form-group">
    <label for="lastName">Last Name</label>&nbsp<span class="error">* <?php echo $lnErr;?></span>
    <input
      type="text"
      class="form-control"
      id="lastName"
      name="lastName"
      value="<?php echo $lastName;?>"
    />
  </div>
  <br>
  <div class="form-group">
    <label for="gName">Guardian Name</label>&nbsp<span class="error">* <?php echo $gnErr;?></span>
    <input
      type="text"
      class="form-control"
      id="gName"
      name="gName"
      value="<?php echo $gName;?>"
    />
  </div>
  <br>
  <div class="form-group">
    <label for="gender">Gender</label>&nbsp<span class="error">* <?php echo $genErr;?></span>
    <div>
      <label for="male" class="radio-inline"
        ><input
          type="radio"
          name="gender"
          value="m"
          id="male"
        />Male</label
      >
      <label for="female" class="radio-inline"
        ><input
          type="radio"
          name="gender"
          value="f"
          id="female"
        />Female</label
      >
      <label for="others" class="radio-inline"
        ><input
          type="radio"
          name="gender"
          value="o"
          id="others"
        />Others</label>
    </div>
  </div>
  <br>
  <br>
  <div class="form-group">
    <label for="DOB">DOB</label>&nbsp<span class="error">* <?php echo $dobErr;?></span>
    <input
      type="date"
      class="form-control"
      id="DOB"
      name="dob"
      value="<?php echo $dob;?>"
      />
  </div>
  <br>
  <br>
  <div class="form-group">
    <label for="email">Email</label>&nbsp<span class="error">* <?php echo $mailErr;?></span>
    <input
      type="text"
      class="form-control"
      id="email"
      name="email"
      value="<?php echo $email;?>"
    />
  </div>
  <br>

  <div class="form-group">
    <label for="number">Phone Number</label>&nbsp<span class="error">* <?php echo $phnErr;?></span>
    <input
      type="number"
      class="form-control"
      id="phn"
      name="phn"
      value="<?php echo $phn;?>"
    />
  </div>
  <br>
  <br>
  <div class="form-group">
    <label for="Batch">Batch</label>&nbsp<span class="error">* <?php echo $batchErr;?></span>
    <input
      type="number"
      class="form-control"
      id="batch"
      name="batch"
      value="<?php echo $batch;?>"
    />
  </div>
  <br>
  <br>
  <div class="form-group">
    <label for="password">Password</label>&nbsp<span class="error">* <?php echo $pwdErr;?></span>
    <input
      type="password"
      class="form-control"
      id="psw"
      name="psw"
      value="<?php echo $psw;?>"
    />
  </div>
  <br>
  <div class="form-group">
    <label for="password">Repeat Password</label>&nbsp<span class="error">* <?php echo $rpwdErr;?></span>
    <input
      type="password"
      class="form-control"
      id="psw2"
      name="psw2"
      value="<?php echo $psw2;?>"
    />
  </div>
  <br>
  <input type="submit" class="btn btn-primary" value="Register" style = "font-size:20px" />
</form>

</body>
</html>
