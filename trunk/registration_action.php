<?php 
include("header.php");
?>

	<?php
		extract($_POST);
		
		

		$username_search_pattern = "/^[_0-9a-z]{3,20}$/i";
		if (!preg_match($username_search_pattern, $UserName))
		{
			print("<p><span class = 'error'>
				Invalid Username format.</span><br /><br />
				A valid Userame must:<br />
				- Contain at least 3 characters and not exceed 20 characters<br />
				- Not contain spaces<br />
				- Only contain alphabetic characters, digits, or underscores<br /><br />
				Click the Back button, enter a valid First Name, then resubmit.<br /><br />
				Thank You.</span></p>");
			die(include("footer.php")); // terminate script execution
		}
		
		
		
		$password_search_pattern = "/^[_0-9a-z-]{6,20}$/i";
		if (!preg_match($password_search_pattern, $Password))
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
		
	
	print("<p>Congratulations, $FirstName, you have successfully registered!</p>");
	
	$queryAdd = "INSERT INTO Users VALUES(NULL, '$UserName', MD5('$Password'), '$FirstName', '$LastName', '$EmailAddr')";
	if(!($result = mysql_query($queryAdd)))
	{
		print("Could not execute query! <br />");
		die(mql_error() . include("footer.php"));
	}
	
	
	?>
	
<?php
include("footer.php");
?>