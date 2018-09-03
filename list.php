<?php
	require('connect.inc.php');
session_start();
	if(isset($_POST['source']) && isset($_POST['destination']) && isset($_POST['date']) && isset($_POST['number']))
	{
		$source=$_POST['source'];
		$destination=$_POST['destination'];
		$date=$_POST['date'];
		$number=$_POST['number'];
	}
?>
<html>
	<head>
		<title>flight4sure | All Flights</title>
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
			
			<div id="list_div">
				<h1 class="center big"><?php echo " $source &rarr; $destination " ?></h1>
				<h5 class="center"><?php echo " ( $number seat";if($number>1)echo"s ) "; else echo " ) "; ?></h5>
				<?php
				$query="SELECT * FROM `flights` WHERE `source`='$source' AND `destination`='$destination' AND `del`=0 ORDER BY `price` ";
				$run=mysql_query($query);
				if(mysql_num_rows($run)>0)
				{
					?>
				<table>
					<tr>
						<th>Flight Number</th>
						<th>Departure Time</th>
						<th>Arrival Time</th>
						<th>Seats Available</th>
						<th>Price</th>
						<th>Book Now</th>
					</tr>
				<?php
					while($row=mysql_fetch_assoc($run))
					{
						$qsource=$row['source'];
						$qdestination=$row['destination'];
						$qairline=$row['airline'];	
						$qnum=$row['num'];	
						$qavail=$row['avail'];	
						$qprice=$row['price'];	
						$qarrival=$row['arrival'];	
						$qdeparture=$row['departure'];	
						$qid=$row['id'];	
		
						$query1="SELECT * FROM `airline` WHERE `id`='$qairline'";
						$run1=mysql_query($query1);
						$air=mysql_result($run1,0,'name');
						$code=mysql_result($run1,0,'code');
						$qlogo=mysql_result($run1,0,'logo');
						?>
				<div class="single_entry">
					<tr>
						<td><?php echo "<img class='alogo' src='$qlogo' /> <h3 class='fnumber'>$code-$qnum " ?></h3></td>
						<td><h3><?php echo "$qdeparture hours" ?></h3></td>
						<td><h3><?php echo "$qarrival hours" ?></h3></td>
						<td><h3<?php if($number>$qavail){echo' style="color:red;"';} ?>><?php echo "$qavail " ?></h3></td>
						<td><h3><?php echo " &#8377 $qprice " ?></h3></td>
						<form action="payment.php" method="post">
						<td><input type="submit" class="button" value="Book Now" <?php if($number>$qavail){echo'disabled style="cursor:not-allowed;"';} ?> />
						<input type="hidden" name="flightId" value="<?php echo $qid ?>" >
						<input type="hidden" name="date" value="<?php echo $date ?>" >
						<input type="hidden" name="userNum" value="<?php echo $number ?>" ></td>
						</form>
					</tr>
				</div>
				
				<?php
					}
					echo "</table>";
				}
				else
				{
					echo "<h2>No Flights available</h2>";
				}?>
					
	
				
			</div>
			
		</section>
		
		<footer>
			<hr/>
			<p>&copy; 2015-2016 flight4sure</p>
		</footer>
	</body>
</html>
