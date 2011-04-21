<?php 
include("{$_SERVER['DOCUMENT_ROOT']}/header.php");

if(!isset($_POST['UserName']))
{
	print("<span class=\"error\">Invalid request.  Please return to another area of the forum.</span>");	
}
else
{
?>

<?php
	extract($_POST);
	
	$NUM_FIELDS = 6;
	$username_search_pattern = "/^[_0-9a-z]{3,20}$/i";
	$password_search_pattern = "/^[_0-9a-z-]{6,20}$/i";
	$firstname_search_pattern = "/^[a-z]{1}[a-z-]{1,19}$/i";
	$lastname_search_pattern = "/^[a-z]{1}[a-z-]{1,19}$/i";
	$email_search_pattern = "/^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$/i";	
	
	// set up some flags to make upcoming if statements easier
	if($UserName == "")
		$UserNameIsBlank = 1;
	else
		$UserNameIsBlank = 0;
		
	if($Password == "")
		$PasswordIsBlank = 1;
	else
		$PasswordIsBlank = 0;
		
	if($ConfirmPassword == "")
		$ConfirmPasswordIsBlank = 1;
	else
		$ConfirmPasswordIsBlank = 0;
		
	if($FirstName == "")
		$FirstNameIsBlank = 1;
	else
		$FirstNameIsBlank = 0;
	
	if($LastName == "")
		$LastNameIsBlank = 1;
	else
		$LastNameIsBlank = 0;

	if($EmailAddr == "")
		$EmailAddrIsBlank = 1;
	else
		$EmailAddrIsBlank = 0;
		
	$AllFields[0] = $UserNameIsBlank;
	$AllFields[1] = $PasswordIsBlank;
	$AllFields[2] = $ConfirmPasswordIsBlank;
	$AllFields[3] = $FirstNameIsBlank;
	$AllFields[4] = $LastNameIsBlank;
	$AllFields[5] = $EmailAddrIsBlank;
	
	$AllFieldsAreFilled = 1;
	for($i=0; $i<$NUM_FIELDS; $i++)
	{
		if($AllFields[$i] == 1)
			$AllFieldsAreFilled = 0;
	}
		
	$RegistrationError = 0;

	// at this point the user is not logged in
	$_SESSION['LoggedIn'] = 0;

	// if all fields are blank
	if($UserNameIsBlank && $PasswordIsBlank && $ConfirmPasswordIsBlank && $FirstNameIsBlank && $LastNameIsBlank && $EmailAddrIsBlank)
	{
		$RegistrationError = 1;
		$_SESSION['RegistrationError'] = $RegistrationError;
		die(include("{$_SERVER['DOCUMENT_ROOT']}/registration_action_error.php")); // terminate script execution
	}
	
	// if one or more fields are blank
	if(!$AllFieldsAreFilled)
	{
		$RegistrationError = 2;
		$_SESSION['RegistrationError'] = $RegistrationError;
		die(include("{$_SERVER['DOCUMENT_ROOT']}/registration_action_error.php")); // terminate script execution
	}
	
	// if UserName format is incorrect
	if (!preg_match($username_search_pattern, $UserName))
	{
		$RegistrationError = 3;
		$_SESSION['RegistrationError'] = $RegistrationError;
		die(include("{$_SERVER['DOCUMENT_ROOT']}/registration_action_error.php")); // terminate script execution
	}
	// if UserName format is correct but is a duplicate of an existing UserName
	else
	{
		$queryCheckDuplicateUsername = "SELECT UserName FROM users WHERE UserName = '".$UserName."'";
		if(mysql_fetch_row(mysql_query($queryCheckDuplicateUsername)))
		{
			$RegistrationError = 4;
			$_SESSION['RegistrationError'] = $RegistrationError;
			die(include("{$_SERVER['DOCUMENT_ROOT']}/registration_action_error.php")); // terminate script execution			
		}
	}
				
	// if Password format is incorrect
	if (!preg_match($password_search_pattern, $Password))
	{
		$RegistrationError = 5;
		$_SESSION['RegistrationError'] = $RegistrationError;
		die(include("{$_SERVER['DOCUMENT_ROOT']}/registration_action_error.php")); // terminate script execution
	}
	// if Password format is correct but does not match Confirm Password
	else if($Password != $ConfirmPassword)
	{
		$RegistrationError = 6;
		$_SESSION['RegistrationError'] = $RegistrationError;
		die(include("{$_SERVER['DOCUMENT_ROOT']}/registration_action_error.php")); // terminate script execution
	}	
	
	// if FirstName format is incorrect
	if (!preg_match($firstname_search_pattern, $FirstName))
	{
		$RegistrationError = 7;
		$_SESSION['RegistrationError'] = $RegistrationError;
		die(include("{$_SERVER['DOCUMENT_ROOT']}/registration_action_error.php")); // terminate script execution
	}

	// if LastName format is incorrect
	if (!preg_match($lastname_search_pattern, $LastName))
	{
		$RegistrationError = 8;
		$_SESSION['RegistrationError'] = $RegistrationError;
		die(include("{$_SERVER['DOCUMENT_ROOT']}/registration_action_error.php")); // terminate script execution
	}

	// if EmailAddr format is incorrect
	if (!preg_match($email_search_pattern, $EmailAddr))
	{
		$RegistrationError = 9;
		$_SESSION['RegistrationError'] = $RegistrationError;
		die(include("{$_SERVER['DOCUMENT_ROOT']}/registration_action_error.php")); // terminate script execution
	}
	// if Email Address format is correct but is a duplicate of an existing Email Address
	else
	{
		$queryCheckDuplicateEmailAddr = "SELECT EmailAddr FROM users WHERE EmailAddr = '".$EmailAddr."'";
		if(mysql_fetch_row(mysql_query($queryCheckDuplicateEmailAddr)))
		{
			$RegistrationError = 10;
			$_SESSION['RegistrationError'] = $RegistrationError;
		die(include("{$_SERVER['DOCUMENT_ROOT']}/registration_action_error.php")); // terminate script execution
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
	$SubscribeEmail = 0;
	
	// add info from text fields and getDate to the database (vars come from POST input from registraion.php, except OrigSignup and LastLogin)
	$queryAdd = "INSERT INTO users VALUES(NULL, '$UserName', MD5('$Password'), '$FirstName', '$LastName', '$EmailAddr', '$OrigSignup', '$LastLogin', '$SubscribeEmail')";
	
	if(!($result = mysql_query($queryAdd)))
	{
		$RegistrationError = 11;
		$_SESSION['RegistrationError'] = $RegistrationError;
		die(mysql_error() . include("{$_SERVER['DOCUMENT_ROOT']}/registration_action_error.php")); // terminate script execution
	}
	else
	{
		$RegistrationError = 0;
		$_SESSION['RegistrationError'] = $RegistrationError;
		
		print("<span class=\"congrats\">Congratulations, $FirstName, you have successfully registered!<br/>");
		
		$queryGetUserID = "SELECT UserID FROM users WHERE UserName = '".$UserName."'";
		$row = (mysql_fetch_row(mysql_query($queryGetUserID)));
		$UserID = $row[0];

		$_SESSION['UserID'] = $UserID;

		$_SESSION['UserName'] = $UserName;
		$_SESSION['Password'] = $Password;
		$_SESSION['EmailAddr'] = $EmailAddr;
		$_SESSION['OrigSignup'] = $OrigSignup;
		$_SESSION['LastLogin'] = $LastLogin;
		// set this to 1 now that the user has logged in (by way of registration)
		$_SESSION['LoggedIn'] = 1;
	}	
	?>
	
<?php
} // end else from top of file if statement
include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>