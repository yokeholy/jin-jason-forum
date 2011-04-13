<?php 
include("{$_SERVER['DOCUMENT_ROOT']}/header.php");
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
	print("<p>Welcome, $UserName!  You have successfully logged in!</p>"); // UserName vs. Username??????
	$_SESSION['LoggedIn'] = 1;
	
	$query = "SELECT EmailAddr FROM users WHERE UserName = '".$UserName."'";

	$row = (mysql_fetch_row(mysql_query($query)));
	$EmailAddr = $row[0];
	
	// get OrigSignup to use in User Control Panel
	$queryGetOrigSignup = "SELECT OrigSignup FROM users WHERE UserName = '".$UserName."'";
	$row = (mysql_fetch_row(mysql_query($queryGetOrigSignup)));
	$OrigSignup = $row[0];

	// get LastLogin to use in User Control Panel
	$queryGetLastLogin = "SELECT LastLogin FROM users WHERE UserName = '".$UserName."'";
	$row = (mysql_fetch_row(mysql_query($queryGetLastLogin)));
	$LastLogin = $row[0];
	
	// get current date and time:
	$now = getdate();
	$year = $now['year'];
	$month = $now['mon'];
	$day = $now['mday'];
	$hours = $now['hours'];
	$minutes = $now['minutes'];
	$seconds = $now['seconds'];

	$DateAndTime = "$year-$month-$day  $hours:$minutes:$seconds";
	print("current date/time: " . $DateAndTime . "\n");	
	print("last login: " . $LastLogin . "\n");

	
	$_SESSION['UserName'] = $UserName;
	$_SESSION['Password'] = $Password;
	$_SESSION['EmailAddr'] = $EmailAddr;
	$_SESSION['OrigSignup'] = $OrigSignup;
	$_SESSION['LastLogin'] = $LastLogin;
	
	$query = "UPDATE users SET LastLogin = '".$DateAndTime."' WHERE UserName = '".$UserName."'";
	mysql_query($query);

//	print($_SESSION['Username']);
}
else if(mysql_fetch_row(mysql_query($queryCheckForUsername)) && !mysql_fetch_row(mysql_query($queryCheckForPassword)))
{
	print("<p><span class = 'error'>
	Incorrect Password.</span><br /><br />
	Re-enter Username and Password and try again.<br /><br />
	Thank You.</span></p>");
	die(include("{$_SERVER['DOCUMENT_ROOT']}footer.php")); // terminate script execution			
}
else
{
	print("<p><span class = 'error'>
	Username does not exist.</span><br /><br />
	Re-enter a valid Username and try again, or click \"First Time User?\" above.<br /><br />
	Thank You.</span></p>");
	die(include("{$_SERVER['DOCUMENT_ROOT']}footer.php")); // terminate script execution			
}

// this line can be taken out eventually
//echo ('<p>Your username input is: '.$_POST['UserName'].'<br />And your password input is: '.MD5($_POST['Password']).'(MD5 hashed)</p>');


echo $UserName;

?>



















<?php 
include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>