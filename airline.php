<?php
	require('connect.inc.php');
session_start();
if(isset($_SESSION['airline_admin']) && !empty($_SESSION['airline_admin']))
{
	$airline_admin=$_SESSION['airline_admin'];
	
	if(isset($_POST['flight_num']) && !empty($_POST['flight_num']) && isset($_POST['flight_sou']) && !empty($_POST['flight_sou']) && 					isset($_POST['flight_des']) && !empty($_POST['flight_des']) && isset($_POST['flight_dep']) && !empty($_POST['flight_dep']) && 					isset($_POST['flight_arr']) && !empty($_POST['flight_arr']) && isset($_POST['flight_cap']) && !empty($_POST['flight_cap']) && 					isset($_POST['flight_pri']) && !empty($_POST['flight_pri']))
	{
		$fnum=mysql_real_escape_string($_POST['flight_num']);
		$farr=mysql_real_escape_string($_POST['flight_arr']);
		$fdep=mysql_real_escape_string($_POST['flight_dep']);
		$fdes=mysql_real_escape_string($_POST['flight_des']);
		$fsou=mysql_real_escape_string($_POST['flight_sou']);
		$fcap=mysql_real_escape_string($_POST['flight_cap']);
		$fpri=mysql_real_escape_string($_POST['flight_pri']);
		
		$query3="INSERT INTO `flights` VALUES ('','$fnum','$airline_admin','$fsou','$fdes','$fcap','$fcap','$fpri','$fdep','$farr','0')";
		mysql_query($query3);
	}
	
		$query="SELECT * FROM `flights` WHERE `airline`='$airline_admin' AND `del`=0 ORDER BY `id` DESC";
	$run=mysql_query($query);
	
							
	$query1="SELECT * FROM `airline` WHERE `id`='$airline_admin'";
	$run1=mysql_query($query1);
	$air=mysql_result($run1,0,'name');
	$code=mysql_result($run1,0,'code');
	$qlogo=mysql_result($run1,0,'logo');
}
else
{
	header('Location: search.php');
}
?>
<html>
	<head>
		<title>flight4sure | <?php echo $air; ?></title>
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
				<table>
					<tr>
						<th>Flight Number</th>
						<th>Departs</th>
						<th>Arrives</th>
						<th>Capacity</th>
						<th>Price</th>
						<th>Add Flight</th>
					</tr>
					<tr>
						<form action="airline.php" method="post">
							<td><?php echo "<b>$code -</b>  "; ?><input required name="flight_num" class="ins_inp" type="number" max="999" min="1" placeholder="eg. 567"/></td>
							<td><input required name="flight_sou" class="ins_inp md_inp" type="text" placeholder="City eg. Mumbai" /><br><br>
								<input required name="flight_dep" class="ins_inp md_inp" type="text" placeholder="Time (in hrs) eg. 1400" /></td>
							<td><input required name="flight_des" class="ins_inp md_inp" type="text" placeholder="City eg. Delhi"/><br><br>
								<input required name="flight_arr" class="ins_inp md_inp" type="text" placeholder="Time (in hrs) eg. 1730" /></td>
							<td><input required name="flight_cap" class="ins_inp sm_inp" type="number" placeholder="eg. 350" min="50"/></td>
							<td>&#8377;&nbsp;<input required  name="flight_pri"class="ins_inp sm_inp" type="number" min="100" placeholder="eg. 5000"/></td>
							<td><input type="submit" class="button_ins" value="Add Filght"/></td>
						</form>
					</tr>
					

				
				
				<?php
				if(mysql_num_rows($run)>0)
				{
					?>
					<tr>
						<th>Flight Number</th>
						<th>Departs</th>
						<th>Arrives</th>
						<th>Capacity</th>
						<th>Price</th>
						<th>Edit / Delete</th>
					</tr>
				<?php
					while($row=mysql_fetch_assoc($run))
					{
						$qsource=$row['source'];
						$qdestination=$row['destination'];
						$qairline=$row['airline'];	
						$qnum=$row['num'];	
						$qseats=$row['seats'];	
						$qprice=$row['price'];	
						$qarrival=$row['arrival'];	
						$qdeparture=$row['departure'];	
						$qid=$row['id'];	
						?>
				<div class="single_entry">
					<tr>
						<td><?php echo "<img class='alogo' src='$qlogo' /> <h3 class='fnumber'>$code-$qnum " ?></h3></td>
						<td><h3><?php echo "$qsource <br> $qdeparture hours" ?></h3></td>
						<td><h3><?php echo "$qdestination <br> $qarrival hours" ?></h3></td>
						<td><h3><?php echo "$qseats " ?></h3></td>
						<td><h3><?php echo " &#8377 $qprice " ?></h3></td>
						<form action="edit.php" method="post">
						<td><input type="submit" class="button_del" value="Edit / Delete"/>
							<input type="hidden" name="flightId" value="<?php echo $qid ?>" ></td>
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
