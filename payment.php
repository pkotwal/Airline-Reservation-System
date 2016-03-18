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
	if(isset($_POST['flightId']) && !empty($_POST['flightId'])&&isset($_POST['userNum']) && !empty($_POST['userNum'])&&isset($_POST['date']) && !empty($_POST['date']))
	{
		$id=$_POST['flightId'];
		$userNum=$_POST['userNum'];
		$date=$_POST['date'];
		$query1="SELECT * FROM `flights` WHERE `id`='$id'";
		$run1=mysql_query($query1);
		$airline=mysql_result($run1,0,'airline');
		$flight=mysql_result($run1,0,'num');
		$arrival=mysql_result($run1,0,'arrival');
		$departure=mysql_result($run1,0,'departure');
		$available=mysql_result($run1,0,'avail');
		$price=mysql_result($run1,0,'price');
		$source=mysql_result($run1,0,'source');
		$destination=mysql_result($run1,0,'destination');
		
		$query="SELECT * FROM `airline` WHERE `id`='$airline'";
		$run=mysql_query($query);
		$air=mysql_result($run,0,'name');
		$code=mysql_result($run,0,'code');
		
		$n_price=$price*$userNum;
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
							<h4><span class="color">Date</span><?php echo" $date " ?></h4>
						</td>
						<td>
							<h4><span class="color">Flight Number</span><?php echo" $code-$flight " ?></h4>
						</td>
					</tr>
					<tr>
						<td>
							<h4><span class="color">Price</span><?php echo" &#8377 $n_price ($userNum X $price) " ?></h4>
						</td>
						<td>
							<h4><span class="color">Seats Available</span><?php echo" $available " ?></h4>
						</td>
					</tr>
				</table>
				
				
				
				
				
				
				
				
				
				<h2 class="center">Payment Details</h2><br>
				<form id="pay" action="thanks.php" method="post" onsubmit="return validate()">
					<input type="radio" name="type" value="credit" required/>Credit Card
					<input type="radio" name="type" value="debit" required/>Debit Card<br>
					<input type="password" id="cardNumber" name="number" maxlength="16" placeholder="Card Number" required/>
					<input type="hidden" name="price" value="<?php echo $n_price ?>"/>
					<input type="hidden" name="num" value="<?php echo $userNum ?>"/>
					<input type="hidden" name="date" value="<?php echo $date ?>"/>
					<input type="hidden" name="flight" value="<?php echo $id ?>"/>
					<input class="button" type="submit" value="Confirm Booking"/>
					
				</form>
			</div>
			
		</section>
		
		<footer>
			<hr/>
			<p>&copy; 2015-2016 flight4sure</p>
		</footer>
		
		<script type="text/javascript">
			function validate(){
				var number = document.getElementById('cardNumber').value;
				var pattern = /^[0-9]{16}$/;  
				if(number.match(pattern)) 
				{
	  				return true;
				}
				else
				{
					window.alert("Enter valid Card number");
					return false;
				}	
			}
		</script>
		
	</body>

</html>