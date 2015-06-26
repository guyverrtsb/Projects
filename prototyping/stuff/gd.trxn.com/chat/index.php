<?php
	error_reporting(0);
	$title = "AJAX Chat";
	include('includes/overall/header.php');
	
	session_start();
	$_SESSION['user'] = (isset($_GET['user']) === true) ? (int)$_GET['user'] : 0;
?>
<div class="chat">
	<div class="messages"></div>
	<textarea class="entry" placeholder="Type here and hit return. Use Shift + Return for a new line"></textarea>
</div>
<?php include('includes/overall/footer.php'); ?>