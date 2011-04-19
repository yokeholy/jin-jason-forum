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
		//print("Last login: " . $LastLogin);
		
		// get Total Posts to display in User Control Panel
		$queryGetTotalPosts = "SELECT COUNT(*) FROM posts WHERE UserID = '".$UserID."'";
		$result = mysql_query($queryGetTotalPosts);
		$numRows = mysql_fetch_array($result);
		$TotalPosts = $numRows[0];

		// get Threads Started to display in User Control Panel
		$queryGetThreadsStarted = "SELECT COUNT(*) FROM posts WHERE UserID = '".$UserID."' AND PostType = 0";
		$result = mysql_query($queryGetThreadsStarted);
		$numRows = mysql_fetch_array($result);
		$ThreadsStarted = $numRows[0];


?>


		<h1 style="text-align:left; margin-top:10px"><strong>User Control Panel</strong></h1>
		<h3 style="text-align:left; margin-top:10px">Welcome, <?php print($UserName);?>!  You can change view and change your info here.</h3>
		
		<div class="control_panel" style="text-align:left; margin-top:10px"/>Current User Info:</div>
		<form name="ChangeOptions" style="text-align:left">
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
				<td>Registration Date/Time (GMT): &nbsp;</td>
				<td><?php print($OrigSignup);?></td>
			</tr>
			<tr>
				<td>Last Login (GMT): &nbsp;</td>
				<td><?php print($LastLogin);?></td>
			</tr>
			<tr>
				<td>Total Posts: &nbsp;</td>
				<td><?php print($TotalPosts);?></td>
			</tr>		
			<tr>
				<td>Threads Started: &nbsp;</td>
				<td><?php print($ThreadsStarted);?></td>
			</tr>			
			<tr>
				<td>Threads per page: &nbsp;</td>
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
				<td><br/></td>
			</tr>
			<tr>
				<td><a href="/update_password.php" class="change_password">Change Password? (click here)</a></td>
			</tr>
			<tr>
				<td><br/></td>
			</tr>
			<tr>
				<td width="220"><a href="/update_email_addr.php" class="change_password">Update Email Address? (click here)</a></td>
			</tr>
		</table>
		</form>

	

<?php
} // end if (checking if LoggedIn is valid)
include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>