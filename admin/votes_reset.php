<?php
	include 'includes/session.php';

	$sql = "UPDATE votes SET is_deleted = 1";
	if($conn->query($sql)){
		$_SESSION['success'] = "Votes reset successfully";
	}
	else{
		$_SESSION['error'] = "Something went wrong in reseting";
	}

	header('location: votes.php');

?>