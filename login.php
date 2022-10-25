<?php 

session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['uname'];
		$password = $_POST['psw'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//read from database
			$query = "select * from registration where srn = '$user_name' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['psw'] === $password)
					{

						$_SESSION['srn'] = $user_data['srn'];
						header("Location: index.php");
						die;
					}
				}
			}
			
			echo '<script>alert("wrong username or password")</script>';
			echo '<script type="text/javascript">';
        	echo 'window.location.href="login.html";';
        	echo '</script>';
		}else
		{
			echo '<script>alert("wrong username or password")</script>';
			echo '<script type="text/javascript">';
        	echo 'window.location.href="login.html";';
        	echo '</script>';
		}
	}

?>

