<?php
include("{$_SERVER['DOCUMENT_ROOT']}/header.php");
//session_start();
?>

<?php
	if(isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] == 1)
	{
				
		$UserName = $_SESSION['UserName'];
		$Password = $_SESSION['Password'];
		$EmailAddr = $_SESSION['EmailAddr'];
		$OrigSignup = $_SESSION['OrigSignup'];
		
		$UserID = $_SESSION['UserID'];
		$LastLogin = $_SESSION['LastLogin'];
?>

		<h1 style="text-align:left; margin-top:10px"><strong>Change Password</strong></h1>
		<form name="ChangePassword" action="update_password_action.php" method="post" style="text-align:left">
		<table width="100%" align="left" class="control_panel">
			<tr>
				<td>Confirm Old Password: &nbsp;</td>
				<td><input name="ConfirmOldPassword" type="password" size="20" maxlength="20" /> <span class="instructions"></span></td>
			</tr>
			<tr>
				<td>New Password: &nbsp;</td>
				<td><input name="NewPassword" type="password" size="20" maxlength="20" /> <span class="instructions"> (6 to 20 characters)</span></td>
			</tr>
			<tr>
				<td>Confirm New Password: &nbsp;</td>
				<td><input name="ConfirmNewPassword" type="password" size="20" maxlength="20" /> <span class="instructions"> (6 to 20 characters)</span></td>
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
} // end if (checking if LoggedIn is valid)
include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>