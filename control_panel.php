<?php
include("{$_SERVER['DOCUMENT_ROOT']}/header.php");
?>

<?php
	extract($_POST);
?>


	<h1 style="text-align:left; margin-top:10px"><strong>User Control Panel</strong></h1>
	<h3 style="text-align:left; margin-top:10px">Welcome, FirstName!  You can change your preferences here.</h3>
	
	<div class="control_panel" style="text-align:left; margin-top:10px"/>Current User Info:</div>
	<table width="50%" align="left" class="control_panel">
		<tr>
			<td>Username: &nbsp;</td>
			<td>How do I put $UserName here?</td>
		</tr>
		<tr>
			<td>Email Address: &nbsp;</td>
			<td>How do I put $EmailAddr here?</td>
		</tr>
		<tr>
			<td>Registration Date: &nbsp;</td>
			<td>How do I put $RegDate here?</td>
		</tr>
		<tr>
			<td>Total Posts: &nbsp;</td>
			<td>How do I put $TotalPosts here?</td>
		</tr>		
		
	
	<form name="ChangeOptions" action="ControlPanel_action.php" method="post" style="text-align:left">
		<table width="100%" align="left" class="UserOptions">
			<tr>
				<td width="200">Threads per page: &nbsp;</td>
				<td><select name="ThreadsPerPage" 
						<option selected = "selected">10</option>
						<option>25</option>
						<option>50</option>
						<option>100</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Thread Order: &nbsp;</td>
				<td><label>Newest First <input name="ThreadOrder" type="checkbox" value="NewestFirst"/> </label>
					<label>Oldest First <input name="ThreadOrder" type="checkbox" value="OldestFirst"/> </label></td>
			</tr>
			<tr>
				<td>Change Password: &nbsp;</td>
				<td><input name="ChangePassword" type="password" size="20" maxlength="20" /> <span class="instructions"> (6 to 20 characters)</span></td>
			</tr>
			<tr>
				<td>Confirm Password: &nbsp;</td>
				<td><input name="ConfirmPassword" type="password" size="20" maxlength="20" /> <span class="instructions"> (6 to 20 characters)</span></td>
			</tr>
			<tr>
				<td>Change Email Address? &nbsp;</td>
				<td><input name="ChangeEmailAddr" type="text" size="40" maxlength="40" /> <span class="instructions"> (Ex. yourname@domain.com) (Maximum 40 characters)</span></td>
			</tr>
			<tr>
				<td>Confirm Email Address: &nbsp;</td>
				<td><input name="ConfirmEmailAddr" type="text" size="40" maxlength="40" /> <span class="instructions"> (Ex. yourname@domain.com) (Maximum 40 characters)</span></td>
			</tr>
			<tr>
				<td>Want to receive email updates? &nbsp;</td>
				<td><label>Check here <input name="EmailUpdates" type="checkbox" value="Yes" </label></td>
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