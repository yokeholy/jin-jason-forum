<?php 
include("{$_SERVER['DOCUMENT_ROOT']}/header.php");
?>

	<h1 style="text-align:left; margin-top:10px"><strong>First Time User Registration</strong></h1>
	<div class="instructions2" style="text-align:left; margin-top:10px"/>Please fill in all fields below and click Submit.
		&nbsp;Click Reset to clear all fields.</div><br />
	<form name="Register" action="registration_action.php" method="post" style="text-align:left">
		<table width="100%" align="left" class="registration">
			<tr>
				<td width="100">Username: &nbsp;</td>
				<td><input type="text" size="20" name="UserName" /> <span class="instructions"> (3 to 20 characters) </span> </td>
			</tr>
			<tr>
				<td>Password: &nbsp;</td>
				<td><input type="password" size="20" name="Password" /> <span class="instructions"> (6 to 20 characters) </span>  </td>
			</tr>
			<tr>
				<td>First Name: &nbsp;</td>
				<td><input type="text" size="20" name="FirstName" /> <span class="instructions"> (2 to 20 characters) </span>  </td>
			</tr>
			<tr>
				<td>Last Name: &nbsp;</td>
				<td><input type="text" size="20" name="LastName" /> <span class="instructions"> (2 to 20 characters) </span>  </td>
			</tr>
			<tr>
				<td>Email Address: &nbsp;</td>
				<td><input type="text" size="40" name="EmailAddr" /> <span class="instructions"> (Ex. yourname@domain.com) (Maximum 40 characters) </span>  </td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" value="Submit" />
					<input type="reset" value="Reset" />
				</td>
			</tr>			
		</table>
	</form>


<?php
include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>