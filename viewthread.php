<?php 
include("{$_SERVER['DOCUMENT_ROOT']}/header.php");
extract($_GET);
$_SESSION['tid'] = $tid;
$query = mysql_query("SELECT * FROM posts WHERE PostID = '$tid'");
$result = mysql_fetch_array($query);
if($result && $result['PostType'] != 1)
{
	$queryUser = mysql_query("SELECT * FROM users WHERE UserID = '".$result['UserID']."'");
	$resultUser = mysql_fetch_array($queryUser);
?>
	<form action="newpost.php" method="post">
	<p align="left"><a style="font-size:12px; margin:10px;" href="forum.php">Go Back</a></p>
	
		<input name="NewReply" type="submit" value="" style="background:url(/images/NewReply.png); width:100px; height:25px; border:0px; cursor:pointer; margin:10px;"/>
		<input name="Sticky" type="hidden" value="<?php echo $result['Sticky']; ?>" />
		<input name="NewType" type="hidden" value="1" />
		<input name="tid" type="hidden" value="<?php echo $tid; ?>" />
		<input name="subject" type="hidden" value="<?php echo $result['Subject']; ?>" />
	
	<table class="ThreadTable" width="100%" style="word-break:break-all;">
		<tr>
			<td rowspan="2" class="Thread" width="20%">
				<p>Posted by <strong><?php echo $resultUser['UserName']; ?></strong><br />
				at <strong><?php echo $result['PostDate']." ".$result['PostTime']; ?></strong></p>
			</td>
			<td class="Thread">
				<h2><?php echo $result['Subject'];?></h2>
			</td>
		</tr>
		<tr>
			<td class="Thread" height="200px">
				<p><?php echo $result['PostContent'];?></p>
			</td>
		</tr>
		
	<?php
	//check if this thread has replies, if it does, pull out all the posts and display below
	$query = mysql_query("SELECT * FROM posts WHERE ThreadID = '$tid' AND PostID != '$tid'");
	while($result = mysql_fetch_array($query))
	{
		$queryUser = mysql_query("SELECT * FROM users WHERE UserID = '".$result['UserID']."'");
		$resultUser = mysql_fetch_array($queryUser);
	?>
		<tr>
			<td rowspan="2" class="Thread" width="20%">
				<p>Posted by <strong><?php echo $resultUser['UserName'] ?></strong><br />
				at <strong><?php echo $result['PostDate']." ".$result['PostTime'];?></strong></p>
			</td>
			<td class="Thread">
				<h2><?php echo $result['Subject'];?></h2>
			</td>
		</tr>
		<tr>
			<td class="Thread" height="200px">
				<p><?php echo $result['PostContent'];?></p>
			</td>
		</tr>
	<?php }	?>
	</table>
		<input name="NewReply" type="submit" value="" style="background:url(/images/NewReply.png); width:100px; height:25px; border:0px; cursor:pointer; margin:10px"/>
	</form>
	<p align="left"><a style="font-size:12px; margin:10px;" href="forum.php">Go Back</a></p>
	
<?php 
}
else
	echo ("<p>Invalid request.</p>");
include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>