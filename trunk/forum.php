<?php 
include("header.php");

$Post['Subject'] = "Hello!";
$Post['LastUser'] = "Jin";
$Post['LastTime'] = date('d M Y H:i:s');
?>



<table class="MainForum" width="90%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="MainForum">Subject</td>
		<td class="MainForum">Last Updated By</td>
		<td class="MainForum">Last Updated Time</td>
	</tr>
	<tr>
		<td class="MainForum"><?php echo $Post['Subject'];?></td>
		<td class="MainForum"><?php echo $Post['LastUser'];?></td>
		<td class="MainForum"><?php echo $Post['LastTime'];?></td>
	</tr>
</table>

<?php
include("footer.php");
?>