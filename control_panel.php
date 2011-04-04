<?php
include("{$_SERVER['DOCUMENT_ROOT']}/header.php");
?>

<?php
	extract($_POST);
?>

	<h1 style="text-align:left; margin-top:10px"><strong>User Control Panel</strong></h1>
	<h2 style="text-align:left; margin-top:10px">Welcome, FirstName!  You can change your preferences here.</h2>
	<div class="instructions2" style="text-align:left; margin-top:10px"/>Change preferences here.
		&nbsp;Click Reset to clear all fields.</div><br />
	<form name="Register" action="registration_action.php" method="post" style="text-align:left">
		<table width="100%" align="left" class="registration">
			<tr>
				<td width="100">Username: &nbsp;</td>
				<td><input name="UserName" type="text" size="20" maxlength="20" /> <span class="instructions"> (3 to 20 characters) </span> </td>
			</tr>
			<tr>
				<td>Password: &nbsp;</td>
				<td><input name="Password" type="password" size="20" maxlength="20" /> <span class="instructions"> (6 to 20 characters) </span>  </td>
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
					<input type="submit" value="Submit" />
					<input type="reset" value="Reset" />
				</td>
			</tr>			
		</table>
	</form>


<?php
include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>