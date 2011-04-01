<?php 
include("header.php");
//query from database
$query = mysql_query("SELECT * FROM posts WHERE PostType = 0 LIMIT 0, 25");
?>



<table class="MainForum" width="90%" cellspacing="0" cellpadding="0">
	<tr valign="middle" onmouseover="style.backgroundColor='#ddd'" onmouseout="style.backgroundColor='#fff'">
		<td width="60%" valign="middle" class="MainForum"><p class="TableTitle">Subject</p></td>
		<td width="20%" valign="middle" class="MainForum" align="center"><p class="TableTitle">Original Posted</p></td>
		<td width="20%" valign="middle" class="MainForum" align="center"><p class="TableTitle">Last Updated</p></td>
	</tr>

<?php
while($result = mysql_fetch_array($query))
{
	$queryUser = mysql_query("SELECT * FROM users WHERE UserID = '".$result['UserID']."'");
	$resultUser = mysql_fetch_array($queryUser);
	$PostID = $result['PostID'];
	$queryReply = mysql_query("SELECT * FROM posts WHERE ThreadID = '$PostID' ORDER BY 'PostID' DESC LIMIT 0, 1");
	$resultReply = mysql_fetch_array($queryReply);
	if($resultReply)
	{
	$queryReplyUser = mysql_query("SELECT * FROM users WHERE UserId = '".$resultReply['UserID']."'");
	$resultReplyUser = mysql_fetch_array($queryReplyUser);
?>

	<tr onmouseover="style.backgroundColor='#ddd'" onmouseout="style.backgroundColor='#fff'">
		<td class="MainForum"><p><strong><?php echo $result['Subject'];?></strong></p></td>
		<td class="MainForum" align="center"><p>by <strong><?php echo $resultUser['UserName'];?></strong> <br />at <?php echo $result['PostDate']." ".$result['PostTime'];?></p></td>
		<td class="MainForum" align="center"><p>by <strong><?php echo $resultReplyUser['UserName'];?></strong> <br />at <?php echo $resultReply['PostDate']." ".$resultReply['PostTime'];?></p></td>
	</tr>
	
<?php
	}
	else
	{
?>
	<tr onmouseover="style.backgroundColor='#ddd'" onmouseout="style.backgroundColor='#fff'">
		<td class="MainForum"><p><strong><?php echo $result['Subject'];?></strong></p></td>
		<td class="MainForum" align="center"><p>by <strong><?php echo $resultUser['UserName'];?></strong> <br />at <?php echo $result['PostDate']." ".$result['PostTime'];?></p></td>
		<td class="MainForum" align="center"><p>by <strong><?php echo $resultUser['UserName'];?></strong> <br />at <?php echo $result['PostDate']." ".$result['PostTime'];?></p></td>
	</tr>

<?php
	}
}
?>
</table>

<?php
include("footer.php");
?>