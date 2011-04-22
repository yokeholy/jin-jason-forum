<?php
include('constants.php');
mysql_connect(HOST,USER,PASS) or die('Cannot connect to database');
mysql_select_db(DATABASE) or die('Cannot select database');
?>