<?php 
include("{$_SERVER['DOCUMENT_ROOT']}/config/database.php");
session_start();
$_SESSION['SessionStarted'] = 1;
if(isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] == 1)
{
	include("{$_SERVER['DOCUMENT_ROOT']}/header.php");
	echo('<p class="error">Sorry, but you are already logged in. Please logout before trying to login with another account.</p>');
}
else
{
extract($_POST);

$passscram= md5($Password);
$queryCheckForUsername = "SELECT UserName FROM users WHERE UserName = '".$UserName."'";
$queryCheckForPassword = "SELECT UserName FROM users WHERE UserName = '".$UserName."' AND Password = '".$passscram."'";




/*
$query = "SELECT * FROM users";
$row = (mysql_fetch_row(mysql_query($query)));
$a = $row[0];
$b = $row[1];
$c = $row[2];
$d = $row[3];
$e = $row[4];
$f = $row[5];

echo $a;
echo $b;
echo $c;
echo $d;
echo $e;
echo $f;
*/

$_SESSION['LoggedIn'] = 0;

if(mysql_fetch_row(mysql_query($queryCheckForPassword)))
{	
	// put variables from POST into SESSION (typed in when logging in)
	$_SESSION['UserName'] = $UserName;
	$_SESSION['Password'] = $Password;

	// get UserID to use later if needed
	$queryGetUserID = "SELECT UserID FROM users WHERE UserName = '".$UserName."'";
	$row = (mysql_fetch_row(mysql_query($queryGetUserID)));
	$UserID = $row[0];
	$_SESSION['UserID'] = $UserID;
	
	// get EmailAddr to use in User Control Panel
	$queryGetEmailAddr = "SELECT EmailAddr FROM users WHERE UserName = '".$UserName."'";
	$row = (mysql_fetch_row(mysql_query($queryGetEmailAddr)));
	$EmailAddr = $row[0];
	$_SESSION['EmailAddr'] = $EmailAddr;
	
	// get OrigSignup to use in User Control Panel
	$queryGetOrigSignup = "SELECT OrigSignup FROM users WHERE UserName = '".$UserName."'";
	$row = (mysql_fetch_row(mysql_query($queryGetOrigSignup)));
	$OrigSignup = $row[0];
	$_SESSION['OrigSignup'] = $OrigSignup;

	// get LastLogin to use in User Control Panel
	$queryGetLastLogin = "SELECT LastLogin FROM users WHERE UserName = '".$UserName."'";
	$row = (mysql_fetch_row(mysql_query($queryGetLastLogin)));
	$LastLogin = $row[0];
	$_SESSION['LastLogin'] = $LastLogin;
	
	// get current date and time to update new LastLogin
	$now = getdate();
	$year = $now['year'];
	$month = $now['mon'];
	$day = $now['mday'];
	$hours = $now['hours'];
	$minutes = $now['minutes'];
	$seconds = $now['seconds'];

	$_SESSION['LoggedIn'] = 1;
	include("{$_SERVER['DOCUMENT_ROOT']}/header.php");
	print("<p><span class=\"welcome\">Welcome, $UserName!  You have successfully logged in!</p>");
	
	$DateAndTime = "$year-$month-$day  $hours:$minutes:$seconds";
	//print("<span class=\"congrats\">current date/time: " . $DateAndTime . " (GMT)</span>");	
	print("<br/><span class=\"welcome\">Previous login: " . $LastLogin . " (GMT)</span>");

	$queryUpdateLastLogin = "UPDATE users SET LastLogin = '".$DateAndTime."' WHERE UserName = '".$UserName."'";
	mysql_query($queryUpdateLastLogin);
	

}
else if(mysql_fetch_row(mysql_query($queryCheckForUsername)) && !mysql_fetch_row(mysql_query($queryCheckForPassword)))
{
	include("{$_SERVER['DOCUMENT_ROOT']}/header.php");
	print("<p><span class = 'error'>
	Incorrect Password.</span><br /><br />
	Re-enter Username and Password and try again.<br /><br />
	Thank You.</span></p>");
	die(include("{$_SERVER['DOCUMENT_ROOT']}footer.php")); // terminate script execution			
}
else
{
	include("{$_SERVER['DOCUMENT_ROOT']}/header.php");
	print("<p><span class = 'error'>
	Username does not exist.</span><br /><br />
	Re-enter a valid Username and try again, or click \"First Time User?\" above.<br /><br />
	Thank You.</span></p>");
	die(include("{$_SERVER['DOCUMENT_ROOT']}footer.php")); // terminate script execution			
}

// this line can be taken out eventually
//echo ('<p>Your username input is: '.$_POST['UserName'].'<br />And your password input is: '.MD5($_POST['Password']).'(MD5 hashed)</p>');


//echo $UserName;

}

include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>