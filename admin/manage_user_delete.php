<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "UPDATE admin SET is_deleted = 1 WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'User deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: manage_users.php');
	
?>