<?php 
include("{$_SERVER['DOCUMENT_ROOT']}/header.php");

if(!isset($_SESSION['LoggedIn']) || $_SESSION['LoggedIn'] != 1)
{
	echo('<p class = "error">Please login before posting a new thread or reply.</p>');
}
else if(!isset($_POST['Submit']) || $_POST['Submit'] != "Post!")
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
	$Content = addslashes($Content);

	if($NewType == 1) //reply process
	{
		if(!mysql_query("INSERT INTO posts (ThreadID, Subject, PostDate, PostTime, PostContent, PostType, UserID) VALUES ('$tid', '$Subject', '$Date', '$Time', '$Content', '$NewType', '$UserID')"))
			echo ('<p class="error">'.mysql_error().'</p>');
		else
			echo ('<p>Yeah! Your post is online now!</p>');
	}
	else // original post process
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
			echo ('<p>Yeah! Your post is online now!</p>');
		}
	}
?>

<?php
} // end else
include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>
