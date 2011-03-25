<?php 
include("header.php");

$Post['Subject'] = "Hello!";
$Post['LastUser'] = "Jin";
$Post['LastTime'] = date('d M Y H:i:s');
?>



<table class="MainForum" width="90%" cellspacing="0" cellpadding="0">
	<tr valign="middle" onmouseover="style.backgroundColor='#ddd'" onmouseout="style.backgroundColor='#fff'">
		<td width="50%" valign="middle" class="MainForum"><p class="TableTitle">Subject</p></td>
		<td width="35%" valign="middle" class="MainForum"><p class="TableTitle">Last Updated By</p></td>
		<td width="15%" valign="middle" class="MainForum"><p class="TableTitle">Last Updated Time</p></td>
	</tr>

<?php
for($i = 1; $i <= 50; $i ++)
{
?>

	<tr onmouseover="style.backgroundColor='#ddd'" onmouseout="style.backgroundColor='#fff'">
		<td class="MainForum"><p><strong><?php echo $Post['Subject'];?></strong></p></td>
		<td class="MainForum"><p><?php echo $Post['LastUser'];?></p></td>
		<td class="MainForum"><p><?php echo $Post['LastTime'];?></p></td>
	</tr>
	
<?php
}
?>
</table>

<?php
include("footer.php");
?>