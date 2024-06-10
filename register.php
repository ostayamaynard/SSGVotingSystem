<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #000080;
            color: #fff;
            /* White text */
        }

        .container {
            width: 80%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #000;
            /* Black text for form elements */
        }

        h2 {
            text-align: center;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 100px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #000;
            /* Black text for labels */
        }

        input[type="text"],
        input[type="password"],
        input[type="number"],
        select {
            width: calc(100% - 16px);
            /* Calculate the width, subtracting the padding and border width */
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .modal-footer button[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 15px 30px;
            /* Increase padding for bigger button */
            border: none;
            border-radius: 50px;
            /* Make button round */
            cursor: pointer;
            display: block;
            margin: 0 auto;
            /* Center the button */
            font-size: 16px;
            /* Increase font size */
        }

        .modal-footer button[type="submit"]:hover {
            background-color: #45a049;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .alert {
            margin-top: 20px;
        }

        .alert h4 {
            margin: 0;
            font-size: 18px;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }

        .error-message {
            color: #f00;
            font-size: 14px;
        }

        .has-error input {
            border-color: #ff0000;
            /* Red border color */
        }
    </style>
</head>

<body class="hold-transition">
    <div class="container">
        <div class="background"></div>
        <div class="box">
            <div class="card">
                <div class="logo">
                    <img src="LOGO.png" alt="Logo">
                </div>
                <div class="box-body">
                    <h2>
                        <p class="login-box-msg">Register</p>
                    </h2>
                    <form class="form-horizontal" method="POST" action="process_registration.php" enctype="multipart/form-data">
                        <div class="form-group <?php if (isset($_SESSION['error'])) echo 'has-error'; ?>">
                            <label for="student_id">Student ID</label>
                            <input type="number" id="student_id" name="student_id" required>
                            <?php if (isset($_SESSION['error'])) : ?>
                                <p class="error-message"><?php echo $_SESSION['error']; ?></p>
                                <?php unset($_SESSION['error']); ?>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="firstname">Firstname</label>
                            <input type="text" id="firstname" name="firstname" required>
                        </div>
                        <div class="form-group">
                            <label for="lastname">Lastname</label>
                            <input type="text" id="lastname" name="lastname" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select id="gender" name="gender" required>
                                <option value="" disabled selected>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="course">Course</label>
                            <select id="course" name="course" required>
                                <option value="" disabled selected>Select Course</option>
                                <option value="BSIT">BSIT</option>
                                <option value="BSHM">BSHM</option>
                                <option value="BSTM">BSTM</option>
                                <option value="BEED">BEED</option>
                                <option value="BSED">BSED</option>
                                <option value="DEVCOM">DEVCOM</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="photo">Photo</label>
                            <input type="file" id="photo" name="photo">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Submit</button>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="links">
                                    <p>Already have an account ? <a href="index.php">Sign in</a></p>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <?php include 'includes/scripts.php' ?>
</body>

</html>