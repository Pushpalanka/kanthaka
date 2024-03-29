<?php
include('lock.php');
include('config.php');

$id = $_POST["id"]; 
$result = mysql_query("SELECT * FROM promotions WHERE name='$id'");
$row = mysql_fetch_assoc($result);

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
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<link rel="Stylesheet" href="css/jquery-ui.css" type="text/css">

	
	<link rel="Stylesheet" href="css/ui.selectmenu.css" type="text/css">
	<script type="text/javascript" src="js/ui.selectmenu.js"></script>
	<link rel="Stylesheet" href="http://jqueryui.com/themeroller/css/parseTheme.css.php?ffDefault=Verdana,Arial,sans-serif&fwDefault=normal&fsDefault=1.1em&cornerRadius=4px&bgColorHeader=cccccc&bgTextureHeader=03_highlight_soft.png&bgImgOpacityHeader=75&borderColorHeader=aaaaaa&fcHeader=222222&iconColorHeader=222222&bgColorContent=ffffff&bgTextureContent=01_flat.png&bgImgOpacityContent=75&borderColorContent=aaaaaa&fcContent=222222&iconColorContent=222222&bgColorDefault=e6e6e6&bgTextureDefault=02_glass.png&bgImgOpacityDefault=75&borderColorDefault=d3d3d3&fcDefault=555555&iconColorDefault=888888&bgColorHover=dadada&bgTextureHover=02_glass.png&bgImgOpacityHover=75&borderColorHover=999999&fcHover=212121&iconColorHover=454545&bgColorActive=ffffff&bgTextureActive=02_glass.png&bgImgOpacityActive=65&borderColorActive=aaaaaa&fcActive=212121&iconColorActive=454545&bgColorHighlight=fbf9ee&bgTextureHighlight=02_glass.png&bgImgOpacityHighlight=55&borderColorHighlight=fcefa1&fcHighlight=363636&iconColorHighlight=2e83ff&bgColorError=fef1ec&bgTextureError=02_glass.png&bgImgOpacityError=95&borderColorError=cd0a0a&fcError=cd0a0a&iconColorError=cd0a0a&bgColorOverlay=aaaaaa&bgTextureOverlay=01_flat.png&bgImgOpacityOverlay=0&opacityOverlay=30&bgColorShadow=aaaaaa&bgTextureShadow=01_flat.png&bgImgOpacityShadow=0&opacityShadow=30&thicknessShadow=8px&offsetTopShadow=-8px&offsetLeftShadow=-8px&cornerRadiusShadow=8px" type="text/css">
	

	<script type="text/javascript">
		$(function(){
			$('select').selectmenu({style:'dropdown'});
			$('.mini').datepicker();
			showBasic();
		});
	</script>
	
</head>

<body>

<div id="wrap">

	<!--Hearder-->
	<div id="header">
		<h1><a class="bg" href="#" title="Home"></a>Kanthaka Dashboard</h1>
		<p id="status">Logged in as <?php echo $login_session; ?>, <a href="logout.php" title="Sign Out?">Sign Out?</a></p>
		<h2><span>Edit Promotion</span></h2>
		<p id="description">Edit a previously added sales promotion.</p>
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
		<h2>Promotion Details</h2>
		
		<form method="post" action="success.php">
		<fieldset>
			<div id="basic">
				<label>Promotion Name:</label>
				<span class="small_input"><input class="small" name="pname" type="text" value="<?php echo $id; ?>" disabled="disabled"/></span>
				<input name="name" type="hidden" value="<?php echo $id; ?>" /><br class="hid" />
				
				<label>Promotion Type:</label>
				<select name="type"  style="width: 247px;">
					<option value="Local" <?php if ($row['type']=='Local') echo 'SELECTED'; ?> >Local</option>
					<option value="Corporate" <?php if ($row['type']=='Corporate') echo 'SELECTED'; ?> >Corporate</option>
					<option value="IDD"<?php if ($row['type']=='IDD') echo 'SELECTED'; ?> >IDD</option>
					<option value="Roaming" <?php if ($row['type']=='Roaming') echo 'SELECTED'; ?> >Roaming</option>
					<option value="Seasonal" <?php if ($row['type']=='Seasonal') echo 'SELECTED'; ?> >Seasonal</option>
				</select>
				<br class="hid" />
				
				<label>Running Period:</label>
				<input class="mini" placeholder="Start date" name="dateStart" type="text" value="<?php echo $row['start_date']; ?>"/>
				<input class="mini" placeholder="End date" name="dateEnd" type="text" value="<?php echo $row['end_date']; ?>"/>
				<p>Select Start Date & End Date of the promotion </p>
			
				<label>Description:</label><br class="hid" />
				<input class="large" name="description" type="text" value="<?php echo $row['description']; ?>"/><br class="hid" /><br class="hid" />
				
				<label>Promotion Rule:</label>
				<input class="large" name="prule" type="text" disabled="disabled" value="<?php echo $row['rule']; ?>"/>
				<input name="rule" type="hidden" value="<?php echo  $row['rule']; ?>" /><br class="hid" /><br><br><br><br><br>
			
				<a href="#" class="submit button" title="Save Promotion"><span>Save Promotion</span></a><span class="clear"></span>
				
			</div>
			
		</fieldset>
		</form>
		
	</div>
	<div id="footer">
	</div>
</div>

</body>

</html>
