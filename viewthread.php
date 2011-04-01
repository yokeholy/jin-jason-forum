<?php 
include("{$_SERVER['DOCUMENT_ROOT']}/header.php");
extract($_GET);
$query = mysql_query("SELECT * FROM posts WHERE PostID = '$tid'");
$result = mysql_fetch_array($query);
if($result && $result['PostType'] != 1)
{
$queryUser = mysql_query("SELECT * FROM users WHERE UserID = '".$result['UserID']."'");
$resultUser = mysql_fetch_array($queryUser);

?>
<table class="ThreadTable" width="100%">
<tr>
	<td rowspan="2" class="Thread" width="20%"><p>Posted by <strong><?php echo $resultUser['UserName'] ?></strong><br />
 at <strong><?php echo $result['PostDate']." ".$result['PostTime'];?></strong></p></td>
<td class="Thread"><h2><?php echo $result['Subject'];?></h2>
</td>
</tr>
<tr>
	<td class="Thread"><p><?php echo $result['PostContent'];?></p>
</td>
</tr>
</table>
<?php 
}
else
echo ("<p>Invalid request.</p>");
include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>