<?php
include 'includes/session.php';

if(isset($_POST['add'])){
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $course = $_POST['course'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $filename = $_FILES['photo']['name'];
    if(!empty($filename)){
        move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);    
    }
    //generate voters id
    // $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    // $voter = substr(str_shuffle($set), 0, 15);

    $sql = "INSERT INTO voters (username, password, firstname, lastname, gender, course, photo) 
            VALUES ('$username', '$password', '$firstname', '$lastname', '$gender', '$course', '$filename')";
    if($conn->query($sql)){
        $_SESSION['success'] = 'Voter added successfully, please approve it ';
    }
    else{
        $_SESSION['error'] = $conn->error;
    }
}
else{
    $_SESSION['error'] = 'Please fill out the add form first';
}

header('location: index.php');
?>
