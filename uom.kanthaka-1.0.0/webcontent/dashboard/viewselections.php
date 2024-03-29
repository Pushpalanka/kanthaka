<?php
include('lock.php');
include('config.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Kanthaka Dashboard</title>
	<meta http-equiv="content-language" content="en" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon"/>
	<link rel="stylesheet" href="css/styles.css" type="text/css" media="screen" />
	<!--[if lte IE 7]>
	<link href="css/styles_ie.css" rel="stylesheet" type="text/css" media="screen" />
	<![endif]-->
	<!--[if lte IE 6]>
	<link href="css/styles_ie6.css" rel="stylesheet" type="text/css" media="screen" />
	<![endif]-->
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/ui.js"></script>
	<meta HTTP-EQUIV="REFRESH" content="5; url=">
	
</head>

<body>

<div id="wrap">

	<!--Hearder-->
	<div id="header">
		<h1><a class="bg" href="#" title="Home"></a>Kanthaka Dashboard</h1>
		<p id="status">Logged in as <?php echo $login_session; ?>, <a href="logout.php" title="Sign Out?">Sign Out?</a></p>
		<h2><span>Selections</span></h2>
		<p id="description">The list of selected subscribers for promotions.</p>
	</div>
	
	<!--Side bar-->
    <div id="sidebar">
		<ul class="items">
            <li class="active">
            	<a href="#" title="Promotions">Promotions</a>
				<ul>
                    <li><a href="addpromotion.php" title="Add Promotion">Add New Promotion</a></li>
                    <li><a href="viewpromotions.php" title="View Promotions">View Promotions</a></li>
					<li><a href="viewselections.php" title="View Promotions">View Selections</a></li>
				</ul>
            </li>
			<li class="subitems">
				<a href="#" title="Users">Users</a>
				<ul>
					<li><a href="adduser.php" title="Add User">Add New User</a></li>
					<li><a href="viewusers.php" title="View Users">View Users</a></li>
				</ul>
			</li>
			<li class="subitems">
				<a href="#" title="Settings">Settings</a>
				<ul>
                    <li><a href="#" title="Configurations">Configurations</a></li>
                    <li><a href="#" title="System Settings">System Settings</a></li>
				</ul>
			</li>
			<li class="subitems">
				<a href="#" title="Support">Support</a>
				<ul>
					<li><a href="#" title="FAQ">FAQ</a></li>
					<li><a href="#" title="Get Support">Get Support</a></li>

				</ul>
			</li>
		</ul>
		<span class="clear"></span>
		<div id="redbox">
			<h4>Kanthaka</h4>
			<p>
				<big>Copyright 2012</big>
				University of Moratuwa, Sri Lanka<br />
				Version: 1.0.0
			</p>
		</div>
	</div>
	
	<!--Content-->
	<div id="content">
		<h2>Selected Subscribers</h2>
		
		<div class="box">
			<table>
				<tr>
					<th class="col1">Promotion Name</th>
					<th class="col2">Subscriber MSISDN</th>
					<th class="col3">Selected Date/Time</th>
				</tr>
				
				<?php
				
					$result = mysql_query("SELECT * FROM selectedUsers");
					
					$i=1;
					while($row = mysql_fetch_array($result))
					{
						echo '<tr '; if($i%2==0){ echo 'class="highlight"';} echo ' >';
						echo '	<td>' . $row['promotionName'] . '</td>';
						echo '	<td>' . $row['userNumber'] . '</td>';
						echo '	<td>' . $row['offerTime'] . '</td>';
						echo '</tr>';
						$i++;
					}
					
				?>
			</table>
		</div>
		<br class="hid" /><br><br>
		
	</div>
	<div id="footer">
	</div>
</div>

</body>

</html>
