<?php 
include("{$_SERVER['DOCUMENT_ROOT']}/header.php");
?>

<?php
	extract($_POST);
	$Password = $_SESSION['Password'];
	$EmailAddr = $_SESSION['EmailAddr'];
	$UserName = $_SESSION['UserName'];
	
	$change_email_search_pattern = "/^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$/i";
	
	// set up some flags to make upcoming if statements easier
	if($ConfirmOldPassword == "")
		$ConfirmOldPasswordIsBlank = 1;
	else
		$ConfirmOldPasswordIsBlank = 0;
	
	if($NewEmailAddr == "")
		$NewEmailAddrIsBlank = 1;
	else
		$NewEmailAddrIsBlank = 0;
		
	if($ConfirmNewEmailAddr == "")
		$ConfirmNewEmailAddrIsBlank = 1;
	else
		$ConfirmNewEmailAddrIsBlank = 0;
	
	// if all fields are blank: do nothing
	if($ConfirmOldPasswordIsBlank && $NewEmailAddrIsBlank && $ConfirmNewEmailAddrIsBlank)
	{
		print("<p><span class = 'error'>
		No changes requested.</span><br /><br />
		- Click the Back button to return to Change Email Address screen<br /><br />
		- Or feel free to go to other areas of the Forum!");
		die(include("{$_SERVER['DOCUMENT_ROOT']}/footer.php")); // terminate script execution
	}
	
	// if confirm old password is blank and any other fields have entries
	else if($ConfirmOldPasswordIsBlank && (!$NewEmailAddrIsBlank || !$ConfirmNewEmailAddrIsBlank))
	{
		print("<p><span class = 'error'>
		Current password must be confirmed to make changes.</span><br /><br />
		- Click the Back button to return to Change Email Address screen<br /><br />
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
	else if(!$ConfirmOldPasswordIsBlank && $NewEmailAddrIsBlank && $ConfirmNewEmailAddrIsBlank)
	{
		print("<p><span class = 'error'>
		Current password confirmed but no changes requested.</span><br /><br />
		- Click the Back button to return to Change Email Address screen<br /><br />
		- Or feel free to go to other areas of the Forum!");
		die(include("{$_SERVER['DOCUMENT_ROOT']}/footer.php")); // terminate script execution
	}
		
	// if confirm old password matches current password, and New Email Address and Confirm New Email Address don't match		
	else if(!$ConfirmOldPasswordIsBlank && ((!$NewEmailAddrIsBlank || !$ConfirmNewEmailAddrIsBlank) && $NewEmailAddr != $ConfirmNewEmailAddr))
	{
		print("<p><span class = 'error'>
		New Email Address mismatch.</span><br /><br />
		- Click the Back button<br />
		- Make sure the New Email Address and Confirm New Email Address fields match exactly<br />
		- Then resubmit.<br /><br />
		Thank You.</span></p>");
		die(include("{$_SERVER['DOCUMENT_ROOT']}/footer.php")); // terminate script execution
	}
	
	// if confirm old password matches current password, and New Email Address matches Confirm New Email Address, but don't conform to correct format
	else if(!$ConfirmOldPasswordIsBlank && ((!$NewEmailAddrIsBlank || !$ConfirmNewEmailAddrIsBlank) && $NewEmailAddr == $ConfirmNewEmailAddr))
	{
		if(!preg_match($change_email_search_pattern, $NewEmailAddr) || !preg_match($change_email_search_pattern, $ConfirmNewEmailAddr))
		{
			print("<p><span class = 'error'>
			Invalid New Email Address format.</span><br /><br />
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
				
			//$queryUpdateEmailAddr = "UPDATE users SET EmailAddr = '".$NewEmailAddr."' WHERE UserName = '".$UserName."'";
			//mysql_query($queryUpdateEmailAddr);
			//$_SESSION['EmailAddr'] = $NewEmailAddr;
			print("Email Address has been successfully updated!  BUT NOT REALLY - DATABASE ACTION IS COMMENTED OUT");
		}
	}
?>
	
<?php
include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>