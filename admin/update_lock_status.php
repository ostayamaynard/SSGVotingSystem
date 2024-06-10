<?php
include 'includes/session.php';

$return = 'ballot.php';
if(isset($_GET['return'])){
    $return = $_GET['return'];
}

if (isset($_POST['saveLock'])) {
    $lockStatus = $_POST['lockStatus'];
    $sql = "UPDATE votes SET is_lock = $lockStatus";
    if($conn->query($sql)){
        if ($lockStatus == 1) {
            $_SESSION['success'] = 'Votation is locked!';
        } else {
            $_SESSION['success'] = 'Votation is unlocked!';
        }
    }
    else{
        $_SESSION['error'] = $conn->error;
    }
} else {
    // Redirect if form was not submitted properly
    $_SESSION['error'] = 'Invalid request';
}
header('location: '.$return);
?>
