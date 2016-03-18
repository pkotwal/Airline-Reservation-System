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
?>
<html>
	<head>
		<title>flight4sure | Past Bookings</title>
		<link rel="stylesheet" href="style.css" type="text/css"/>
	</head>	
	<body>
		<header>
			<div>
				<a href="search.php">
					<div id="header_left">
						<img id="site_logo" src="logo.png"/>
						<h1 class="title">flight4sure</h1>
					</div>
				</a>
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
				<?php
				$query="SELECT * FROM `bookings` WHERE `user`='$user_id' ORDER BY `id` DESC";
				$run=mysql_query($query);
				if(mysql_num_rows($run)>0)
				{
					?>
				<table>
					<tr>
						<th>Flight Number</th>
						<th>Departs</th>
						<th>Arrives</th>
						<th>Price</th>
						<th>Date</th>
						<th>PNR</th>
					</tr>
				<?php
					while($row=mysql_fetch_assoc($run))
					{
						$qfnum=$row['flight'];
						$qprice=$row['price'];
						$qnum=$row['num'];
						$qdate=$row['date'];
						$qpnr=substr(md5($row['id']),22);
						$singlePrice=$qprice/$qnum;
						
						$query1="SELECT * FROM `flights` WHERE `id`='$qfnum'";
						$run1=mysql_query($query1);
						$qsource=mysql_result($run1,0,'source');
						$qdestination=mysql_result($run1,0,'destination');
						$qarrival=mysql_result($run1,0,'arrival');
						$qdeparture=mysql_result($run1,0,'departure');
						$qairline=mysql_result($run1,0,'airline');
						$qnumber=mysql_result($run1,0,'num');
						
						
						$query1="SELECT * FROM `airline` WHERE `id`='$qairline'";
						$run1=mysql_query($query1);
						$qcode=mysql_result($run1,0,'code');
						$qlogo=mysql_result($run1,0,'logo');
						
						?>
				<div class="single_entry">
					<tr>
						<td><?php echo"<img class='alogo' src='$qlogo' /> <h3 class='fnumber'>$qcode - $qnumber " ?></h3></td>
						<td><h3><?php echo " $qsource <br> <span class='smaller'> $qdeparture hours </span> " ?></h3></td>
						<td><h3><?php echo " $qdestination <br> <span class='smaller'> $qarrival hours </span> " ?></h3></td>
						<td><h3><?php echo " $qnum x &#8377 $singlePrice " ?></h3></td>
						<td><h3><?php echo " $qdate " ?></h3></td>
						<td><h3><?php echo " $qpnr " ?></h3></td>
					</tr>
				
				<?php
					}
					echo "</div>";
					echo "</table>";
				}
				else
				{
					echo "<h2>No Previous Bookings</h2>";
				}?>	
			</div>
			
		</section>
		<footer>
			<hr/>
			<p>&copy; 2015-2016 flight4sure</p>
		</footer>
	</body>
</html>