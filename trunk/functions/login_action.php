<?php 
include("{$_SERVER['DOCUMENT_ROOT']}/header.php");
extract($_POST);

$passscram= md5($Password);
$queryCheckForUsername = "SELECT UserName FROM users WHERE UserName = '".$UserName."'";
$queryCheckForPassword = "SELECT UserName FROM users WHERE UserName = '".$UserName."' AND Password = '".$passscram."'";
$getEmailAddr = "SELECT EmailAddr FROM users WHERE UserName = '".$UserName."'";
$EmailAddr = mysql_query($getEmailAddr);

if(mysql_fetch_row(mysql_query($queryCheckForPassword)))
{
	print("<p>Welcome, $UserName!  You have successfully logged in!</p>"); // UserName vs. Username??????
	
	$_SESSION['Username'] = $UserName;
	$_SESSION['EmailAddr'] = $EmailAddr;

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
echo ('<p>Your username input is: '.$_POST['UserName'].'<br />And your password input is: '.MD5($_POST['Password']).'(MD5 hashed)</p>');

?>



















<?php 
include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>