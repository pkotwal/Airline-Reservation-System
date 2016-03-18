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


		if(isset($_POST['flight_num']) && !empty($_POST['flight_num']) && isset($_POST['flight_sou']) && !empty($_POST['flight_sou']) && 					isset($_POST['flight_des']) && !empty($_POST['flight_des']) && isset($_POST['flight_dep']) && !empty($_POST['flight_dep']) && 					isset($_POST['flight_arr']) && !empty($_POST['flight_arr']) && isset($_POST['flight_cap']) && !empty($_POST['flight_cap']) && 					isset($_POST['flight_pri']) && !empty($_POST['flight_pri']) && isset($_POST['flightId']) && !empty($_POST['flightId']))
	{
		$fnum=mysql_real_escape_string($_POST['flight_num']);
		$farr=mysql_real_escape_string($_POST['flight_arr']);
		$fdep=mysql_real_escape_string($_POST['flight_dep']);
		$fdes=mysql_real_escape_string($_POST['flight_des']);
		$fsou=mysql_real_escape_string($_POST['flight_sou']);
		$fcap=mysql_real_escape_string($_POST['flight_cap']);
		$fpri=mysql_real_escape_string($_POST['flight_pri']);
			$id=$_POST['flightId'];
		
		$query3="UPDATE `flights` SET `num`='$fnum',`source`='$fsou',`destination`='$fdes',`departure`='$fdep',`arrival`='$farr',`seats`='$fcap',`price`='$fpri' WHERE `id`='$id'";
		mysql_query($query3);
			header('Location:airline.php');
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
			$price=mysql_result($run1,0,'price');
			$source=mysql_result($run1,0,'source');
			$destination=mysql_result($run1,0,'destination');

			$query="SELECT * FROM `airline` WHERE `id`='$airline'";
			$run=mysql_query($query);
			$air=mysql_result($run,0,'name');
			$code=mysql_result($run,0,'code');

		}
	}

?>

<html>

	<head>
		<title>flight4sure | Edit Flight Details</title>
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
				<h2 class="center">Flight Details</h2>
				
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
						<form action="edit.php" method="post">
							<td><?php echo "<b>$code -</b>  "; ?><input required name="flight_num" class="ins_inp" type="number" max="999" min="1" placeholder="eg. 567" value="<?php echo"$flight"; ?>"/></td>
							<td><input required name="flight_sou" value="<?php echo"$source"; ?>" class="ins_inp md_inp" type="text" placeholder="City eg. Mumbai" /><br><br>
								<input required name="flight_dep" value="<?php echo"$departure"; ?>" class="ins_inp md_inp" type="text" placeholder="Time (in hrs) eg. 1400" /></td>
							<td><input required name="flight_des" value="<?php echo"$destination"; ?>" class="ins_inp md_inp" type="text" placeholder="City eg. Delhi"/><br><br>
								<input required name="flight_arr" value="<?php echo"$arrival"; ?>" class="ins_inp md_inp" type="text" placeholder="Time (in hrs) eg. 1730" /></td>
							<td><input required name="flight_cap" value="<?php echo"$seats"; ?>" class="ins_inp sm_inp" type="number" placeholder="eg. 350" min="50"/></td>
							<td>&#8377;&nbsp;<input required  name="flight_pri" value="<?php echo"$price"; ?>" class="ins_inp sm_inp" type="number" min="100" placeholder="eg. 5000"/></td>
							<td><input type="submit" class="button_ins" value="Save Changes"/>
								<input type="hidden" name="flightId" value="<?php echo $id ?>" ></td>
						</form>
					</tr>
				</table>
				<form action="del.php" method="post">
					<input type="submit" class="button_del" id="del" value="Delete Flight"/>
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