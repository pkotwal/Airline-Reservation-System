<?php
	require('connect.inc.php');
	session_start();

if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
{
	header('Location: search.php');
}
else
{
	$login_error=false;
	$message="";
	$n="";
	$e="";
	if(isset($_POST['login_email']) && isset($_POST['login_password'])){
		$login_email=mysql_real_escape_string($_POST['login_email']);
		$login_pass=mysql_real_escape_string($_POST['login_password']);
		$password=md5($login_pass);
		$query2="SELECT * FROM `users` WHERE `email`='$login_email' AND `password`='$password'";
		$run2=mysql_query($query2);
		$num2=mysql_num_rows($run2);
		if($num2==1){
			$id=mysql_result($run2,0,'id');
			$role=mysql_result($run2,0,'role');
			if($role!=0){
				$_SESSION['airline_admin']=$role;
			}
			$_SESSION['user_id']=$id;
			header('Location: search.php');
		}else{
			$login_error=true;
		}
	}
	
	$valid=true;
	
	if(isset($_POST['reg_name']) && isset($_POST['reg_email']) && isset($_POST['reg_pass']) && isset($_POST['reg_re_pass'])){
		$name=mysql_real_escape_string($_POST['reg_name']);
		$email=mysql_real_escape_string($_POST['reg_email']);
		$re_pass=mysql_real_escape_string($_POST['reg_re_pass']);
		$pass=mysql_real_escape_string($_POST['reg_pass']);

		if($re_pass===$pass){
			$password=md5($pass);
			$query="SELECT * FROM `users` WHERE `email`='$email'";
			$run=mysql_query($query);
			$num=mysql_num_rows($run);
			if($num==0){
				$query1="INSERT INTO `users` VALUES('','$name','$email','$password','0')";
				mysql_query($query1);
				
				$query2="SELECT * FROM `users` WHERE `email`='$email' AND `password`='$password'";
				$run2=mysql_query($query2);
				$num2=mysql_num_rows($run2);
				if($num2==1){
					$id=mysql_result($run2,0,'id');
					$_SESSION['user_id']=$id;
					header('Location: search.php');
				}
			}else
			{
				$valid=false;
				$message="E-mail ID already exixts";
				$n=$name;
			}
		}else{
			$valid=false;	
			$message="Passwords do not match";
			$n=$name;
			$e=$email;
		}
	}
}
?>

<html>

	<head>
		<title>flight4sure | Login Or Register</title>
		<link rel="stylesheet" href="style.css" type="text/css"/>
	</head>

	<body>
		<header>
			<div>
			<a href="search.php"><div id="header_left">
			<img id="site_logo" src="logo.png"/>
			<h1 class="title">flight4sure</h1>
			</div></a>
			<div id="header_right">
				<ul>
					<?php 
						if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
						{
							if(isset($_SESSION['airline_admin']) && !empty($_SESSION['airline_admin']))
							{
								echo"<a href='airline.php'><li class='outer_li'>Airline Details</li></a>";
							}
							echo"<li class='outer_li account'><a href=''>Account</a><ul class='inner'>";	
							echo"<a href='previous.php'><li  class='inner_li'>View Previous Bookings</li></a>";	
							echo"<a href='profile.php'><li class='inner_li'>Edit Profile</li></a>";	
							echo"<a href='logout.php'><li class='inner_li'>Logout</li></a>";	
							echo"</ul></li>";	
						}
						else
						{
							echo"<a href='login.php'><li class='outer_li'>Login / Register</li></a>";							
						}
					?>

				</ul>
			</div>
			</div>
		</header>
		<section>
			
			<div id="login_div">
				<div id="login">
					<h2 class="center">Login</h2>
					<form name="login" action="login.php" method="post" autocomplete="off">
						<input type="email" class="login_input" name="login_email" placeholder="E-mail" required/><br>
						<input type="password" class="login_input" name="login_password" placeholder="Password" required/></br>
						<input class="button med_search" type="submit" value="Login"/>
				</form>
				<h3 style="color:red; margin-top:25px;"><?php if($login_error==true){echo "Password and E-mail ID do not match";} ?></h3>
				</div>
				
				<div id="register">
					<h2 class="center">Register</h2>
					<form name="register" action="login.php" method="post" autocomplete="off">
						<input type="text" class="login_input" name="reg_name" placeholder="Name" value="<?php echo $n ?>" required/><br>
						<input type="email" class="login_input" name="reg_email" placeholder="E-mail" value="<?php echo $e ?>" required/><br>
						<input type="password" class="login_input" name="reg_pass" placeholder="Password" required/></br>
						<input type="password" class="login_input" name="reg_re_pass" placeholder="Re-enter Password" required/></br>
						<input class="button med_search" type="submit" value="Register"/>
				</form>
				<h3 style="color:red; margin-top:25px;"><?php if($valid==false){echo $message;} ?></h3>
				</div>
				
			</div>
		</section>
		<footer>
			<hr/>
			<p>&copy; 2015-2016 flight4sure</p>
		</footer>
	</body>

</html>