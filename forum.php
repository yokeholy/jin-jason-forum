<?php 
include("{$_SERVER['DOCUMENT_ROOT']}/header.php");
?>

<p align="left"><a style="font-size:16px; margin:10px; height:20px;" href="newpost.php">Add a Thread</a></p>

<table class="MainForum" width="90%" cellspacing="0" cellpadding="0">
	<tr valign="middle" onmouseover="style.backgroundColor='#ddd'" onmouseout="style.backgroundColor='#fff'">
		<td width="60%" valign="middle" class="MainForum"><p class="TableTitle">Subject</p></td>
		<td width="18%" valign="middle" class="MainForum" align="center"><p class="TableTitle">Original Posted</p></td>
		<td width="5%" valign="middle" class="MainForum" align="center"><p class="TableTitle">Reply</p></td>
		<td width="17%" valign="middle" class="MainForum" align="center"><p class="TableTitle">Last Updated</p></td>
	</tr>

<?php
//query for sticky posts from database
$query = mysql_query("SELECT * FROM posts WHERE PostType = 0 AND Sticky = 1");
while($result = mysql_fetch_array($query))
{
	$queryUser = mysql_query("SELECT * FROM users WHERE UserID = '".$result['UserID']."'");
	$resultUser = mysql_fetch_array($queryUser);
	$PostID = $result['PostID'];
	$queryReply = mysql_query("SELECT * FROM posts WHERE ThreadID = '$PostID' AND PostID != '$PostID' ORDER BY PostID DESC");
	$resultReply = mysql_fetch_array($queryReply);
	if($resultReply)
	{
	$replyCount = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM posts WHERE ThreadID = '$PostID' AND PostID != '$PostID'"));
	$queryReplyUser = mysql_query("SELECT * FROM users WHERE UserId = '".$resultReply['UserID']."'");
	$resultReplyUser = mysql_fetch_array($queryReplyUser);
?>

	<tr onmouseover="style.backgroundColor='#ddd'" onmouseout="style.backgroundColor='#fff'">
		<td class="MainForum"><p><strong><a href="/viewthread.php?tid=<?php echo $result['PostID']?>"><span class="Sticky"><?php echo $result['Subject'];?></span></a></strong></p></td>
		<td class="MainForum" align="center"><p>by <strong><?php echo $resultUser['UserName'];?></strong> <br />at <?php echo $result['PostDate']." ".$result['PostTime'];?></p></td>
		<td class="MainForum" align="center"><p><?php echo $replyCount[0];?></p></td>
		<td class="MainForum" align="center"><p>by <strong><?php echo $resultReplyUser['UserName'];?></strong> <br />at <?php echo $resultReply['PostDate']." ".$resultReply['PostTime'];?></p></td>
	</tr>
	
<?php
	}
	else
	{
?>
	<tr onmouseover="style.backgroundColor='#ddd'" onmouseout="style.backgroundColor='#fff'">
		<td class="MainForum"><p><strong><a href="/viewthread.php?tid=<?php echo $result['PostID']?>"><span class="Sticky"><?php echo $result['Subject'];?></span></a></strong></p></td>
		<td class="MainForum" align="center"><p>by <strong><?php echo $resultUser['UserName'];?></strong> <br />at <?php echo $result['PostDate']." ".$result['PostTime'];?></p></td>
		<td class="MainForum" align="center"><p>0</p></td>
		<td class="MainForum" align="center"><p>by <strong><?php echo $resultUser['UserName'];?></strong> <br />at <?php echo $result['PostDate']." ".$result['PostTime'];?></p></td>
	</tr>

<?php
	}
}



//query for regular posts from database
$query = mysql_query("SELECT * FROM posts WHERE PostType = 0 AND Sticky = 0 LIMIT 0, 25");
while($result = mysql_fetch_array($query))
{
	$queryUser = mysql_query("SELECT * FROM users WHERE UserID = '".$result['UserID']."'");
	$resultUser = mysql_fetch_array($queryUser);
	$PostID = $result['PostID'];
	$queryReply = mysql_query("SELECT * FROM posts WHERE ThreadID = '$PostID' AND PostID != '$PostID' ORDER BY PostID DESC");
	$resultReply = mysql_fetch_array($queryReply);
	if($resultReply)
	{
	$replyCount = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM posts WHERE ThreadID = '$PostID' AND PostID != '$PostID'"));
	$queryReplyUser = mysql_query("SELECT * FROM users WHERE UserId = '".$resultReply['UserID']."'");
	$resultReplyUser = mysql_fetch_array($queryReplyUser);
?>

	<tr onmouseover="style.backgroundColor='#ddd'" onmouseout="style.backgroundColor='#fff'">
		<td class="MainForum"><p><strong><a href="/viewthread.php?tid=<?php echo $result['PostID']?>"><?php echo $result['Subject'];?></a></strong></p></td>
		<td class="MainForum" align="center"><p>by <strong><?php echo $resultUser['UserName'];?></strong> <br />at <?php echo $result['PostDate']." ".$result['PostTime'];?></p></td>
		<td class="MainForum" align="center"><p><?php echo $replyCount[0];?></p></td>
		<td class="MainForum" align="center"><p>by <strong><?php echo $resultReplyUser['UserName'];?></strong> <br />at <?php echo $resultReply['PostDate']." ".$resultReply['PostTime'];?></p></td>
	</tr>
	
<?php
	}
	else
	{
?>
	<tr onmouseover="style.backgroundColor='#ddd'" onmouseout="style.backgroundColor='#fff'">
		<td class="MainForum"><p><strong><a href="/viewthread.php?tid=<?php echo $result['PostID']?>"><?php echo $result['Subject'];?></a></strong></p></td>
		<td class="MainForum" align="center"><p>by <strong><?php echo $resultUser['UserName'];?></strong> <br />at <?php echo $result['PostDate']." ".$result['PostTime'];?></p></td>
		<td class="MainForum" align="center"><p>0</p></td>
		<td class="MainForum" align="center"><p>by <strong><?php echo $resultUser['UserName'];?></strong> <br />at <?php echo $result['PostDate']." ".$result['PostTime'];?></p></td>
	</tr>

<?php
	}
}
?>
</table>

<p align="left"><a style="font-size:16px; margin:10px; height:20px;" href="newpost.php">Add a Thread</a></p>

<?php
include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>