<!-- Approve -->
<div class="modal fade" id="approve">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Approve Voter</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="manage_student_status.php">
                <input type="hidden" class="id" name="id">
                <input type="hidden" name="approve"> <!-- Add this line -->
                <div class="text-center">
                    <p>Are you sure you want to approve voter ?</p>
                    <h2 class="bold fullname"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="approve"><i class="fa fa-check"></i> Approve</button> <!-- Change name to approve -->
              </form>
            </div>
        </div>
    </div>
</div>
<!-- Deny -->
<div class="modal fade" id="deny">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Deny Voter</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="manage_student_status.php">
                <input type="hidden" class="id" name="id">
                <input type="hidden" name="deny"> <!-- Add this line -->
                <div class="text-center">
                    <p>Are you sure you want to deny voter?</p>
                    <h2 class="bold fullname"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-danger btn-flat" name="deny"><i class="fa fa-times"></i> Deny</button> <!-- Change name to deny -->
              </form>
            </div>
        </div>
    </div>
</div>
<!-- Activate -->
<div class="modal fade" id="activate">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Activate Account</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="manage_student_status.php">
                <input type="hidden" class="id" name="id">
                <input type="hidden" name="active"> <!-- Add this line -->
                <div class="text-center">
                    <p>Are you sure you want to activate voter?</p>
                    <h2 class="bold fullname"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="activate"><i class="fa fa-check"></i> Activate</button> <!-- Change name to deny -->
              </form>
            </div>
        </div>
    </div>
</div>
<!-- Deactivate -->
<div class="modal fade" id="deactivate">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Deactivate Account</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="manage_student_status.php">
                <input type="hidden" class="id" name="id">
                <input type="hidden" name="deactivated"> <!-- Add this line -->
                <div class="text-center">
                    <p>Are you sure you want to deactivate voter?</p>
                    <h2 class="bold fullname"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-danger btn-flat" name="deactivate"><i class="fa fa-times"></i> Deactivate</button> <!-- Change name to deny -->
              </form>
            </div>
        </div>
    </div>
</div>
<!-- Activate Voters -->
<div class="modal fade" id="activate1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Activate Account</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="manage_student_status.php">
                <input type="hidden" class="id" name="id">
                <input type="hidden" name="active"> <!-- Add this line -->
                <div class="text-center">
                    <p>Are you sure you want to activate voter?</p>
                    <h2 class="bold fullname"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="activate1"><i class="fa fa-check"></i> Activate</button> <!-- Change name to deny -->
              </form>
            </div>
        </div>
    </div>
</div>
<!-- Deactivate Voters -->
<div class="modal fade" id="deactivate1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Deactivate Account</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="manage_student_status.php">
                <input type="hidden" class="id" name="id">
                <input type="hidden" name="deactivated"> <!-- Add this line -->
                <div class="text-center">
                    <p>Are you sure you want to deactivate voter?</p>
                    <h2 class="bold fullname"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-danger btn-flat" name="deactivate1"><i class="fa fa-times"></i> Deactivate</button> <!-- Change name to deny -->
              </form>
            </div>
        </div>
    </div>
</div>
