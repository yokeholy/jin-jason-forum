<?php 
include("{$_SERVER['DOCUMENT_ROOT']}/header.php");

if(!isset($_POST['ConfirmOldPassword']))
{
	print("<span class=\"error\">Invalid request.  Please return to another area of the forum.</span>");
}
else
{
?>

<?php
	extract($_POST);
	$EmailAddr = $_SESSION['EmailAddr'];
	$UserName = $_SESSION['UserName'];
	
	$queryGetPassword = "SELECT Password FROM users WHERE UserName = '".$UserName."'";
	
	$result = mysql_query($queryGetPassword);
	$numRows = mysql_fetch_array($result);
	$Password = $numRows[0];
	
		
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
		
	$EmailAddrError = 0;
	$EmailCheck = 0;
	
	$ConfirmOldPassword = MD5($ConfirmOldPassword);
	
	if(isset($_POST['EmailCheckbox']))
		$EmailCheck = 1;

	// if all fields are blank
	if($ConfirmOldPasswordIsBlank && $NewEmailAddrIsBlank && $ConfirmNewEmailAddrIsBlank && !$EmailCheck)
	{
		$EmailAddrError = 1;
		//$_SESSION['EmailAddrError'] = $EmailAddrError;
		//$_SESSION['EmailCheck'] = $EmailCheck;
die(include("{$_SERVER['DOCUMENT_ROOT']}/update_email_addr_action_error.php")); // terminate script execution
	}
	// if confirm old password is blank and any other fields have entries
	else if($ConfirmOldPasswordIsBlank && (!$NewEmailAddrIsBlank || !$ConfirmNewEmailAddrIsBlank || $EmailCheck))
	{
		$EmailAddrError = 2;
		//$_SESSION['EmailAddrError'] = $EmailAddrError;
		//$_SESSION['EmailCheck'] = $EmailCheck;
die(include("{$_SERVER['DOCUMENT_ROOT']}/update_email_addr_action_error.php")); // terminate script execution
	}
	// if confirm old password (is not blank and) does not match current password
	else if(!$ConfirmOldPasswordIsBlank && ($Password != $ConfirmOldPassword))
	{
		$EmailAddrError = 3;
		//$_SESSION['EmailAddrError'] = $EmailAddrError;
		//$_SESSION['EmailCheck'] = $EmailCheck;
die(include("{$_SERVER['DOCUMENT_ROOT']}/update_email_addr_action_error.php")); // terminate script execution
	}
	// if confirm old password is not blank and matches current password, and all other fields are blank
	else if(!$ConfirmOldPasswordIsBlank && $NewEmailAddrIsBlank && $ConfirmNewEmailAddrIsBlank && !$EmailCheck)
	{
		$EmailAddrError = 4;
		//$_SESSION['EmailAddrError'] = $EmailAddrError;
		//$_SESSION['EmailCheck'] = $EmailCheck;
die(include("{$_SERVER['DOCUMENT_ROOT']}/update_email_addr_action_error.php")); // terminate script execution
	}
	// if confirm old password is not blank and matches current password, email fields are blank, and checkbox is checked
	else if(!$ConfirmOldPasswordIsBlank && $NewEmailAddrIsBlank && $ConfirmNewEmailAddrIsBlank && $EmailCheck)
	{
		$EmailAddrError = 5;
		//$_SESSION['EmailAddrError'] = $EmailAddrError;
		//$_SESSION['EmailCheck'] = $EmailCheck;
// UNCOMMENT THESE LATER - JUST TAKING OUT FUNCTIONALITY FOR NOW - THEY WORK CORRECTLY:
			
		$querySubscribeEmail = "UPDATE users SET SubscribeEmail = '1' WHERE UserName = '".$UserName."'";
		mysql_query($querySubscribeEmail);

		die(include("{$_SERVER['DOCUMENT_ROOT']}/update_email_addr_action_error.php")); // terminate script execution
	}
	// if confirm old password matches current password, and New Email Address and Confirm New Email Address don't match		
	else if(!$ConfirmOldPasswordIsBlank && ((!$NewEmailAddrIsBlank || !$ConfirmNewEmailAddrIsBlank) && $NewEmailAddr != $ConfirmNewEmailAddr))
	{
		$EmailAddrError = 6;
		//$_SESSION['EmailAddrError'] = $EmailAddrError;
		//$_SESSION['EmailCheck'] = $EmailCheck;
die(include("{$_SERVER['DOCUMENT_ROOT']}/update_email_addr_action_error.php")); // terminate script execution
	}
	// if confirm old password matches current password, and New Email Address matches Confirm New Email Address, but don't conform to correct format
	else if(!$ConfirmOldPasswordIsBlank && ((!$NewEmailAddrIsBlank || !$ConfirmNewEmailAddrIsBlank) && $NewEmailAddr == $ConfirmNewEmailAddr))
	{
		if(!preg_match($change_email_search_pattern, $NewEmailAddr) || !preg_match($change_email_search_pattern, $ConfirmNewEmailAddr))
		{
			$EmailAddrError = 7;
		//$_SESSION['EmailAddrError'] = $EmailAddrError;
		//$_SESSION['EmailCheck'] = $EmailCheck;
die(include("{$_SERVER['DOCUMENT_ROOT']}/update_email_addr_action_error.php")); // terminate script execution
		}
		else
		{
			$EmailAddrError = 0;
		//$_SESSION['EmailAddrError'] = $EmailAddrError;
		//$_SESSION['EmailCheck'] = $EmailCheck;
// UNCOMMENT THESE LATER - JUST TAKING OUT FUNCTIONALITY FOR NOW - THEY WORK CORRECTLY:
				
			$queryUpdateEmailAddr = "UPDATE users SET EmailAddr = '".$NewEmailAddr."' WHERE UserName = '".$UserName."'";
			mysql_query($queryUpdateEmailAddr);
			$_SESSION['EmailAddr'] = $NewEmailAddr;

			if($EmailCheck)
			{
				// UNCOMMENT THESE LATER - JUST TAKING OUT FUNCTIONALITY FOR NOW - THEY WORK CORRECTLY:

				$querySubscribeEmail = "UPDATE users SET SubscribeEmail = '1' WHERE UserName = '".$UserName."'";
				mysql_query($querySubscribeEmail);
			}
			die(include("{$_SERVER['DOCUMENT_ROOT']}/update_email_addr_action_error.php")); // terminate script execution
		}
	}
?>

<?php
} // end else from top of file if statement
include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>