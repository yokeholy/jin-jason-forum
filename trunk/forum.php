<?php 
include("header.php");

$Post['LastUser'] = "Jin";
?>



<table class="MainForum" width="90%" cellspacing="0" cellpadding="0">
	<tr valign="middle" onmouseover="style.backgroundColor='#ddd'" onmouseout="style.backgroundColor='#fff'">
		<td width="60%" valign="middle" class="MainForum"><p class="TableTitle">Subject</p></td>
		<td width="20%" valign="middle" class="MainForum" align="center"><p class="TableTitle">Last Updated</p></td>
		<td width="20%" valign="middle" class="MainForum" align="center"><p class="TableTitle">Original Posted</p></td>
	</tr>

<?php
for($i = 1; $i <= 50; $i ++)
{
	$Post['Subject'] = "Hello! Here is to generate some random number: " . rand(10000000,0) . " - " . rand(10000000,0) . " - " . rand(10000000,0) . " - " . rand(10000000,0);
	$Post['LastTime'] = date('d M Y H:i:s');
?>

	<tr onmouseover="style.backgroundColor='#ddd'" onmouseout="style.backgroundColor='#fff'">
		<td class="MainForum"><p><strong><?php echo $Post['Subject'];?></strong></p></td>
		<td class="MainForum" align="center"><p><?php echo $Post['LastUser'];?> <br />at <?php echo $Post['LastTime'];?></p></td>
		<td class="MainForum" align="center"><p><?php echo $Post['LastUser'];?> <br />at <?php echo $Post['LastTime'];?></p></td>
	</tr>
	
<?php
}
?>
</table>

<?php
include("footer.php");
?>