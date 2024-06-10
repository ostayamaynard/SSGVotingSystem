<?php
include 'includes/session.php';

if(isset($_POST['add'])){
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $user_type = $_POST['user_type'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $filename = $_FILES['photo']['name'];
    if(!empty($filename)){
        move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);    
    }
    //generate voters id
    // $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    // $voter = substr(str_shuffle($set), 0, 15);

    $sql = "INSERT INTO admin (username, password, firstname, lastname, user_type, photo) 
            VALUES ('$username', '$password', '$firstname', '$lastname', '$user_type', '$filename')";
    if($conn->query($sql)){
        $_SESSION['success'] = 'User added successfully';
    }
    else{
        $_SESSION['error'] = $conn->error;
    }
}
else{
    $_SESSION['error'] = 'Please fill out the add form first';
}

header('location: manage_users.php');
?>
