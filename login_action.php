<?php 
include("{$_SERVER['DOCUMENT_ROOT']}/header.php");

extract($_POST);

$passscram= md5($Password);
$queryCheckForUsername = "SELECT UserName FROM users WHERE UserName = '".$Username."'";
$queryCheckForPassword = "SELECT UserName FROM users WHERE UserName = '".$Username."' AND Password = '".$passscram."'";




if(mysql_fetch_row(mysql_query($queryCheckForPassword)))
{
	print("<p>Welcome, $Username, !  You have successfully logged in!</p>"); // UserName vs. Username??????
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
	Re-enter a valid Username and try again.<br /><br />
	Thank You.</span></p>");
	die(include("{$_SERVER['DOCUMENT_ROOT']}footer.php")); // terminate script execution			
}

echo ('<p>Your username input is: '.$_POST['Username'].'<br />And your password input is: '.MD5($_POST['Password']).'(MD5 hashed)</p>');



?>



















<?php 
include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>