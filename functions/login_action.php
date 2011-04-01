<?php 
include("{$_SERVER['DOCUMENT_ROOT']}/header.php");
echo ('<p>Your username input is: '.$_POST['Username'].'<br />And your password input is: '.MD5($_POST['Password']).'(MD5 hashed)</p>');
include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>