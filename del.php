<?php
	require('connect.inc.php');

session_start();
if(isset($_SESSION['airline_admin']) && !empty($_SESSION['airline_admin']))
{
	$airline_admin=$_SESSION['airline_admin'];
}
else
{
	header('Location: search.php');
}

	if(isset($_POST['flightId']) && !empty($_POST['flightId']))
	{
		$id=$_POST['flightId'];
		$query1="SELECT * FROM `flights` WHERE `id`='$id'";
		$run1=mysql_query($query1);
		if(mysql_num_rows($run1)>0){
			$airline=mysql_result($run1,0,'airline');
			$flight=mysql_result($run1,0,'num');
			$arrival=mysql_result($run1,0,'arrival');
			$departure=mysql_result($run1,0,'departure');
			$seats=mysql_result($run1,0,'seats');
			$avail=mysql_result($run1,0,'avail');
			$price=mysql_result($run1,0,'price');
			$source=mysql_result($run1,0,'source');
			$destination=mysql_result($run1,0,'destination');

			$query="SELECT * FROM `airline` WHERE `id`='$airline'";
			$run=mysql_query($query);
			$air=mysql_result($run,0,'name');
			$code=mysql_result($run,0,'code');

		}
	}
if($_SERVER['REQUEST_METHOD']==='POST'){
	if(isset($_POST['cancel'])){
		header('Location:airline.php');
	}else if(isset($_POST['delete']) && isset($_POST['flightId'])){
		$q="UPDATE `flights` SET `del`=1 WHERE `id`='$id'";
		mysql_query($q);
		header('Location:airline.php');
	}
}

?>

<html>

	<head>
		<title>flight4sure | Delete Flight</title>
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
				<h2 class="center">Flight Details</h2>
				<table>
					<tr>
						<td>
							<h4><span class="color">From</span><?php echo" $source " ?></h4>
						</td>
						<td>
							<h4><span class="color">To</span><?php echo" $destination " ?></h4>
						</td>
					</tr>
					<tr>
						<td>
							<h4><span class="color">Departure Time</span><?php echo" $departure hours " ?></h4>
						</td>
						<td>
							<h4><span class="color">Arrival Time</span><?php echo" $arrival hours " ?></h4>
						</td>
					</tr>
					<tr>
						<td>
							<h4><span class="color">Price</span><?php echo" &#8377 $price " ?></h4>
						</td>
						<td>
							<h4><span class="color">Flight Number</span><?php echo" $code-$flight " ?></h4>
						</td>
					</tr>
					<tr>
						<td>
							<h4><span class="color">Total Capacity</span><?php echo" $seats " ?></h4>
						</td>
						<td>
							<h4><span class="color">Seats Available</span><?php echo" $avail " ?></h4>
						</td>
					</tr>
				</table>
				
				<form action="del.php" method="post">
					<input type="submit" class="button del" name='cancel' value="Cancel"/>
					<input type="submit" class="button_del del" id="del" name='delete' value="Delete Flight"/>
					<input type="hidden" name="flightId" value="<?php echo $id ?>" >
				</form>
			</div>
			
		</section>
		
		<footer>
			<hr/>
			<p>&copy; 2015-2016 flight4sure</p>
		</footer>
	</body>

</html>