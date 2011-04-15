<?php 
include("{$_SERVER['DOCUMENT_ROOT']}/header.php");
?>

<?php
	extract($_POST);
	$Password = $_SESSION['Password'];
	$EmailAddr = $_SESSION['EmailAddr'];
	
	$email_search_pattern = "/^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$/i";
	$change_password_search_pattern = "/^[_0-9a-z-]{6,20}$/i";
	
	// if all fields are blank: do nothing
	if($OldPassword == "" && $ConfirmOldPassword == "" && $NewPassword == "" && $ConfirmNewPassword == "" && $NewEmailAddr == "" && $ConfirmNewEmailAddr == "")
	{
		print("<p><span class = 'error'>
		No changes requested.</span><br /><br />
		- Click the Back button to return to User Control Panel<br /><br />
		- Or feel free to go to other areas of the Forum!");
		die(include("{$_SERVER['DOCUMENT_ROOT']}/footer.php")); // terminate script execution
	}
	
	// if other fields have entries and old password and confirm password are blank
	else if(($OldPassword == "" && $ConfirmOldPassword == "") && ($NewPassword != "" || $ConfirmNewPassword != "" || $NewEmailAddr != "" || $ConfirmNewEmailAddr != ""))
	{
		print("<p><span class = 'error'>
		Current password must be confirmed to make changes.</span><br /><br />
		- Click the Back button to return to User Control Panel<br /><br />
		- Be sure Old Password and Confirm Old Password match your current password<br />
		before making changes");
		die(include("{$_SERVER['DOCUMENT_ROOT']}/footer.php")); // terminate script execution
	}
		
	// check if current password matches old password fields
	else if(($OldPassword != "" || $ConfirmOldPassword != "") && ($Password != $OldPassword || $Password != $ConfirmOldPassword || $OldPassword != $ConfirmOldPassword))
	{
		print("<p><span class = 'error'>
		Current Password mismatch.</span><br /><br />
		- Click the Back button<br />
		- Make sure your current password matches exactly<br />
		with the Old Password and Confirm Old Password fields<br />
		- Then resubmit.<br /><br />
		Thank You.</span></p>");
		die(include("{$_SERVER['DOCUMENT_ROOT']}/footer.php")); // terminate script execution
	}
	
	// check if new password matches confirm new password
	else if(($OldPassword != "" || $ConfirmOldPassword != "") && (($NewPassword != "" || $ConfirmNewPassword != "") && $NewPassword != $ConfirmNewPassword))
	{
		print("<p><span class = 'error'>
		New Password mismatch.</span><br /><br />
		- Click the Back button<br />
		- Make sure the New Password and Confirm New Password fields match exactly<br />
		- Then resubmit.<br /><br />
		Thank You.</span></p>");
		die(include("{$_SERVER['DOCUMENT_ROOT']}/footer.php")); // terminate script execution
	}
	// check if new password and confirm new password conform to correct password format
	else if(($OldPassword != "" || $ConfirmOldPassword != "") && (($NewPassword != "" || $ConfirmNewPassword != "") && $NewPassword == $ConfirmNewPassword))
	{
		if(!preg_match($change_password_search_pattern, $NewPassword) || !preg_match($change_password_search_pattern, $ConfirmNewPassword))
		{
			print("<p><span class = 'error'>
				Invalid New Password format.</span><br /><br />
				A valid Password must:<br />
				- Contain at least 6 characters and not exceed 20 characters<br />
				- Not contain spaces<br />
				- Only contain alphabetic characters, digits, underscores, or hyphens<br /><br />
				Click the Back button, enter a valid New Password, then resubmit.<br /><br />
				Thank You.</span></p>");
			die(include("footer.php")); // terminate script execution
		}
		else
		{
			print("Password will be changed");
		}
	}	
	
	// check if new email matches confirm new email
	if($NewEmailAddr != $ConfirmNewEmailAddr)
	{
		print("<p><span class = 'error'>
		Email Address mismatch.</span><br /><br />
		- Click the Back button<br />
		- Make sure the New Email Address and Confirm New Email Address fields match exactly<br />
		AND are in the correct Email format<br />
		- Then resubmit.<br /><br />		Thank You.</span></p>");
		die(include("{$_SERVER['DOCUMENT_ROOT']}/footer.php")); // terminate script execution			
	}
	// check if new email and confirm new email conform to correct email format
	else if(!preg_match($email_search_pattern, $NewEmailAddr) || !preg_match($email_search_pattern, $ConfirmNewEmailAddr))
	{
		print("<p><span class = 'error'>
			Invalid email format</span><br /><br />
			A valid email address must:<br />
			- Be in the form <strong>yourname@domain.com</strong><br />
			- Contain only alphanumeric characters, digits, underscores, dots, or hyphens<br /><br />
			<span class = 'distinct'>  
			Click the Back button, enter a valid Email Address, then resubmit.<br /><br />
			Thank You.</span></p>");
		die(include("{$_SERVER['DOCUMENT_ROOT']}/footer.php")); // terminate script execution
	}
	

	
	if($NewEmailAddr != "")
	{
		print("email will be changed");
	}
	
	
/*	
	$change_password_search_pattern = "/^[_0-9a-z-]{6,20}$/i";
	if (!preg_match($change_password_search_pattern, $ChangePassword))
	{
		print("<p><span class = 'error'>
			Invalid Password format.</span><br /><br />
			A valid Password must:<br />
			- Contain at least 6 characters and not exceed 20 characters<br />
			- Not contain spaces<br />
			- Only contain alphabetic characters, digits, underscores, or hyphens<br /><br />
			Click the Back button, enter a valid Password, then resubmit.<br /><br />
			Thank You.</span></p>");
		die(include("footer.php")); // terminate script execution
	}
	
	if($Password != $ConfirmPassword)
	{
		print("<p><span class = 'error'>
			Password mismatch.</span><br /><br />
			Click the Back button, make sure the Password and Confirm Password fields match exactly, then resubmit.<br /><br />
			Thank You.</span></p>");
		die(include("footer.php")); // terminate script execution
	}
	
	$firstname_search_pattern = "/^[a-z]{1}[a-z-]{1,19}$/i";
	if (!preg_match($firstname_search_pattern, $FirstName))
	{
		print("<p><span class = 'error'>
			Invalid Name format.</span><br /><br />
			A valid First Name must:<br />
			- Contain at least 2 characters and not exceed 20 characters<br />
			- Not contain spaces<br />
			- Begin with an alphabetic character<br />
			- Only contain alphabetic characters or hyphens<br /><br />
			Click the Back button, enter a valid First Name, then resubmit.<br /><br />
			Thank You.</span></p>");
		die(include("footer.php")); // terminate script execution
	}

	$lastname_search_pattern = "/^[a-z]{1}[a-z-]{1,19}$/i";
	if (!preg_match($lastname_search_pattern, $LastName))
	{
		print("<p><span class = 'error'>
			Invalid Name format.</span><br />
			A valid Last Name must:<br />
			- Contain at least 2 characters and not exceed 20 characters<br />
			- Not contain spaces<br />
			- Begin with an alphabetic character<br />
			- Only contain alphabetic characters or hyphens<br /><br />
			Click the Back button, enter a valid Last Name, then resubmit.<br /><br />
			Thank You.</span></p>");
		die(include("footer.php")); // terminate script execution
	}

	$email_search_pattern = "/^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$/i";
	if (!preg_match($email_search_pattern, $EmailAddr))
	{
		print("<p><span class = 'error'>
			Invalid email format</span><br /><br />
			A valid email address must:<br />
			- Be in the form <strong>yourname@domain.com</strong><br />
			- Contain only alphanumeric characters, digits, underscores, dots, or hyphens<br /><br />
			<span class = 'distinct'>  
			Click the Back button, enter a valid Email Address, then resubmit.<br /><br />
			Thank You.</span></p>");
		die(include("footer.php")); // terminate script execution
	}
	else
	{
		$queryCheckDuplicateEmailAddr = "SELECT EmailAddr FROM users WHERE EmailAddr = '".$EmailAddr."'";
		if(mysql_fetch_row(mysql_query($queryCheckDuplicateEmailAddr)))
		{
			print("<p><span class = 'error'>
			The email address already exists under another Username.</span><br /><br />
			Click the Back button, try a different email address, then resubmit.<br /><br />
			Thank You.</span></p>");
			die(include("footer.php")); // terminate script execution			
		}
	}	


	// get date and time to use for OrigSignup:
	$now = getdate();
	// set up variables:
	$year = $now['year'];
	$month = $now['mon'];
	$day = $now['mday'];
	$hours = $now['hours'];
	$minutes = $now['minutes'];
	$seconds = $now['seconds'];
	$OrigSignup = "$year-$month-$day  $hours:$minutes:$seconds";
	$LastLogin = $OrigSignup;
	
	// add info from text fields and getDate to the database (vars come from POST input from registraion.php, except OrigSignup and LastLogin)
	$queryAdd = "INSERT INTO users VALUES(NULL, '$UserName', MD5('$Password'), '$FirstName', '$LastName', '$EmailAddr', '$OrigSignup', '$LastLogin')";
	
	
	if(!($result = mysql_query($queryAdd)))
	{
		print("Could not execute query! <br />");
		die(mysql_error() . include("{$_SERVER['DOCUMENT_ROOT']}/footer.php"));
	}
	else
	{
		print("<p>Congratulations, $FirstName, you have successfully registered!</p>");
		
		$_SESSION['UserName'] = $UserName;
		$_SESSION['Password'] = $Password;
		$_SESSION['EmailAddr'] = $EmailAddr;
		$_SESSION['OrigSignup'] = $OrigSignup;
		$_SESSION['LastLogin'] = $LastLogin;
		// set this to 1 now that the user has logged in (by way of registration)
		$_SESSION['LoggedIn'] = 1;
	}
*/	
	?>
	
<?php
include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>