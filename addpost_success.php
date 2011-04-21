<?php
include("{$_SERVER['DOCUMENT_ROOT']}/header.php");
if(isset($_SESSION['PostResult']) && $_SESSION['PostResult'] == 1)
{
	unset($_SESSION['PostResult']);
?>

<p>Yeah! Your post is now online.</p>
<p><a href="/viewthread.php?tid=<?php echo $_SESSION['tid']; ?>">View your thread</a></p>

<?php
}else{
?>
<p class="error">Please do not joke with us.</p>

<?php
}
include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>