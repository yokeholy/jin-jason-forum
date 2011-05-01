<?php
//$PasswordError = $_SESSION['PasswordError'];
if(isset($PasswordError))
{
?>

	<h1 style="text-align:left; margin-top:10px"><strong>Change Password</strong></h1>
	<form name="ChangePassword" action="update_password_action.php" method="post" style="text-align:left">
	<table width="100%" align="left" class="control_panel">
		<tr>
			<td colspan="2">
<?php
			if($PasswordError == 1)
				print("<span class=\"error\">No data entered.</span>");
			else if($PasswordError == 2)
				print("<span class=\"error\"><strong>Error:</strong><br/>Current password must be confirmed to make changes.  Please try again.</span>");
			else if($PasswordError == 3)
				print("<span class=\"error\"><strong>Error:</strong><br/>Current password mismatch.  Please try again.</span>");
			else if($PasswordError == 4)
				print("<span class=\"error\">Current Password confirmed but no changes requested.</span>");
			else if($PasswordError == 5)
				print("<span class=\"error\"><strong>Error:</strong><br/>New password mismatch. Please try again.</span>");
			else if($PasswordError == 6)
				print("<span class=\"error\"><strong>Error:</strong><br/>Invalid password format.<br/>
						A valid password must:<br/><i>&nbsp;&nbsp;&nbsp;&nbsp;- Contain at least 6 characters and not exceed 20 characters<br/>&nbsp;&nbsp;&nbsp;
						- Not contain spaces<br/>&nbsp;&nbsp;&nbsp;&nbsp;- Only contain alphabetic characters, digits, underscores, or hyphens</i><br/>Please try again.</span>");
			else if($PasswordError == 0)
				print("<span class=\"error\">Password has been successfully changed!</span>");
?>
			</td>		
		<tr>
			<td>Confirm Old Password: &nbsp;</td>
			<td><input name="ConfirmOldPassword" type="password" size="20" maxlength="20" /> <span class="instructions"></span></td>
		</tr>
		<tr>
			<td>New Password: &nbsp;</td>
			<td><input name="NewPassword" type="password" size="20" maxlength="20" /> <span class="instructions"> (6 to 20 characters)</span></td>
		</tr>
		<tr>
			<td width="200">Confirm New Password: &nbsp;</td>
			<td><input name="ConfirmNewPassword" type="password" size="20" maxlength="20" /> <span class="instructions"> (6 to 20 characters)</span></td>
		</tr>
			<tr>
				<td colspan="2">
					<input type="submit" name="Submit" value="" style="background:url(/images/Submit.png); width:100px; height:25px; border:0px; cursor:pointer"/>
					<input type="reset" value="" style="background:url(/images/Reset.png); width:100px; height:25px; border:0px; cursor:pointer"/>
				</td>
			</tr>			
		</table>
		</form>
<?php
}else{
	print("<span class=\"error\">Invalid request.  Please return to another area of the forum.</span>");
}
include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>