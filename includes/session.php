<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	include 'includes/conn.php';

	if(!isset($_SESSION['voter']) || trim($_SESSION['voter']) == ''){
		header('location: index.php');
	}
	$sql = "SELECT * FROM voters WHERE id = '".$_SESSION['voter']."'";
	$query = $conn->query($sql);
	$voter = $query->fetch_assoc();

?>
