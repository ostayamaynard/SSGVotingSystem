<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Manage Students
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Students</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Denied!</h4>
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
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
          <?php if ($user['user_type'] === 'admin'): ?>
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div>
            <?php endif; ?>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Student ID</th>
                  <th>Lastname</th>
                  <th>Firstname</th>
                  <th>Gender</th>
                  <th>Course</th>
                  <th>Photo</th>
                  <th>Status</th>
                  <th>Manage Account</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT * FROM voters  WHERE status != 'approve'";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $image = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg';
                      echo "
                        <tr>
                          <td>".$row['student_id']."</td>
                          <td>".$row['lastname']."</td>
                          <td>".$row['firstname']."</td>
                          <td>".$row['gender']."</td>
                          <td>".$row['course']."</td>
                          <td>
                            <img src='".$image."' width='30px' height='30px'>
                          </td>
                          <td>
                          ";
                          if($row['status'] != 'deny') {
                              echo "
                                  <button class='btn btn-success btn-sm approve btn-flat' data-id='".$row['id']."'><i class='fa fa-edit'></i> Approve</button>
                                  <button class='btn btn-danger btn-sm deny btn-flat' data-id='".$row['id']."'><i class='fa fa-trash'></i> Deny</button>
                              ";
                          } else {
                              echo "<span style='color: red;'>Deny</span>";
                          }
                          echo "
                          </td>
                          <td>
                          ";
                          if($row['account_status'] != 'active') {
                              echo "
                                  <button class='btn btn-success btn-sm activate btn-flat' data-id='".$row['id']."'>Activate</button>
                              ";
                          } else {
                              echo "
                                  <button class='btn btn-danger btn-sm deactivate btn-flat' data-id='".$row['id']."'> Deactivate</button>
                              ";
                          }
                          echo "
                          </td>
                              </tr>
                          ";
                      }
                      ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/voters_modal.php'; ?>
  <?php include 'includes/manage_student_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $(document).on('click', '.approve', function(e){
    e.preventDefault();
    $('#approve').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.deny', function(e){
    e.preventDefault();
    $('#deny').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.activate', function(e){
    e.preventDefault();
    $('#activate').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.deactivate', function(e){
    e.preventDefault();
    $('#deactivate').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'manage_student_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.id').val(response.id);
      $('#edit_firstname').val(response.firstname);
      $('#edit_lastname').val(response.lastname);
      $('#edit_gender').val(response.gender);
      $('#edit_course').val(response.course);
      $('#edit_password').val(response.password);
      $('.fullname').html(response.firstname+' '+response.lastname);
    }
  });
}
</script>
</body>
</html>
