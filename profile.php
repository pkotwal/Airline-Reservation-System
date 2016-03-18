<?php
	require('connect.inc.php');

session_start();
$name="";
$email="";
$pass="";
if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
{
	$user_id=$_SESSION['user_id'];
	$query="SELECT * FROM `users` WHERE `id`='$user_id'";
	$run=mysql_query($query);
	$name=mysql_result($run,0,'name');
	$email=mysql_result($run,0,'email');
	$pass=mysql_result($run,0,'password');
}
else
{
	header('Location: login.php');
}

	$valid=true;
	
	if(isset($_POST['ch_name']) && isset($_POST['ch_email'])){
		$name1=mysql_real_escape_string($_POST['ch_name']);
		$email1=mysql_real_escape_string($_POST['ch_email']);

		$query1="SELECT * FROM `users` WHERE `email`='$email1'";
			$run1=mysql_query($query1);
			$num=mysql_num_rows($run1);
		if($num>0)
		{
			$id=mysql_result($run1,0,'id');
	
		}
		if($num==0 || ($num==1 && $id==$user_id)){
			$query2="UPDATE `users` SET `name`='$name1',`email`='$email1' WHERE `id`='$user_id'";
			$run2=mysql_query($query2);
			}else
			{
				$valid=false;
				$message="E-mail ID already exixts";
			}
	}

	if(isset($_POST['ch_old_pass']) && isset($_POST['ch_new_pass']) && isset($_POST['ch_new_re_pass'])){
		$pass1=mysql_real_escape_string($_POST['ch_old_pass']);
		$pass2=mysql_real_escape_string($_POST['ch_new_pass']);
		$pass3=mysql_real_escape_string($_POST['ch_new_re_pass']);

		if($pass==md5($pass1) && $pass2==$pass3){
			$p=md5($pass2);
			$query3="UPDATE `users` SET `password`='$p' WHERE `id`='$user_id'";
			$run3=mysql_query($query3);
		}
		else
			{
				$valid=false;
				$message="Incorrect Passwords";
			}
	}

	
?>

<html>

	<head>
		<title>flight4sure | Confirm Booking</title>
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
			
			<div id="confirm_div">
				<h3 style="color:red; margin-top:25px;"><?php if($valid==false){echo $message;} ?></h3>
					<form name="edit_det" action="profile.php" method="post">
						<input type="text" class="login_input" name="ch_name" placeholder="Name" value="<?php echo $name ?>" required/><br>
						<input type="email" class="login_input" name="ch_email" placeholder="E-mail" value="<?php echo $email ?>" required/><br>
						<input class="button med_search" type="submit" value="Edit Details"/>
					</form>
				
					<form action="profile.php" method="post">
						<input type="password" class="login_input" name="ch_old_pass" placeholder="Previous Password" required/></br>
						<input type="password" class="login_input" name="ch_new_pass" placeholder="New Password" required/></br>
						<input type="password" class="login_input" name="ch_new_re_pass" placeholder="Re-enter New Password" required/></br>
						<input class="button med_search" type="submit" value="Change Password"/>
					</form>
	
					<form action="search.php" method="post">
						<input class="button_del del" type="submit" value="Delete Account"/><br>
						<input type="hidden" name="del" value="delete"/>
						(Action is permanent)
					</form>
			</div>
			
		</section>
		
		<footer>
			<hr/>
			<p>&copy; 2015-2016 flight4sure</p>
		</footer>
	</body>

</html>