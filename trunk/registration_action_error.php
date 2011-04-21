<?php 
include("{$_SERVER['DOCUMENT_ROOT']}/header.php");

$RegistrationError = $_SESSION['RegistrationError'];
?>
	<h1 style="text-align:left; margin-top:10px"><strong>First Time User Registration</strong></h1>
	<div class="instructions2" style="text-align:left; margin-top:10px"/>Please fill in all fields below and click Submit.
		&nbsp;Click Reset to clear all fields.</div><br />
	<form name="Register" action="registration_action.php" method="post" style="text-align:left">
		<table width="100%" align="left" class="registration">
		<tr>
		<td colspan="2">
<?php
		if($RegistrationError == 1)
			print("<span class=\"error\">No data entered.</span>");
		else if($RegistrationError == 2)
			print("<span class=\"error\">Please fill out all fields before submitting.</span>");
		else if($RegistrationError == 3)
			print("<span class=\"error\"><strong>Error:</strong><br/>Invalid Username format.<br/>
					A valid Username must:<br/><i>&nbsp;&nbsp;&nbsp;&nbsp;- Contain at least 3 characters and not exceed 20 characters<br/>&nbsp;&nbsp;&nbsp;
					- Not contain spaces<br/>&nbsp;&nbsp;&nbsp;&nbsp;- Only contain alphabetic characters, digits, or underscores</i><br/>Please try again.</span>");
		else if($RegistrationError == 4)
			print("<span class=\"error\"><strong>Error:</strong><br/>Username already exists.  Please try a different Username.</span>");
		else if($RegistrationError == 5)
			print("<span class=\"error\"><strong>Error:</strong><br/>Invalid password format.<br/>
					A valid password must:<br/><i>&nbsp;&nbsp;&nbsp;&nbsp;- Contain at least 6 characters and not exceed 20 characters<br/>&nbsp;&nbsp;&nbsp;
					- Not contain spaces<br/>&nbsp;&nbsp;&nbsp;&nbsp;- Only contain alphabetic characters, digits, underscores, or hyphens</i><br/>Please try again.</span>");
		else if($RegistrationError == 6)
			print("<span class=\"error\"><strong>Error:</strong><br/>Confirm Password mismatch.  Please try again.</span>");
		else if($RegistrationError == 7)
			print("<span class=\"error\"><strong>Error:</strong><br/>Invalid First Name format.<br/>
					A valid first name must:<br/><i>&nbsp;&nbsp;&nbsp;&nbsp;- Contain at least 2 characters and not exceed 20 characters<br/>&nbsp;&nbsp;&nbsp;
					- Not contain spaces<br/>&nbsp;&nbsp;&nbsp;&nbsp;- Begin with an alphabetic character<br/>&nbsp;&nbsp;&nbsp;&nbsp;
					- Only contain alphabetic characters or hyphens</i><br/>Please try again.</span>");
		else if($RegistrationError == 8)
			print("<span class=\"error\"><strong>Error:</strong><br/>Invalid Last Name format.<br/>
					A valid last name must:<br/><i>&nbsp;&nbsp;&nbsp;&nbsp;- Contain at least 2 characters and not exceed 20 characters<br/>&nbsp;&nbsp;&nbsp;
					- Not contain spaces<br/>&nbsp;&nbsp;&nbsp;&nbsp;- Begin with an alphabetic character<br/>&nbsp;&nbsp;&nbsp;&nbsp;
					- Only contain alphabetic characters or hyphens</i><br/>Please try again.</span>");
		else if($RegistrationError == 9)
			print("<span class=\"error\"><strong>Error:</strong><br/>Invalid email address format.<br/>
				A valid email address must:<br/><i>&nbsp;&nbsp;&nbsp;&nbsp;- Be in the form <strong>yourname@domain.com</strong><br/>&nbsp;&nbsp;&nbsp;
				- Contain only alphanumeric characters, digits, underscores, dots, or hyphens</i><br/>Please try again.</span>");
		else if($RegistrationError == 10)
			print("<span class=\"error\"><strong>Error:</strong><br/>Email Address already exists under another Username.  Please try again.</span>");
		else if($RegistrationError == 11)	
			print("<span class=\"error\"><strong>Error:</strong><br/>Could not access the database!  Please try again shortly.<br/>");
?>
				</td>
			</tr>
			<tr>
				<td width="125">Username: &nbsp;</td>
				<td><input name="UserName" type="text" size="20" maxlength="20" /> <span class="instructions"> (3 to 20 characters) </span> </td>
			</tr>
			<tr>
				<td>Password: &nbsp;</td>
				<td><input name="Password" type="password" size="20" maxlength="20" /> <span class="instructions"> (6 to 20 characters) </span>  </td>
			</tr>
			<tr>
				<td>Confirm Password: &nbsp;</td>
				<td><input name="ConfirmPassword" type="password" size="20" maxlength="20" /> <span class="instructions"> (6 to 20 characters) </span>  </td>
			</tr>
			<tr>
				<td>First Name: &nbsp;</td>
				<td><input name="FirstName" type="text" size="20" maxlength="20" /> <span class="instructions"> (2 to 20 characters) </span>  </td>
			</tr>
			<tr>
				<td>Last Name: &nbsp;</td>
				<td><input name="LastName" type="text" size="20" maxlength="20" /> <span class="instructions"> (2 to 20 characters) </span>  </td>
			</tr>
			<tr>
				<td>Email Address: &nbsp;</td>
				<td><input name="EmailAddr" type="text" size="40" maxlength="40" /> <span class="instructions"> (Ex. yourname@domain.com) (Maximum 40 characters) </span>  </td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" name="Submit" value="Submit" />
					<input type="reset" value="Reset" />
				</td>
			</tr>			
		</table>
	</form>

<?php
include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>