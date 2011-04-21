<?php
include ('/config/database.php');
if(!isset($_SESSION['SessionStarted']))
{
	session_start();
	$_SESSION['SessionStarted'] = 1;
}
?>

<?xml version = "1.0" encoding = "utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="/css/styles.css" rel="stylesheet" type="text/css" />
		<title>J2 Forum</title>
	</head>

	<body>
		<table width="1000" align="center" class="main_container">
			<tr>
				<td width="234"><a href="/"><img src="/images/logo.png" alt="Logo" width="234" height="120" /></a></td>
				<td width="766" align="center">
					<h1>Welcome to J2 Forum!</H1>
					<h3>All times on this forum are posted in GMT.</h3>
				</td>
			<tr>

			<tr>
				<td colspan="2" align="center" class="navigation_bar">
<?php
if(isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] == 1)
{
?>
					<h3 class="navigation_bar">Welcome back, <?php echo $_SESSION['UserName'] ?>!</H3>
					<h4 class="navigation_bar"><a href="/" class="navigation_bar">Home</a> | <a href="/forum.php" class="navigation_bar">Forum</a> | <a href="/control_panel.php" class="navigation_bar">User Control Panel</a> | <a href="/help.php" class="navigation_bar">Help</a> | <a href="/about.php" class="navigation_bar">About Us</a> | <a href="/functions/logout_action.php" class="navigation_bar">Logout</a></h4>
<?php 
} else
{
?>
					<h4 class="navigation_bar"><a href="/" class="navigation_bar">Home</a> | <a href="/forum.php" class="navigation_bar">Forum</a> | <a href="/help.php" class="navigation_bar">Help</a> | <a href="/about.php" class="navigation_bar">About Us</a></h4>

					<form name="Login" action="/functions/login_action.php" method="post">
						Username:<input name="UserName" type="text" size="10" maxlength="20" />
						Password:<input name="Password" type="password" size="10" maxlength="20" />
						<input type="submit" value="Login" />
						<input type="reset" value="Reset" />
						<a href="/registration.php" class="navigation_bar">First Time User?</a>
					</form>
<?php
}
?>
					
				</td>
			<tr>
			<td colspan="2"  align="center">
