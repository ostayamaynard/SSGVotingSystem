<?php include 'includes/session.php'; ?>
<?php include 'includes/slugify.php'; ?>
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
          Dashboard
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
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
          <?php
          // Define an array mapping courses to colors
          $courses = array(
            'BSIT' => 'bg-maroon',
            'BSHM' => 'bg-red',
            'BSTM' => 'bg-yellow',
            'BEED' => 'bg-blue',
            'BSED' => 'bg-pink',
            'DEVCOM' => 'bg-green'
          );

          // Use the array to set the color class for each course
          $count_sql = "SELECT course, COUNT(*) AS num_voters FROM voters WHERE status = 'approve' AND is_deleted = 0 AND account_status = 'active' GROUP BY course";
          $count_query = $conn->query($count_sql);

          if (!$count_query) {
            // Handle query execution error
            echo "Error executing count query: " . $conn->error;
          } else {
            while ($count_row = $count_query->fetch_assoc()) {
              // Get the course name and number of voters
              $course = $count_row['course'];
              $num_voters = $count_row['num_voters'];

              // Extract course abbreviation
              $course_abbr = strtoupper(substr($course, 0, strpos($course, '-')));

              // Get the color for this course, or use a default if not found
              $course_color = isset($course_colors[$course_abbr]) ? $course_colors[$course_abbr] : "gray";

              // Display course information with custom class
              echo "<div class='col-lg-3 col-xs-6'>";
              echo "<div class='small-box " . $courses[$course] . "'>";
              echo "<div class='inner'>";
              echo "<h3>$course</h3>";
              echo "<p>Total Voters: $num_voters</p>";

              // Count the number of voters who have voted for this course
              $voted_sql = "SELECT COUNT(DISTINCT voters_id) AS num_voted FROM votes WHERE voters_id IN (SELECT id FROM voters WHERE course='$course' AND status = 'approve')";
              $voted_query = $conn->query($voted_sql);
              if ($voted_query) {
                $voted_row = $voted_query->fetch_assoc();
                $num_voted = $voted_row['num_voted'];
                echo "<p>Voted: $num_voted</p>";
              } else {
                // Handle query execution error
                echo "Error executing voted query for $course: " . $conn->error;
              }

              echo "</div>";
              echo "<div class='icon'>";
              echo "<i class='fa fa-black-tie'></i>";
              echo "</div>";
              echo "</div>";
              echo "</div>";
            }
          }
          ?>
        </div>
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-gray">
              <div class="inner">
                <?php
                $sql = "SELECT * FROM positions where is_deleted = 0";
                $query = $conn->query($sql);

                echo "<h3>" . $query->num_rows . "</h3>";
                ?>

                <p>No. of Positions</p>
              </div>
              <div class="icon">
                <i class="fa fa-tasks"></i>
              </div>
              <a href="positions.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-gray">
              <div class="inner">
                <?php
                $sql = "SELECT * FROM candidates where is_deleted = 0";
                $query = $conn->query($sql);

                echo "<h3>" . $query->num_rows . "</h3>";
                ?>

                <p>No. of Candidates</p>
              </div>
              <div class="icon">
                <i class="fa fa-black-tie"></i>
              </div>
              <a href="candidates.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-gray">
              <div class="inner">
                <?php
                $sql = "SELECT * FROM voters where status = 'approve' and account_status = 'active' and is_deleted = 0";
                $query = $conn->query($sql);

                echo "<h3>" . $query->num_rows . "</h3>";
                ?>

                <p>Total Voters</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="voters.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-gray">
              <div class="inner">
                <?php
                $sql = "SELECT * FROM votes GROUP BY voters_id";
                $query = $conn->query($sql);

                echo "<h3>" . $query->num_rows . "</h3>";
                ?>

                <p>Voters Out</p>
              </div>
              <div class="icon">
                <i class="fa fa-edit"></i>
              </div>
              <?php if ($user['user_type'] === 'admin') : ?>
                <a href="votes.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              <?php endif; ?>
              <?php if ($user['user_type'] === 'staff') : ?>
                <a href="restricted.html" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              <?php endif; ?>
            </div>
          </div>
          <!-- ./col -->
        </div>

        <div class="row">
          <div class="col-xs-12">
            <h3>Votes Tally
              <span class="pull-right">
                <!-- <a href="print.php" class="btn btn-success btn-sm btn-flat"><span class="glyphicon glyphicon-print"></span> Print</a> -->
              </span>
            </h3>
          </div>
        </div>

        <?php
        $sql = "SELECT * FROM positions where is_deleted = 0 ORDER BY priority ASC ";
        $query = $conn->query($sql);
        $inc = 2;
        while ($row = $query->fetch_assoc()) {
          $inc = ($inc == 2) ? 1 : $inc + 1;
          if ($inc == 1) echo "<div class='row'>";
          echo "
            <div class='col-sm-6'>
              <div class='box box-solid'>
                <div class='box-header with-border'>
                  <h4 class='box-title'><b>" . $row['description'] . "</b></h4>
                </div>
                <div class='box-body'>
                  <div class='chart'>
                    <canvas id='" . slugify($row['description']) . "' style='height:200px'></canvas>
                  </div>
                </div>
              </div>
            </div>
          ";
          if ($inc == 2) echo "</div>";
        }
        if ($inc == 1) echo "<div class='col-sm-6'></div></div>";
        ?>

      </section>
      <!-- right col -->
    </div>
    <?php include 'includes/footer.php'; ?>

  </div>
  <!-- ./wrapper -->

  <?php include 'includes/scripts.php'; ?>
  <?php
  $sql = "SELECT * FROM positions WHERE is_deleted = 0 ORDER BY priority ASC";
  $query = $conn->query($sql);
  while ($row = $query->fetch_assoc()) {
    $sql = "SELECT * FROM candidates WHERE position_id = '" . $row['id'] . "' AND is_deleted = 0";
    $cquery = $conn->query($sql);
    $carray = array();
    $varray = array();
    while ($crow = $cquery->fetch_assoc()) {
      array_push($carray, $crow['lastname']);
      $sql = "SELECT v.*, vo.course FROM votes v INNER JOIN voters vo ON v.voters_id = vo.id WHERE v.candidate_id = '" . $crow['id'] . "' AND vo.status = 'approve' AND vo.account_status = 'active' AND vo.is_deleted = 0 AND v.is_deleted = 0";
      $vquery = $conn->query($sql);
      array_push($varray, $vquery->num_rows);
    }
    $carray = json_encode($carray);
    $varray = json_encode($varray);

    $courseColors = array();
    // Define an array mapping color names to RGB values
    $colorMappings = array(
      'bg-maroon' => 'rgba(255, 20, 60, 0.9)',   // Maroon
      'bg-red' => 'rgba(255, 99, 71, 0.9)',      // Red
      'bg-yellow' => 'rgba(255, 255, 0, 0.9)',   // Yellow
      'bg-blue' => 'rgba(66, 139, 202, 0.9)',    // Blue
      'bg-pink' => 'rgba(241, 148, 138, 0.9)',   // Pink
      'bg-green' => 'rgba(106, 176, 76, 0.9)'    // Green
    );

    $courseColors = array();

    foreach ($courses as $course => $color) {
      $sql = "SELECT COUNT(*) AS num_votes FROM votes v INNER JOIN voters vo ON v.voters_id = vo.id WHERE vo.course = '$course' AND v.candidate_id IN (SELECT id FROM candidates WHERE position_id = '" . $row['id'] . "') AND vo.status = 'approve' AND vo.account_status = 'active' AND vo.is_deleted = 0 AND v.is_deleted = 0";
      $result = $conn->query($sql);
      $innerRow = $result->fetch_assoc();
      if ($innerRow['num_votes'] > 0) {
        // If votes exist for this course, add its color to the array
        // Replace color name with RGB value
        $courseColors[$color] = $colorMappings[$color];
      }
    }

    $courseColors = json_encode(array_values($courseColors));
  ?>
<script>
 $(function() {
      <?php
      // Loop through each position
      $sql = "SELECT * FROM positions WHERE is_deleted = 0 ORDER BY priority ASC";
      $query = $conn->query($sql);
      while ($row = $query->fetch_assoc()) {
        // Fetch candidates and their votes for this position
        $sql = "SELECT * FROM candidates WHERE position_id = '" . $row['id'] . "' AND is_deleted = 0";
        $cquery = $conn->query($sql);
        $carray = array();
        $varray = array();
        while ($crow = $cquery->fetch_assoc()) {
          array_push($carray, $crow['lastname']);
          $sql = "SELECT v.*, vo.course FROM votes v INNER JOIN voters vo ON v.voters_id = vo.id WHERE v.candidate_id = '" . $crow['id'] . "' AND vo.status = 'approve' AND vo.account_status = 'active' AND vo.is_deleted = 0 AND v.is_deleted = 0";
          $vquery = $conn->query($sql);
          array_push($varray, $vquery->num_rows);
        }
        $carray = json_encode($carray);
        $varray = json_encode($varray);

        // Calculate and encode colors for this position
        $courseColors = array();
        $colorMappings = array(
          'bg-maroon' => 'rgba(255, 20, 60, 0.9)',   // Maroon
          'bg-red' => 'rgba(255, 99, 71, 0.9)',      // Red
          'bg-yellow' => 'rgba(255, 255, 0, 0.9)',   // Yellow
          'bg-blue' => 'rgba(66, 139, 202, 0.9)',    // Blue
          'bg-pink' => 'rgba(241, 148, 138, 0.9)',   // Pink
          'bg-green' => 'rgba(106, 176, 76, 0.9)'    // Green
        );

      foreach ($courses as $course => $color) {
        $sql = "SELECT COUNT(*) AS num_votes FROM votes v INNER JOIN voters vo ON v.voters_id = vo.id WHERE vo.course = '$course' AND v.candidate_id IN (SELECT id FROM candidates WHERE position_id = '" . $row['id'] . "') AND vo.status = 'approve' AND vo.account_status = 'active' AND vo.is_deleted = 0 AND v.is_deleted = 0";
        $result = $conn->query($sql);
        $innerRow = $result->fetch_assoc();
        if ($innerRow['num_votes'] > 0) {
          $courseColors[] = $colorMappings[$color];
        }
      }
      $courseColors = json_encode($courseColors);
    ?>
      var description = '<?php echo slugify($row['description']); ?>';
      var barChartCanvas = $('#' + description).get(0).getContext('2d');
      var barChart = new Chart(barChartCanvas);
      var barChartData = {
        labels: <?php echo $carray; ?>,
        datasets: [
          <?php
          // Loop through each color and add a dataset
          foreach (json_decode($courseColors) as $key => $color) {
            echo "{";
            echo "label: 'Votes',";
            echo "fillColor: '" . $color . "',";
            echo "strokeColor: '" . $color . "',";
            echo "pointColor: '" . $color . "',";
            echo "pointStrokeColor: '" . $color . "',";
            echo "pointHighlightFill: '#fff',";
            echo "pointHighlightStroke: '" . $color . "',";
            echo "data: " . $varray;
            echo "},";
          }
          ?>
        ]
      };
      var barChartOptions = {
        scaleBeginAtZero: true,
        scaleShowGridLines: true,
        scaleGridLineColor: 'rgba(0,0,0,.50)',
        scaleGridLineWidth: 1,
        scaleShowHorizontalLines: true,
        scaleShowVerticalLines: true,
        barShowStroke: true,
        barStrokeWidth: 2,
        barValueSpacing: 5,
        barDatasetSpacing: 1,
        responsive: true,
        maintainAspectRatio: true
      };
      barChartOptions.datasetFill = false;
      var myChart = barChart.HorizontalBar(barChartData, barChartOptions);
    <?php } ?>
  });
</script>
  <?php
  }
  ?>
  <?php include 'includes/scripts.php'; ?>
</body>

</html>