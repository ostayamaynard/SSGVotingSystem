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
        Ballot Position
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Ballot Preview</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
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
     <?php
        // Fetch the is_lock value from the votes table
        $is_lock_query = $conn->query("SELECT is_lock FROM votes");
        $is_lock_row = $is_lock_query->fetch_assoc();
        $is_lock = $is_lock_row['is_lock'];

        // Determine the button text based on the is_lock value
        $button_text = ($is_lock == 1) ? "Unlock Voting" : "Lock Voting";
        $button_class = ($is_lock == 1) ? "btn-success" : "btn-primary";

        echo '<div class="row">
                <div class="box-header with-border">
                    <a href="#" data-toggle="modal" data-target="#is_lock" class="btn ' . $button_class . ' btn-sm btn-flat">' . $button_text . '</a>
                </div>';
        ?>
      <div class="row">
        <div class="col-xs-10 col-xs-offset-1" id="content">
        </div>
      </div>
      
    </section>

    
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/is_lock_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  fetch();

  $(document).on('click', '.reset', function(e){
    e.preventDefault();
    var desc = $(this).data('desc');
    $('.'+desc).iCheck('uncheck');
  });

  $(document).on('click', '.moveup', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    $('#'+id).animate({
      'marginTop' : "-300px"
    });
    $.ajax({
      type: 'POST',
      url: 'ballot_up.php',
      data:{id:id},
      dataType: 'json',
      success: function(response){
        if(!response.error){
          fetch();
        }
      }
    });
  });

  $(document).on('click', '.movedown', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    $('#'+id).animate({
      'marginTop' : "+300px"
    });
    $.ajax({
      type: 'POST',
      url: 'ballot_down.php',
      data:{id:id},
      dataType: 'json',
      success: function(response){
        if(!response.error){
          fetch();
        }
      }
    });
  });

});
$(document).ready(function() {
    $('.btn-lock').click(function() {
        var lockStatus = <?php echo $is_lock; ?>;
        lockStatus = (lockStatus == 1) ? 0 : 1; // Toggle lock status
        $.ajax({
            type: 'POST',
            url: 'update_lock_status.php',
            data: { lockStatus: lockStatus },
            success: function(response) {
                // Check if the update was successful
                if (response == 'success') {
                    var successMsg = (lockStatus == 1) ? 'Votation is locked!' : 'Votation is unlocked!';
                    alert(successMsg);
                    window.location.reload(); // Reload the page after successful update
                } else {
                    alert('Error occurred: ' + response); // Show error message
                }
            }
        });
    });
});

function fetch(){
  $.ajax({
    type: 'POST',
    url: 'ballot_fetch.php',
    dataType: 'json',
    success: function(response){
      $('#content').html(response).iCheck({checkboxClass: 'icheckbox_flat-green',radioClass: 'iradio_flat-green'});
    }
  });
}
</script>
</body>
</html>
