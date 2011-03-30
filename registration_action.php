<?php 
include("header.php");
?>

	<?php
		extract($_POST);
		
		$email_search_pattern = "^([0-9a-z]+)([-._0-9a-z]*)@([-._0-9a-z]+)(\.[a-z]{2,3}$)";
		if (!ereg($email_search_pattern, $EmailAddr))
		{
			print("<p><span class = 'error'>
               Invalid email format</span><br />
               A valid phone number must be in the form
               <strong>yourname@domain.com</strong><br />
               <span class = 'distinct'>  
               Click the Back button, enter a valid email
               address and resubmit.<br /><br />
               Thank You.</span></p>");
            die( "</body></html>" ); // terminate script execution
		}
	?>
	<p>Hi</p>
	
<?php
include("footer.php");
?>