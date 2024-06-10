<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo (!empty($user['photo'])) ? '../images/' . $user['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $user['firstname'] . ' ' . $user['lastname']; ?> <a><i class="fa fa-circle text-success"></i> Online</a></p>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <?php if ($user['user_type'] === 'staff'): ?>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">REPORTS</li>
      <li class=""><a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li class="header">MANAGE STUDENTS</li>
      <li class=""><a href="manage_student.php"><i class="fa fa-users"></i> <span>Manage Student</span></a></li>
      <li class="header">MANAGE</li>
      <li class=""><a href="voters.php"><i class="fa fa-users"></i> <span>Registered Voters</span></a></li>
      <li class=""><a href="positions.php"><i class="fa fa-tasks"></i> <span>Positions</span></a></li>
      <li class=""><a href="candidates.php"><i class="fa fa-black-tie"></i> <span>Candidates</span></a></li>
      <li class="header">SETTINGS</li>
      <li class=""><a href="ballot.php"><i class="fa fa-file-text"></i> <span>Ballot Position</span></a></li>
      <li class=""><a href="#config" data-toggle="modal"><i class="fa fa-cog"></i> <span>Election Title</span></a></li>
    </ul>
    <?php endif; ?>
    <?php if ($user['user_type'] === 'admin'): ?>
     <ul class="sidebar-menu" data-widget="tree"> 
      <li class="header">REPORTS</li>
      <li class=""><a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li class=""><a href="votes.php"><span class="glyphicon glyphicon-lock"></span> <span>Votes</span></a></li>
      <li class="header">MANAGE STUDENTS</li>
      <li class=""><a href="manage_student.php"><i class="fa fa-users"></i> <span>Manage Student</span></a></li>
      <li class="header">MANAGE</li>
      <li class=""><a href="voters.php"><i class="fa fa-users"></i> <span>Registered Voters</span></a></li>
      <li class=""><a href="positions.php"><i class="fa fa-tasks"></i> <span>Positions</span></a></li>
      <li class=""><a href="candidates.php"><i class="fa fa-black-tie"></i> <span>Candidates</span></a></li>
      <li class="header">SETTINGS</li>
      <li class=""><a href="ballot.php"><i class="fa fa-file-text"></i> <span>Ballot Position</span></a></li>
      <li class=""><a href="#config" data-toggle="modal"><i class="fa fa-cog"></i> <span>Election Title</span></a></li> 
      <li class="header">ADMIN</li>
      <li class=""><a href="manage_users.php"><i class="fa fa-users"></i> <span>Manage User</span></a></li>
    </ul>
    <?php endif; ?>
  </section>
  <!-- /.sidebar -->
</aside>
<?php include 'config_modal.php'; ?>