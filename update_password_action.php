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
	$Password = $_SESSION['Password'];
	$UserName = $_SESSION['UserName'];
	
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
		
	$PasswordError = 0;
		
	// if all fields are blank
	if($ConfirmOldPasswordIsBlank && $NewPasswordIsBlank && $ConfirmNewPasswordIsBlank)
	{
		$PasswordError = 1;
		$_SESSION['PasswordError'] = $PasswordError; 
		die(include("{$_SERVER['DOCUMENT_ROOT']}/update_password_action_error.php")); // terminate script execution
	}
	// if confirm old password is blank and any other fields have entries
	else if($ConfirmOldPasswordIsBlank && (!$NewPasswordIsBlank || !$ConfirmNewPasswordIsBlank))
	{
		$PasswordError = 2;
		$_SESSION['PasswordError'] = $PasswordError;
		die(include("{$_SERVER['DOCUMENT_ROOT']}/update_password_action_error.php")); // terminate script execution
	}
	// if confirm old password (is not blank and) does not match current password
	else if(!$ConfirmOldPasswordIsBlank && ($Password != $ConfirmOldPassword))
	{
		$PasswordError = 3;
		$_SESSION['PasswordError'] = $PasswordError;
		die(include("{$_SERVER['DOCUMENT_ROOT']}/update_password_action_error.php")); // terminate script execution
	}
	// if confirm old password is not blank and matches current password, and all other fields are blank
	else if(!$ConfirmOldPasswordIsBlank && $NewPasswordIsBlank && $ConfirmNewPasswordIsBlank)
	{
		$PasswordError = 4;
		$_SESSION['PasswordError'] = $PasswordError;
		die(include("{$_SERVER['DOCUMENT_ROOT']}/update_password_action_error.php")); // terminate script execution
	}
	// if confirm old password matches current password, and New Password and Confirm New Password don't match		
	else if(!$ConfirmOldPasswordIsBlank && ((!$NewPasswordIsBlank || !$ConfirmNewPasswordIsBlank) && $NewPassword != $ConfirmNewPassword))
	{
		$PasswordError = 5;
		$_SESSION['PasswordError'] = $PasswordError;
		die(include("{$_SERVER['DOCUMENT_ROOT']}/update_password_action_error.php")); // terminate script execution
	}
	// if confirm old password matches current password, and New Password matches Confirm New Password, but don't conform to correct password format
	else if(!$ConfirmOldPasswordIsBlank && ((!$NewPasswordIsBlank || !$ConfirmNewPasswordIsBlank) && $NewPassword == $ConfirmNewPassword))
	{
		if(!preg_match($change_password_search_pattern, $NewPassword) || !preg_match($change_password_search_pattern, $ConfirmNewPassword))
		{
			$PasswordError = 6;
			$_SESSION['PasswordError'] = $PasswordError;
			die(include("{$_SERVER['DOCUMENT_ROOT']}/update_password_action_error.php")); // terminate script execution
		}
		else
		{
			$PasswordError = 0;
			$_SESSION['PasswordError'] = $PasswordError;

			// UNCOMMENT THESE LATER - JUST TAKING OUT FUNCTIONALITY FOR NOW - THEY WORK CORRECTLY:
			
			//$queryUpdatePassword = "UPDATE users SET Password = '".MD5('$NewPassword')."' WHERE UserName = '".$UserName."'";
			//mysql_query($queryUpdatePassword);
			//$_SESSION['Password'] = $NewPassword;
			
			die(include("{$_SERVER['DOCUMENT_ROOT']}/update_password_action_error.php")); // terminate script execution
		}
	}
?>
	
<?php
} // end else from top of file if statement
include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>