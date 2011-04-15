<?php 
include("{$_SERVER['DOCUMENT_ROOT']}/header.php");
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
include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>
