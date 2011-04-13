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
		
		
		$LastLogin = $_SESSION['LastLogin'];
		//echo $UserName;
		//echo $Password;
		//echo $EmailAddr;
		
	//	$getEmailAddr = "SELECT EmailAddr FROM users WHERE UserName = '".$UserName."'";
	//	$EmailAddr = mysql_fetch_row(mysql_query($getEmailAddr));

	// get date and time:
		$now = getdate();

		$year = $now['year'];
		$month = $now['mon'];
		$day = $now['mday'];
		$hours = $now['hours'];
		$minutes = $now['minutes'];
		$seconds = $now['seconds'];
		
		//print("<p>$year-$month-$day  $hours:$minutes:$seconds</p>");

		$dateAndTime = "<p>$year-$month-$day  $hours:$minutes:$seconds</p>";
		print("Last login: " . $LastLogin);
	
?>


	<h1 style="text-align:left; margin-top:10px"><strong>User Control Panel</strong></h1>
	<h3 style="text-align:left; margin-top:10px">Welcome, <?php print($UserName);?>!  You can change your preferences here.</h3>
	
	<div class="control_panel" style="text-align:left; margin-top:10px"/>Current User Info:</div>
	<form name="ChangeOptions" action="ControlPanel_action.php" method="post" style="text-align:left">
	<table width="100%" align="left" class="control_panel">
		<tr>
			<td>Username: &nbsp;</td>
			<td><?php print($UserName);?></td>
		</tr>
		<tr>
			<td>Email Address: &nbsp;</td>
			<td><?php print($EmailAddr);?></td>
		</tr>
		<tr>
			<td>Registration Date/Time: &nbsp;</td>
			<td><?php print($OrigSignup);?></td>
		</tr>
		<tr>
			<td>Last Login: &nbsp;</td>
			<td><?php print($LastLogin);?></td>
		</tr>
		<tr>
			<td>Total Posts: &nbsp;</td>
			<td>How do I put $TotalPosts here?</td>
		</tr>		
		
	
			<tr>
				<td width="200">Threads per page: &nbsp;</td>
				<td><select name="ThreadsPerPage" >
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
				<td><label>Check here <input name="EmailUpdates" type="checkbox" value="Yes"  /></label></td>
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