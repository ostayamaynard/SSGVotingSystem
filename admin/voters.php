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
          Registered Voters
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Registered Voters</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <?php
        if (isset($_SESSION['error'])) {
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              " . $_SESSION['error'] . "
            </div>
          ";
          unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              " . $_SESSION['success'] . "
            </div>
          ";
          unset($_SESSION['success']);
        }
        ?>
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <!-- <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div> -->
              <div class="box-body">
                <table id="example1" class="table table-bordered">
                  <thead>
                    <th>Student ID</th>
                    <th>Lastname</th>
                    <th>Firstname</th>
                    <th>Gender</th>
                    <th>Course</th>
                    <th>Photo</th>
                    <th>Tools</th>
                    <th>Manage Account</th>
                    <th></th>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * FROM voters WHERE status = 'approve' AND is_deleted = 0";
                    $query = $conn->query($sql);
                    while ($row = $query->fetch_assoc()) {
                      $image = (!empty($row['photo'])) ? '../images/' . $row['photo'] : '../images/profile.jpg';

                      // Check if the voter has voted
                      $ssql = "SELECT * FROM votes WHERE voters_id = '" . $row['id'] . "'";
                      $votes_query = $conn->query($ssql);

                      echo "
            <tr>
                <td>" . $row['student_id'] . "</td>
                <td>" . $row['lastname'] . "</td>
                <td>" . $row['firstname'] . "</td>
                <td>" . $row['gender'] . "</td>
                <td>" . $row['course'] . "</td>
                <td>
                    <img src='" . $image . "' width='30px' height='30px'>
                    <a href='#edit_photo' data-toggle='modal' class='pull-right photo' data-id='" . $row['id'] . "'><span class='fa fa-edit'></span></a>
                </td>
                <td>
                    <button class='btn btn-success btn-sm edit btn-flat' data-id='" . $row['id'] . "'><i class='fa fa-edit'></i> Edit</button>
                    <button class='btn btn-danger btn-sm delete btn-flat' data-id='" . $row['id'] . "'><i class='fa fa-trash'></i> Delete</button>
                </td>
                <td>";

                      // Manage account button
                      if ($row['account_status'] != 'active') {
                        echo "<button class='btn btn-success btn-sm activate1 btn-flat' data-id='" . $row['id'] . "'>Activate</button>";
                      } else {
                        echo "<button class='btn btn-danger btn-sm deactivate1 btn-flat' data-id='" . $row['id'] . "'> Deactivate</button>";
                      }

                      echo "</td>
                <td>";

                      // Display voted status
                      if ($votes_query->num_rows > 0) {
                        echo "<span style='color: green;'>Voted</span>";
                      } else {
                        echo "<span style='color: red;'>Not Voted</span>";
                      }

                      echo "</td>
            </tr>";
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
  <style>
    /* CSS for custom course colors */
    .course-box .bg-maroon {
      background-color: maroon;
    }

    .course-box .bg-red {
      background-color: red;
    }

    .course-box .bg-yellow {
      background-color: yellow;
    }

    .course-box .bg-blue {
      background-color: blue;
    }

    .course-box .bg-pink {
      background-color: pink;
    }

    .course-box .bg-mintgreen {
      background-color: mintgreen;
    }
  </style>
  <script>
    $(function() {
      $(document).on('click', '.edit', function(e) {
        e.preventDefault();
        $('#edit').modal('show');
        var id = $(this).data('id');
        getRow(id);
      });

      $(document).on('click', '.delete', function(e) {
        e.preventDefault();
        $('#delete').modal('show');
        var id = $(this).data('id');
        getRow(id);
      });

      $(document).on('click', '.photo', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        getRow(id);
      });

      $(document).on('click', '.activate1', function(e) {
        e.preventDefault();
        $('#activate1').modal('show');
        var id = $(this).data('id');
        getRow(id);
      });

      $(document).on('click', '.deactivate1', function(e) {
        e.preventDefault();
        $('#deactivate1').modal('show');
        var id = $(this).data('id');
        getRow(id);
      });

    });

    function getRow(id) {
      $.ajax({
        type: 'POST',
        url: 'voters_row.php',
        data: {
          id: id
        },
        dataType: 'json',
        success: function(response) {
          if (response && response.status === 'approve') {
            $('.id').val(response.id);
            $('#edit_student_id').val(response.student_id);
            $('#edit_firstname').val(response.firstname);
            $('#edit_lastname').val(response.lastname);
            $('#edit_gender').val(response.gender);
            $('#edit_course').val(response.course);
            $('#edit_password').val(response.password);
            $('.fullname').html(response.firstname + ' ' + response.lastname);
          } else {
            // Handle the case where the voter is not approved
            alert("This voter is not approved.");
          }
        },
        error: function(xhr, status, error) {
          // Handle errors
          console.error(error);
        }
      });
    }
  </script>
</body>

</html>
