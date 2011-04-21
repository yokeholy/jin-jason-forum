<?php
include("{$_SERVER['DOCUMENT_ROOT']}/header.php");
?>

		<h1 style="text-align:left; margin-top:10px"><strong>Change Email Address</strong></h1>
		<h3 style="text-align:left; margin-top:10px">You can update your preferred email address on file.</h3><br/>
		
		<form name="ChangeEmailAddr" action="update_email_addr_action.php" method="post" style="text-align:left">
		<table width="100%" align="left" class="control_panel">
			<tr>
				<td>Confirm Old Password: &nbsp;</td>
				<td><input name="ConfirmOldPassword" type="password" size="20" maxlength="20" /> <span class="instructions"></span></td>
			</tr>
			<tr>
				<td>New Email Address: &nbsp;</td>
				<td><input name="NewEmailAddr" type="text" size="40" maxlength="40" /> <span class="instructions"> (Ex. yourname@domain.com) (Maximum 40 characters)</span></td>
			</tr>
			<tr>
				<td>Confirm New Email Address: &nbsp;</td>
				<td><input name="ConfirmNewEmailAddr" type="text" size="40" maxlength="40" /> <span class="instructions"> (Ex. yourname@domain.com) (Maximum 40 characters)</span></td>
			</tr>
			<tr>
				<td width="200">Want to receive email updates? &nbsp;</td>
				<td><label>Check here <input name="EmailCheckbox" type="checkbox" value="Yes"  /></label></td>
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