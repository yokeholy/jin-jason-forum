<?php 
include("{$_SERVER['DOCUMENT_ROOT']}/header.php");

if(!isset($_SESSION['LoggedIn']) || $_SESSION['LoggedIn'] != 1)
{
	echo('<p class = "error">Please login before posting a new thread or reply.</p>');
}
else if(!isset($_POST['Submit']) || $_POST['Submit'] != "")
{
	echo('<p class = "error">Invalid request! Please add a post through the right form.</p>');
}
else
{
	extract($_POST);
	extract($_SESSION);
	$Date = date('Y-m-d');
	$Time = date('H:i:s');
	$Subject = addslashes($Subject);
	$Content = nl2br($Content);
	$Content = addslashes($Content);

	if($NewType == 1) //reply process
	{
		if(!mysql_query("INSERT INTO posts (ThreadID, Subject, PostDate, PostTime, PostContent, PostType, UserID, Sticky) VALUES ('$tid', '$Subject', '$Date', '$Time', '$Content', '$NewType', '$UserID', '$Sticky')"))
			echo ('<p class="error">'.mysql_error().'</p>');
		else
		{
			$_SESSION['PostResult'] = 1;
			header ("Location: /addpost_success.php");
		}
	}
	else
	
	// original post process
	{
		if(!mysql_query("INSERT INTO posts (Subject, PostDate, PostTime, PostContent, PostType, UserID) VALUES ('$Subject', '$Date', '$Time', '$Content', '$NewType', '$UserID')"))
			echo ('<p class="error">'.mysql_error().'</p>');
		else
		{
			$PostID = mysql_fetch_array(mysql_query("SELECT MAX(PostID) FROM posts"));
			$pid = $PostID[0];
			if(!mysql_query("UPDATE posts SET ThreadID = '$pid' WHERE PostID = '$pid'"))
			echo ('<p class="error">'.mysql_error().'</p>');
			else
			{
				$_SESSION['tid'] = $pid;
				$_SESSION['PostResult'] = 1;
				header ("Location: /addpost_success.php");
			}
		}
	}
?>

<?php
} // end else
include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>
