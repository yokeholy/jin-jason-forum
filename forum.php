<?php 
include("{$_SERVER['DOCUMENT_ROOT']}/header.php");
?>
<p align="left"><a href="newpost.php"><img style="margin:10px;" src="images/NewThread.png"></a></p>
<table class="MainForum" width="90%" cellspacing="0" cellpadding="0">
	<tr valign="middle" onmouseover="style.backgroundColor='#ddd'" onmouseout="style.backgroundColor='#fff'">
		<td width="60%" valign="middle" class="MainForum"><p class="TableTitle">Subject</p></td>
		<td width="18%" valign="middle" class="MainForum" align="center"><p class="TableTitle">Original Posted</p></td>
		<td width="5%" valign="middle" class="MainForum" align="center"><p class="TableTitle">Reply</p></td>
		<td width="17%" valign="middle" class="MainForum" align="center"><p class="TableTitle">Last Updated</p></td>
	</tr>

<?php
mysql_query("CREATE TEMPORARY TABLE threadlist SELECT * FROM posts GROUP BY ThreadID");
	//select ALL ORIGINAL POSTS grouped by the ThreadID so that there will be no duplicated result

//query for sticky posts from database

mysql_query("CREATE TEMPORARY TABLE templist SELECT * FROM posts WHERE Sticky = 1 ORDER BY PostID DESC");
	//order ALL posts into descending order
	
mysql_query("CREATE TEMPORARY TABLE lastupdatedlist SELECT * FROM templist GROUP BY ThreadID ORDER BY PostID DESC");
	//group the ordered posts(All in the database) by their ThreadID and order the result with PostID so that the result is actually in descending order of its Last Updated Time order
	
$masterquery = mysql_query("SELECT * FROM lastupdatedlist");
while($result = mysql_fetch_array($masterquery))
{

	$CurrentPost = $result['ThreadID'];
	
	//query for sticky posts from database
	$query = mysql_query("SELECT * FROM threadlist WHERE PostID = '$CurrentPost'");
	$result = mysql_fetch_array($query);
	$queryUser = mysql_query("SELECT * FROM users WHERE UserID = '".$result['UserID']."'");
	$resultUser = mysql_fetch_array($queryUser);
	$queryReply = mysql_query("SELECT * FROM lastupdatedlist WHERE ThreadID = '$CurrentPost'");
	$resultReply = mysql_fetch_array($queryReply);
	if($resultReply)
	{
		$replyCount = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM posts WHERE ThreadID = '$CurrentPost' AND PostID != '$CurrentPost'"));
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
	}else{
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
mysql_query("DROP TABLE templist");
mysql_query("DROP TABLE lastupdatedlist");
//destroy the two temporary tables in order to generate them again for non-sticky posts

//query for regular posts from database
mysql_query("CREATE TEMPORARY TABLE templist SELECT * FROM posts WHERE Sticky = 0 ORDER BY PostID DESC");
	//order ALL posts into descending order
	
mysql_query("CREATE TEMPORARY TABLE lastupdatedlist SELECT * FROM templist GROUP BY ThreadID ORDER BY PostID DESC");
	//group the ordered posts(All in the database) by their ThreadID and order the result with PostID so that the result is actually in descending order of its Last Updated Time order
	
$masterquery = mysql_query("SELECT * FROM lastupdatedlist");
while($result = mysql_fetch_array($masterquery))
{
	$CurrentPost = $result['ThreadID'];
	
	$query = mysql_query("SELECT * FROM threadlist WHERE PostType = 0 AND PostID = '$CurrentPost'");
	$result = mysql_fetch_array($query);
	$queryUser = mysql_query("SELECT * FROM users WHERE UserID = '".$result['UserID']."'");
	$resultUser = mysql_fetch_array($queryUser);
	$queryReply = mysql_query("SELECT * FROM lastupdatedlist WHERE ThreadID = '$CurrentPost'");
	$resultReply = mysql_fetch_array($queryReply);
	if($resultReply)
	{
		$replyCount = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM posts WHERE ThreadID = '$CurrentPost' AND PostID != '$CurrentPost'"));
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
	}else{
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

<p align="left"><a href="newpost.php"><img style="margin:10px;" src="images/NewThread.png"></a></p>

<?php
include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>