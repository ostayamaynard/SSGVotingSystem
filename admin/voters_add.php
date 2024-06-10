<?php
include 'includes/session.php';

if(isset($_POST['add'])){
    $student_id = $_POST['student_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $course = $_POST['course'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $filename = $_FILES['photo']['name'];
    if(!empty($filename)){
        move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);    
    }

    // Check if the student ID already exists
    $check_sql = "SELECT * FROM voters WHERE student_id = '$student_id'";
    $check_query = $conn->query($check_sql);
    if($check_query->num_rows > 0) {
        $_SESSION['error'] = 'Student ID already exists. Please use a different student ID.';
        header('location: manage_student.php');
        exit();
    }

    // Insert the new voter record
    $sql = "INSERT INTO voters (student_id, password, firstname, lastname, gender, course, photo) 
            VALUES ('$student_id', '$password', '$firstname', '$lastname', '$gender', '$course', '$filename')";
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

header('location: manage_student.php');
?>
