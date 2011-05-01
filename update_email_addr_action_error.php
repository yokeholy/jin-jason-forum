<?php
//$EmailAddrError = $_SESSION['EmailAddrError'];
//$EmailCheck = $_SESSION['EmailCheck'];
if(isset($EmailAddrError))
{
?>
	<h1 style="text-align:left; margin-top:10px"><strong>Change Email Address</strong></h1>
	<h3 style="text-align:left; margin-top:10px">You can update your preferred email address on file.</h3><br/>
	
	<form name="ChangeEmailAddr" action="update_email_addr_action.php" method="post" style="text-align:left">
	<table width="100%" align="left" class="control_panel">
		<tr>
			<td colspan="2">
<?php
		if($EmailAddrError == 1)
			print("<span class=\"error\">No data entered.</span>");
		else if($EmailAddrError == 2)
			print("<span class=\"error\"><strong>Error:</strong><br/>Current password must be confirmed to make changes.  Please try again.</span>");
		else if($EmailAddrError == 3)
			print("<span class=\"error\"><strong>Error:</strong><br/>Current password mismatch.  Please try again.</span>");
		else if($EmailAddrError == 4)
			print("<span class=\"error\">Current Password confirmed but no changes requested.</span>");
		else if($EmailAddrError == 5)
			print("<span class=\"error\">You have subscribed to email updates!</span>");
		else if($EmailAddrError == 6)
			print("<span class=\"error\"><strong>Error:</strong><br/>New email address mismatch. Please try again.</span>");
		else if($EmailAddrError == 7)
			print("<span class=\"error\"><strong>Error:</strong><br/>Invalid email address format.<br/>
					A valid email address must:<br/><i>&nbsp;&nbsp;&nbsp;&nbsp;- Be in the form <strong>yourname@domain.com</strong><br />&nbsp;&nbsp;&nbsp;
					- Contain only alphanumeric characters, digits, underscores, dots, or hyphens</i><br/>Please try again.</span>");
		else if($EmailAddrError == 0)
		{
			print("<span class=\"error\">Email address has been successfully updated!</span>");
			
			if($EmailCheck)
				print("<br/><span class=\"error\">You have subscribed to email updates!</span>");
		}
?>
			</td>
		</tr>
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
					<input type="submit" name="Submit" value="" style="background:url(/images/Submit.png); width:100px; height:25px; border:0px; cursor:pointer"/>
					<input type="reset" value="" style="background:url(/images/Reset.png); width:100px; height:25px; border:0px; cursor:pointer"/>
			</td>
		</tr>			
	</table>
	</form>

<?php
}else{
	include("{$_SERVER['DOCUMENT_ROOT']}/header.php");

	print("<span class=\"error\">Invalid request.  Please return to another area of the forum.</span>");
}
include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>