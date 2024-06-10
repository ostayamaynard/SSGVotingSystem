<?php
include 'includes/session.php';

if(isset($_POST['approve'])){
    $id = $_POST['id'];
    $status = 'approve';

    $sql = "UPDATE voters SET status = '$status' WHERE id = $id";
    if($conn->query($sql)){
        $_SESSION['success'] = 'Voter approved successfully';
    }
    else{
        $_SESSION['error'] = $conn->error;
    }
    header('location: manage_student.php');
}

if(isset($_POST['deny'])){
    $id = $_POST['id'];
    $status = 'deny';

    $sql = "UPDATE voters SET status = '$status' WHERE id = $id";
    if($conn->query($sql)){
        $_SESSION['error'] = 'Voter denied successfully';
    }
    else{
        $_SESSION['error'] = $conn->error;
    }
    header('location: manage_student.php');
}
// Activate
if(isset($_POST['activate'])){
    $id = $_POST['id'];
    $account_status = 'active';

    // Check if the voter's status is "deny" and their account status is "deactivate"
    $check_sql = "SELECT * FROM voters WHERE id = $id AND status = 'deny' AND account_status = 'deactivated'";
    $check_query = $conn->query($check_sql);
    if($check_query->num_rows > 0) {
        $_SESSION['error'] = 'Voter status is "deny" and account status is "deactivate". Cannot activate.';
        header('location: manage_student.php');
        exit();
    }

    // Update the account status to "active"
    $sql = "UPDATE voters SET account_status = '$account_status' WHERE id = $id";
    if($conn->query($sql)){
        $_SESSION['success'] = 'Voter activated successfully';
    }
    else{
        $_SESSION['error'] = $conn->error;
    }
    header('location: manage_student.php');
}

//Deactivate
if(isset($_POST['deactivate'])){
    $id = $_POST['id'];
    $account_status = 'deactivated';

    $sql = "UPDATE voters SET account_status = '$account_status' WHERE id = $id";
    if($conn->query($sql)){
        $_SESSION['success'] = 'Voter deactivated successfully';
    }
    else{
        $_SESSION['error'] = $conn->error;
    }
    header('location: manage_student.php');
}
// Activate
if(isset($_POST['activate1'])){
    $id = $_POST['id'];
    $account_status = 'active';

    // Check if the voter's status is "deny" and their account status is "deactivate"
    $check_sql = "SELECT * FROM voters WHERE id = $id AND status = 'deny' AND account_status = 'deactivated'";
    $check_query = $conn->query($check_sql);
    if($check_query->num_rows > 0) {
        $_SESSION['error'] = 'Voter status is "deny" and account status is "deactivate". Cannot activate.';
        header('location: manage_student.php');
        exit();
    }

    // Update the account status to "active"
    $sql = "UPDATE voters SET account_status = '$account_status' WHERE id = $id";
    if($conn->query($sql)){
        $_SESSION['success'] = 'Voter activated successfully';
    }
    else{
        $_SESSION['error'] = $conn->error;
    }
    header('location: voters.php');
}

//Deactivate
if(isset($_POST['deactivate1'])){
    $id = $_POST['id'];
    $account_status = 'deactivated';

    $sql = "UPDATE voters SET account_status = '$account_status' WHERE id = $id";
    if($conn->query($sql)){
        $_SESSION['success'] = 'Voter deactivated successfully';
    }
    else{
        $_SESSION['error'] = $conn->error;
    }
    header('location: voters.php');
}

?>
