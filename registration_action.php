<?php 
include("header.php");
?>

	<?php
		extract($_POST);
		
		$email_search_pattern = "/^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$/i";
		if (!preg_match($email_search_pattern, $EmailAddr))
		{
			print("<p><span class = 'error'>
               Invalid email format</span><br />
               A valid email address must be in the form
               <strong>yourname@domain.com</strong><br />
               <span class = 'distinct'>  
               Click the Back button, enter a valid email
               address and resubmit.<br /><br />
               Thank You.</span></p>");
            die(include("footer.php")); // terminate script execution
		}
	?>
	<p>Hi</p>
	
<?php
include("footer.php");
?>