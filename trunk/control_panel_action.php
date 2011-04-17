<?php 
include("{$_SERVER['DOCUMENT_ROOT']}/header.php");
?>

<?php
	extract($_POST);
	$Password = $_SESSION['Password'];
	$EmailAddr = $_SESSION['EmailAddr'];
	$UserName = $_SESSION['UserName'];
	
	$change_email_search_pattern = "/^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$/i";
	$change_password_search_pattern = "/^[_0-9a-z-]{6,20}$/i";
	
	// set up some flags to make upcoming if statements easier
	if($ConfirmOldPassword == "")
		$ConfirmOldPasswordIsBlank = 1;
	else
		$ConfirmOldPasswordIsBlank = 0;
		
	if($NewPassword == "")
		$NewPasswordIsBlank = 1;
	else
		$NewPasswordIsBlank = 0;
		
	if($ConfirmNewPassword == "")
		$ConfirmNewPasswordIsBlank = 1;
	else
		$ConfirmNewPasswordIsBlank = 0;
	
	if($NewEmailAddr == "")
		$NewEmailAddrIsBlank = 1;
	else
		$NewEmailAddrIsBlank = 0;
		
	if($ConfirmNewEmailAddr == "")
		$ConfirmNewEmailAddrIsBlank = 1;
	else
		$ConfirmNewEmailAddrIsBlank = 0;
	
	$PasswordConfirmed = 0;  // initially not confirmed
	$PasswordUpdated = 0;  // initially not updated
	
	
	// if all fields are blank: do nothing
	if($ConfirmOldPasswordIsBlank && $NewPasswordIsBlank && $ConfirmNewPasswordIsBlank && $NewEmailAddrIsBlank && $ConfirmNewEmailAddrIsBlank)
	{
		print("<p><span class = 'error'>
		No changes requested.</span><br /><br />
		- Click the Back button to return to User Control Panel<br /><br />
		- Or feel free to go to other areas of the Forum!");
		die(include("{$_SERVER['DOCUMENT_ROOT']}/footer.php")); // terminate script execution
	}
	
	// if confirm old password is blank and any other fields have entries
	else if($ConfirmOldPasswordIsBlank && (!$NewPasswordIsBlank || !$ConfirmNewPasswordIsBlank || !$NewEmailAddrIsBlank || !$ConfirmNewEmailAddrIsBlank))
	{
		print("<p><span class = 'error'>
		Current password must be confirmed to make changes.</span><br /><br />
		- Click the Back button to return to User Control Panel<br /><br />
		- Be sure Confirm Old Password matches your current password<br />
		before making changes");
		die(include("{$_SERVER['DOCUMENT_ROOT']}/footer.php")); // terminate script execution
	}
		
	// if confirm old password (is not blank and) does not match current password
	else if(!$ConfirmOldPasswordIsBlank && ($Password != $ConfirmOldPassword))
	{
		print("<p><span class = 'error'>
		Current Password mismatch.</span><br /><br />
		- Click the Back button<br />
		- Make sure the Confirm Old Password field matches your current password exactly<br />
		- Then resubmit.<br /><br />
		Thank You.</span></p>");
		die(include("{$_SERVER['DOCUMENT_ROOT']}/footer.php")); // terminate script execution
	}
	
	// if confirm old password is not blank and matches current password, and all other fields are blank
	else if(!$ConfirmOldPasswordIsBlank && $NewPasswordIsBlank && $ConfirmNewPasswordIsBlank && $NewEmailAddrIsBlank && $ConfirmNewEmailAddrIsBlank)
	{
		print("<p><span class = 'error'>
		Current password confirmed but no changes requested.</span><br /><br />
		- Click the Back button to return to User Control Panel<br /><br />
		- Or feel free to go to other areas of the Forum!");
		die(include("{$_SERVER['DOCUMENT_ROOT']}/footer.php")); // terminate script execution
	}
		
	// if confirm old password matches current password, and New Password and Confirm New Password don't match		
	else if(!$ConfirmOldPasswordIsBlank && ((!$NewPasswordIsBlank || !$ConfirmNewPasswordIsBlank) && $NewPassword != $ConfirmNewPassword))
	{
		// if email fields are blank, don't need to output a message regarding email
		if($NewEmailAddrIsBlank && $ConfirmNewEmailAddrIsBlank)
		{
			print("<p><span class = 'error'>
			New Password mismatch.</span><br /><br />
			- Click the Back button<br />
			- Make sure the New Password and Confirm New Password fields match exactly<br />
			- Then resubmit.<br /><br />
			Thank You.</span></p>");
			die(include("{$_SERVER['DOCUMENT_ROOT']}/footer.php")); // terminate script execution
		}
		else if(!$NewEmailAddrIsBlank || !$ConfirmNewEmailAddrIsBlank)
		{
			
		}
	}
	
	// if confirm old password matches current password, and New Password matches Confirm New Password, but don't conform to correct password format
	else if(!$ConfirmOldPasswordIsBlank && ((!$NewPasswordIsBlank || !$ConfirmNewPasswordIsBlank) && $NewPassword == $ConfirmNewPassword))
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
			die(include("{$_SERVER['DOCUMENT_ROOT']}/footer.php")); // terminate script execution
		}
		else
		{
			// new password update will occur if Email fields are both blank
			if($NewEmailAddrIsBlank && $ConfirmNewEmailAddrIsBlank)
			{
				// UNCOMMENT THESE LATER - JUST TAKING OUT FUNCTIONALITY FOR NOW - THEY WORK CORRECTLY:
				
				//$queryUpdatePassword = "UPDATE users SET Password = '".MD5('$NewPassword')."' WHERE UserName = '".$UserName."'";
				//mysql_query($queryUpdatePassword);
				//$_SESSION['Password'] = $NewPassword;
				print("Password has been successfully changed!");
				$PasswordConfirmed = 1;
				$PasswordUpdated = 1;
			}
			// email fields are not blank but are not matched but password is correct
			else
			{
				// UNCOMMENT THESE LATER - JUST TAKING OUT FUNCTIONALITY FOR NOW - THEY WORK CORRECTLY:
				
				//$queryUpdatePassword = "UPDATE users SET Password = '".MD5('$NewPassword')."' WHERE UserName = '".$UserName."'";
				//mysql_query($queryUpdatePassword);
				//$_SESSION['Password'] = $NewPassword;
				print("Password has been successfully changed!");
				$PasswordConfirmed = 1;
				$PasswordUpdated = 1;
								
				print("<p><span class = 'error'>
				HOWEVER,<br />Email Address mismatch.</span><br /><br />
				- Click the Back button<br />
				- Make sure the New Email Address and Confirm New Email Address fields match exactly<br />
				AND are in the correct Email format<br />
				- Then resubmit.<br /><br />		Thank You.</span></p>");
				die(include("{$_SERVER['DOCUMENT_ROOT']}/footer.php")); // terminate script execution
			}
		}
	}

	// the above if blocks already checked if email fields were blank: if so do nothing, if not print error
	// now check if email fields match (and password was confirmed and updated)
	if($PasswordConfirmed && $PasswordUpdated && ($NewEmailAddr == $ConfirmNewEmailAddr))
	{
		if(!preg_match($change_email_search_pattern, $NewEmailAddr) || !preg_match($change_email_search_pattern, $ConfirmNewEmailAddr))
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
		else
		{
			// UNCOMMENT THESE LATER - JUST TAKING OUT FUNCTIONALITY FOR NOW - THEY WORK CORRECTLY:
				
			//$queryUpdateEmailAddr = "UPDATE users SET EmailAddr = '".MD5('$NewEmailAddr')."' WHERE UserName = '".$UserName."'";
			//mysql_query($queryUpdateEmailAddr);
			//$_SESSION['EmailAddr'] = $NewEmailAddr;
			print("Email Address has been successfully updated!");
		}
	}
	
	else if($PasswordConfirmed

	?>
	
<?php
include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>