<?php
	session_start();
	session_destroy();

	header('location: ../index.php'); // Redirect to votesystem/index.php
?>
