<?php
	require('connect.inc.php');
session_start();
if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
{
	$user_id=$_SESSION['user_id'];
}
else
{
	header('Location: login.php');
}
	if(isset($_POST['number']) && !empty($_POST['number']) && isset($_POST['type']) && !empty($_POST['type']) && isset($_POST['price']) && !empty($_POST['price']) && isset($_POST['flight']) && !empty($_POST['flight']) && isset($_POST['num']) && !empty($_POST['num']) && isset($_POST['date']) && !empty($_POST['date']))
	{
			$type=$_POST['type'];
			$number=$_POST['number'];
			$price=$_POST['price'];
			$flight=$_POST['flight'];
			$num=$_POST['num'];
			$date=$_POST['date'];
		
		$query= "INSERT INTO `bookings` VALUES('','$number','$type','$flight','$price','$num','$user_id','$date')";
		$result=mysql_query($query);
		
		$q="SELECT `id` FROM `bookings` ORDER BY `id` DESC LIMIT 1";
		$r=mysql_query($q);
		$pnr=md5(mysql_result($r,0,'id'));
		
		$update="UPDATE `flights` SET `avail`=`avail`-'$num' WHERE `id`='$flight'";
		mysql_query($update);
	}
?>

<html>

	<head>
		<title>flight4sure | Thank You</title>
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
			
			<div id="thank_div">
				<h1 class="center"> Your PNR is : <?php echo substr($pnr,22); ?></h1>
				Thank You.Your Payment of <?php echo" &#8377 $price "?> was successsful.<br> Your Flight has been booked .
				Have a pleasant journey.<br><br>
				<a href="search.php"><button class="button">Go back to home page</button></a>
			</div>
			
		</section>
		
		<footer>
			<hr/>
			<p>&copy; 2015-2016 flight4sure</p>
		</footer>
	</body>

</html>