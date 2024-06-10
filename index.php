<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>User | Voting System</title>
  <?php
    session_start();
    if(isset($_SESSION['admin'])){
      header('location: admin/home.php');
    }

    if(isset($_SESSION['voter'])){
      header('location: home.php');
    }
  ?>
  <?php include 'includes/header.php'; ?>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    .container {
      display: flex;
      height: 100vh;
      width: 100%;
      margin-left: 0px;
      margin-right: 0px;
      padding-left: 0px;
      padding-right: 0px;
    }

    .background {
      position: absolute;
      left: 0;
      width: 65%;
      height: calc(100%);
      background-image: url("CECBACKG.jpg");
      background-repeat: no-repeat;
      display: block;
      margin-left: auto;
      margin-right: auto;
      align-items: center;
      background-attachment: fixed;
    }

    .box {
      position: absolute;
      right: 0;
      width: 38%;
      height: calc(100%);
      background-image: url("template.jpg");
      background-repeat: no-repeat;
      background-size: cover; /* Ensure the background image covers the entire box */
      display: flex;
      margin-left: auto;
      margin-right: auto;
      justify-content: center;
      align-items: center;
    }

    .card {
      width: 100%;
      max-width: 350px; /* Adjust this as needed */
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(1, 1, 1, 0.1);
    }

    .box-body {
      padding: 40px 30px;
      background-color: #fff;
      border-radius: 10px;
    }

    .logo {
      text-align: center;
      margin-bottom: 20px;
    }

    .logo img {
      width: 200px; /* Adjust the width as needed */
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-control {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .btn {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      text-align: center;
      color: #fff;
      background-color: #007bff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }

    .links {
      text-align: center;
      margin-top: 15px;
    }

    .links a {
      color: #007bff;
    }

    .links a:hover {
      text-decoration: underline;
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

    .white-text {
      color: white; /* Add this class to make the text white */
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
          <span class="white-text"><h2>SSG Voting System</h2></span> <!-- Apply white-text class here -->
        </div>
        <div class="box-body">
          <p class="login-box-msg">Sign in to start your session</p>

          <form action="login.php" method="POST">
            <div class="form-group">
              <input type="text" class="form-control" name="username" placeholder="Username" required>
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Password" required>
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <div class="links">
                  <a href="forgot_password.php">Forgot Password?</a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <button type="submit" class="btn btn-primary btn-block" name="login">Sign In</button>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <div class="links">
                  <a href="register.php">Register</a>
                </div>
              </div>
            </div>
          </form>
        </div>
        <?php
          if(isset($_SESSION['error'])){
            echo "
              <div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-warning'></i> Error!</h4>
                ".$_SESSION['error']."
              </div>
            ";
            unset($_SESSION['error']);
          }
          if(isset($_SESSION['success'])){
            echo "
              <div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check'></i> Success!</h4>
                ".$_SESSION['success']."
              </div>
            ";
            unset($_SESSION['success']);
          }
        ?>
      </div>
    </div>
  </div>
  <?php include 'includes/scripts.php' ?>
</body>

</html>
