<?php
session_start();
include 'includes/conn.php';

// Check if admin is already logged in
if (isset($_SESSION['admin'])) {
    header('location: home.php');
    exit();
}

// Check if voter is already logged in
if (isset($_SESSION['voter'])) {
    header('location: ../home.php');
    exit();
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the input is numeric (for voter login)
    if (is_numeric($username)) {
        $voter_sql = "SELECT * FROM voters WHERE student_id = '$username' AND status = 'approve' AND account_status = 'active'";
        $voter_query = $conn->query($voter_sql);

        if ($voter_query->num_rows > 0) {
            $voter_row = $voter_query->fetch_assoc();
            if (password_verify($password, $voter_row['password'])) {
                $_SESSION['voter'] = $voter_row['id'];
                header('location:../home.php');
                exit();
            }
        }
    } else {
        // Check if the input is non-numeric (for admin login)
        $admin_sql = "SELECT * FROM admin WHERE username = '$username'";
        $admin_query = $conn->query($admin_sql);

        if ($admin_query->num_rows > 0) {
            $admin_row = $admin_query->fetch_assoc();
            if (password_verify($password, $admin_row['password'])) {
                $_SESSION['admin'] = $admin_row['id'];
                header('location: home.php');
                exit();
            }
        }
    }

    // If the provided credentials do not match any admin or voter account
    $_SESSION['error'] = 'Invalid username or password';
    header('location: index.php');
    exit();
} else {
    $_SESSION['error'] = 'Input credentials first';
    header('location: index.php');
    exit();
}
?>
