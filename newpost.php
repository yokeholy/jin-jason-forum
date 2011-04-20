﻿<?php 
include("{$_SERVER['DOCUMENT_ROOT']}/header.php");
if(!isset($_SESSION['LoggedIn']) || $_SESSION['LoggedIn'] != 1)
{
	echo('<p class = "error">Please login before posting a new thread or reply.</p>');
}
else
{
extract($_POST);
if(isset($NewType) && $NewType == 1) // If the new post is a reply to an existing thread. NewType 1 means that this post is a reply and will cause the page to show the New Reply interface. Otherwise, it's gonna show the New Thread interface.
{
?>

<h1 align="left">New Reply</h1>
<form action="/functions/addpost_action.php" method="post">
<input name="NewType" type="hidden" value="1" />
<input name="tid" type="hidden" value="<?php echo $tid ?>" />

	<table cellpadding="0" cellspacing="0" class="AddPostTable">
		<tr>
			<td class="AddPost"><p><strong>Subject:</strong></p></td>
			<td class="AddPost"><input name="Subject" size="75" value="Re: <?php echo $subject ?>" /></td>
		</tr>
		<tr>
			<td class="AddPost"><p><strong>Content:</strong></p></td>
			<td class="AddPost"><textarea name="Content" cols="100" rows="20"></textarea></td>
		</tr>
		<tr align="center">
			<td colspan="2" class="AddPost"><input name="Submit" type="submit" value="Post!" /><input type="reset" value="No, clean them for me"></td>
		</tr>
	</table>
</form>
<?php
}
else
{
?>
<h1 align="left">New Thread</h1>
<form action="/functions/addpost_action.php" method="post">
<input name="NewType" type="hidden" value="0" />
	<table cellpadding="0" cellspacing="0" class="AddPostTable">
		<tr>
			<td class="AddPost"><p><strong>Subject:</strong></p></td>
			<td class="AddPost"><input name="Subject" size="75"></td>
		</tr>
		<tr>
			<td class="AddPost"><p><strong>Content:</strong></p></td>
			<td class="AddPost"><textarea name="Content" cols="100" rows="20"></textarea></td>
		</tr>
		<tr align="center">
			<td colspan="2" class="AddPost"><input name="Submit" type="submit" value="Post!"><input type="reset" value="No, clean them for me"></td>
		</tr>
	</table>
</form>
<?php
}
}
include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>
