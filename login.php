<?php
session_start();
include 'includes/conn.php';

if (isset($_SESSION['admin'])) {
    header('location: admin/home.php');
    exit();
}

if (isset($_SESSION['voter'])) {
    header('location: home.php');
    exit();
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (is_numeric($username)) {
        // Prepare voter login query
        $voter_sql = "SELECT id, status, password, account_status FROM voters WHERE student_id = ?";
        $voter_stmt = $conn->prepare($voter_sql);
        $voter_stmt->bind_param("s", $username);
        $voter_stmt->execute();
        $voter_result = $voter_stmt->get_result();

        if ($voter_result->num_rows > 0) {
            $voter_row = $voter_result->fetch_assoc();
            if ($voter_row['status'] == 'approve' && password_verify($password, $voter_row['password']) && $voter_row['account_status'] == 'active') {
                $_SESSION['voter'] = $voter_row['id'];
                header('location: home.php');
                exit();
            } elseif (($voter_row['status'] == 'deny' || $voter_row['status'] == 'pending') && $voter_row['account_status'] == 'deactivated') {
                header('location: deactivate.html');
                exit();
            } elseif ($voter_row['status'] == 'pending' && $voter_row['account_status'] == 'active') {
                header('location: pending.html');
                exit();
            } elseif ($voter_row['status'] == 'deny' && $voter_row['account_status'] == 'active') {
                header('location: deny.html');
                exit();
            }
        } else {
            $_SESSION['error'] = 'Cannot find voter with the student ID';
            header('location: index.php');
            exit();
        }
    } else {
        // Prepare admin login query
        $admin_sql = "SELECT id, password FROM admin WHERE username = ?";
        $admin_stmt = $conn->prepare($admin_sql);
        $admin_stmt->bind_param("s", $username);
        $admin_stmt->execute();
        $admin_result = $admin_stmt->get_result();

        if ($admin_result->num_rows > 0) {
            $admin_row = $admin_result->fetch_assoc();
            if (password_verify($password, $admin_row['password'])) {
                $_SESSION['admin'] = $admin_row['id'];
                header('location: admin/home.php');
                exit();
            }
        } else {
            $_SESSION['error'] = 'Invalid admin credentials';
            header('location: index.php');
            exit();
        }
    }

    $_SESSION['error'] = 'Invalid username or password';
    header('location: index.php');
    exit();
} else {
    $_SESSION['error'] = 'Input credentials first';
    header('location: index.php');
    exit();
}
?>
