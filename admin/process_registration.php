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

    $sql = "INSERT INTO voters (username, password, firstname, lastname, gender, course, photo) 
            VALUES ('$username', '$password', '$firstname', '$lastname', '$gender', '$course', '$filename')";
    if($conn->query($sql)){
        $_SESSION['success'] = 'Your account is now pending, wait for the approval';
    }
    else{
        $_SESSION['error'] = $conn->error;
    }
}
else{
    $_SESSION['error'] = 'Please fill out the add form first';
}

header('location:index.php');
?>
