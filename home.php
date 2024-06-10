<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
        <?php include 'includes/navbar.php'; ?>
        <div class="content-wrapper">
            <div class="container">
                <!-- Main content -->
                <section class="content">
                    <?php
                    $parse = parse_ini_file('admin/config.ini', FALSE, INI_SCANNER_RAW);
                    $title = $parse['election_title'];
                    ?>
                    <h1 class="page-header text-center title"><b><?php echo strtoupper($title); ?></b></h1>
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                            <?php
                            if (isset($_SESSION['error'])) {
                            ?>
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <ul>
                                        <?php
                                        foreach ($_SESSION['error'] as $error) {
                                            echo "<li>" . $error . "</li>";
                                        }
                                        ?>
                                    </ul>
                                </div>
                            <?php
                                unset($_SESSION['error']);
                            }
                            if (isset($_SESSION['success'])) {
                                echo "
                            <div class='alert alert-success alert-dismissible'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <h4><i class='icon fa fa-check'></i> Success!</h4>
                                " . $_SESSION['success'] . "
                            </div>";
                                unset($_SESSION['success']);
                            }
                            ?>

                            <div class="alert alert-danger alert-dismissible" id="alert" style="display:none;">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <span class="message"></span>
                            </div>

                            <?php
                            // Query to fetch the is_lock value from the votes table
                            $ssql = "SELECT * FROM votes WHERE voters_id = '" . $voter['id'] . "'";
                            $sql = "SELECT is_lock FROM votes";
                            $query = $conn->query($ssql);
                            $vquery = $conn->query($sql);
                            $is_lock = 0; // Initialize is_lock value

                            if ($vquery) {
                                // Loop through the result set to find the maximum value of is_lock
                                while ($row = $vquery->fetch_assoc()) {
                                    $is_lock = max($is_lock, $row['is_lock']);
                                }
                            }

                            // Check if the vote is locked
                            if ($is_lock == 1) {
                            ?>
                                <div class="text-center">
                                    <h3>The voting for this election has ended.</h3>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <!--Vote winner-->
                                        <div class="col-sm-6" style="margin:25px 160px;">
                                            <?php
                                            $sql = "SELECT * FROM positions WHERE is_deleted = 0 ORDER BY priority ASC";
                                            $query = $conn->query($sql);
                                            while ($row = $query->fetch_assoc()) {
                                                $position_id = $row['id'];
                                                $position_description = $row['description'];

                                                // Fetch candidates for this position
                                                $candidates_sql = "SELECT * FROM candidates WHERE position_id = '$position_id'";
                                                $candidates_query = $conn->query($candidates_sql);

                                                // Fetch candidate(s) with the most votes for this position
                                                $winner_sql = "SELECT c.id, c.firstname, c.lastname, COUNT(v.id) AS num_votes
                                             FROM candidates c
                                             LEFT JOIN votes v ON c.id = v.candidate_id
                                             WHERE c.position_id = '$position_id' AND c.is_deleted = 0
                                             GROUP BY c.id
                                             ORDER BY num_votes DESC";

                                                $winner_query = $conn->query($winner_sql);
                                                $first_candidate = $winner_query->fetch_assoc();
                                                $second_candidate = $winner_query->fetch_assoc();

                                                // Check if there's a tie
                                                if ($first_candidate['num_votes'] == $second_candidate['num_votes']) {
                                                    echo "<div class='box box-solid'>
                                                        <div class='box-header with-border'>
                                                            <h4 class='box-title'><b>$position_description:</b></h4>
                                                        </div>
                                                        <div class='box-body'>
                                                            <ul class='list-group'>
                                                                <li class='list-group-item'>Tie between " . $first_candidate['firstname'] . " " . $first_candidate['lastname'] . " and " . $second_candidate['firstname'] . " " . $second_candidate['lastname'] . " (Votes: " . $first_candidate['num_votes'] . ")</li>
                                                            </ul>
                                                        </div>
                                                    </div>";
                                                } else {
                                                    // If there's no tie, display the winner
                                                    $winner_name = $first_candidate['firstname'] . " " . $first_candidate['lastname'];
                                                    $num_votes = $first_candidate['num_votes'];

                                                    echo "<div class='box box-solid'>
                                                        <div class='box-header with-border'>
                                                            <h4 class='box-title'><b>$position_description Winner:</b></h4>
                                                        </div>
                                                        <div class='box-body'>
                                                            <ul class='list-group'>
                                                                <li class='list-group-item'>$winner_name (Votes: $num_votes)</li>
                                                            </ul>
                                                        </div>
                                                    </div>";
                                                }
                                            }
                                            ?>

                                        </div>
                                    </div>
                                    <!--End of Vote winner-->
                                </div>

                            <?php
                            } elseif ($query->num_rows > 0) {
                            ?>
                                <div class="text-center">
                                    <h3>You have already voted for this election.</h3>
                                    <a href="#view" data-toggle="modal" class="btn btn-flat btn-primary btn-lg">View Ballot</a>
                                    <!-- Votes Tally Section -->
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h3>Votes Tally
                                                <span class="pull-right">
                                                </span>
                                            </h3>
                                        </div>
                                    </div>
                                    <!--Vote Tally-->
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-6" style="margin:25px 160px;">
                                                <?php
                                                // Fetch positions
                                                $sql = "SELECT * FROM positions WHERE is_deleted = 0 ORDER BY priority ASC";
                                                $query = $conn->query($sql);
                                                while ($row = $query->fetch_assoc()) {
                                                    $position_id = $row['id'];
                                                    $position_description = $row['description'];

                                                    // Fetch candidates for this position
                                                    $candidates_sql = "SELECT * FROM candidates WHERE is_deleted = 0 and position_id = '$position_id'";
                                                    $candidates_query = $conn->query($candidates_sql);

                                                    echo "
                                                           <div class='box box-solid'>
                                                             <div class='box-header with-border'>
                                                                     <h4 class='box-title'><b>$position_description</b></h4>
                                                             </div>
                                                          <div class='box-body'>
                                                          <ul class='list-group' id='candidate-votes-$position_id'>";

                                                    // Loop through candidates
                                                    while ($candidate = $candidates_query->fetch_assoc()) {
                                                        $candidate_id = $candidate['id'];

                                                        // Fetch number of votes for this candidate
                                                        $votes_sql = "SELECT COUNT(*) AS num_votes FROM votes WHERE candidate_id = '$candidate_id' and is_deleted = 0 ";
                                                        $votes_query = $conn->query($votes_sql);
                                                        $votes_row = $votes_query->fetch_assoc();
                                                        $num_votes = $votes_row['num_votes'];

                                                        echo "
                                                         <li class='list-group-item'>$num_votes</li>";
                                                    }

                                                    echo "
                                                                        </ul>
                                                                  </div>
                                                         </div>";
                                                }
                                                ?>
                                            </div>
                                        </div>

                                        <!-- <div class="row">
                                            //add php opening if uncomment '
                                            // Fetch the number of voters per course
                                            // $count_sql = "SELECT course, COUNT(*) AS num_voters FROM voters WHERE status = 'approve' AND is_deleted = 0 AND account_status = 'active' GROUP BY course";
                                            // $count_query = $conn->query($count_sql);
                                            // while ($count_row = $count_query->fetch_assoc()) {
                                            //     // Count the number of voters who voted for each course
                                            //     $voted_sql = "SELECT COUNT(DISTINCT voters_id) AS num_voted FROM votes WHERE voters_id IN (SELECT id FROM voters WHERE course='" . $count_row['course'] . "' AND status = 'approve' AND is_deleted = 0 AND account_status = 'active')";
                                            //     $voted_query = $conn->query($voted_sql);
                                            //     $voted_row = $voted_query->fetch_assoc();
                                            //     echo "<div class='col-lg-3 col-xs-6'>";
                                            //     echo "<div class='small-box bg-blue'>";
                                            //     echo "<div class='inner'>";
                                            //     echo "<h3>" . $voted_row['num_voted'] . " voted</h3>";
                                            //     echo "<p>" . $count_row['course'] . "</p>";
                                            //     echo "</div>";
                                            //     echo "<div class='icon'>";
                                            //     echo "<i class='fa fa-black-tie'></i>";
                                            //     echo "</div>";
                                            //     echo "</div>";
                                            //     echo "</div>";
                                            // }
                                            ?>
                                        </div> -->
                                    </div>

                                    <!-- End Votes Tally Section -->
                                </div>
                            <?php
                            } else {
                                // Display the form for voting
                            ?>
                                <!-- Voting Ballot -->
                                <form method="POST" id="ballotForm" action="submit_ballot.php">
                                    <?php
                                    include 'includes/slugify.php';

                                    $candidate = '';
                                    $sql = "SELECT * FROM positions WHERE is_deleted = 0 ORDER BY priority ASC";
                                    $query = $conn->query($sql);
                                    while ($row = $query->fetch_assoc()) {
                                        $sql = "SELECT * FROM candidates WHERE position_id='" . $row['id'] . "' AND is_deleted = 0 ";
                                        $cquery = $conn->query($sql);
                                        while ($crow = $cquery->fetch_assoc()) {
                                            $slug = slugify($row['description']);
                                            $checked = '';
                                            if (isset($_SESSION['post'][$slug])) {
                                                $value = $_SESSION['post'][$slug];

                                                if (is_array($value)) {
                                                    foreach ($value as $val) {
                                                        if ($val == $crow['id']) {
                                                            $checked = 'checked';
                                                        }
                                                    }
                                                } else {
                                                    if ($value == $crow['id']) {
                                                        $checked = 'checked';
                                                    }
                                                }
                                            }
                                            $input = ($row['max_vote'] > 1) ? '<input type="checkbox" class="flat-red ' . $slug . '" name="' . $slug . "[]" . '" value="' . $crow['id'] . '" ' . $checked . '>' : '<input type="radio" class="flat-red ' . $slug . '" name="' . slugify($row['description']) . '" value="' . $crow['id'] . '" ' . $checked . '>';
                                            $image = (!empty($crow['photo'])) ? 'images/' . $crow['photo'] : 'images/profile.jpg';
                                            $candidate .= '
                                            <li>
                                                ' . $input . '<button type="button" class="btn btn-primary btn-sm btn-flat clist platform" data-platform="' . $crow['platform'] . '" data-fullname="' . $crow['firstname'] . ' ' . $crow['lastname'] . '"><i class="fa fa-search"></i> Platform</button><img src="' . $image . '" height="100px" width="100px" class="clist"><span class="cname clist">' . $crow['firstname'] . ' ' . $crow['lastname'] . '</span>
                                            </li>
                                        ';
                                        }

                                        $instruct = ($row['max_vote'] > 1) ? 'You may select up to ' . $row['max_vote'] . ' candidates' : 'Select only one candidate';

                                        echo '
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="box box-solid" id="' . $row['id'] . '">
                                                    <div class="box-header with-border">
                                                        <h3 class="box-title"><b>' . $row['description'] . '</b></h3>
                                                    </div>
                                                    <div class="box-body">
                                                        <p>' . $instruct . '
                                                            <span class="pull-right">
                                                                <button type="button" class="btn btn-success btn-sm btn-flat reset" data-desc="' . slugify($row['description']) . '"><i class="fa fa-refresh"></i> Reset</button>
                                                            </span>
                                                        </p>
                                                        <div id="candidate_list">
                                                            <ul>
                                                                ' . $candidate . '
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    ';

                                        $candidate = '';
                                    }

                                    ?>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-success btn-flat" id="preview"><i class="fa fa-file-text"></i> Preview</button>
                                        <button type="submit" class="btn btn-primary btn-flat" name="vote"><i class="fa fa-check-square-o"></i> Submit</button>
                                    </div>
                                </form>
                                <!-- End Voting Ballot -->
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <?php include 'includes/footer.php'; ?>
        <?php include 'includes/ballot_modal.php'; ?>
    </div>

    <?php include 'includes/scripts.php'; ?>
    <script>
        $(function() {
            $('.content').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });

            $(document).on('click', '.reset', function(e) {
                e.preventDefault();
                var desc = $(this).data('desc');
                $('.' + desc).iCheck('uncheck');
            });

            $(document).on('click', '.platform', function(e) {
                e.preventDefault();
                $('#platform').modal('show');
                var platform = $(this).data('platform');
                var fullname = $(this).data('fullname');
                $('.candidate').html(fullname);
                $('#plat_view').html(platform);
            });

            $('#preview').click(function(e) {
                e.preventDefault();
                var form = $('#ballotForm').serialize();
                if (form == '') {
                    $('.message').html('You must vote atleast one candidate');
                    $('#alert').show();
                } else {
                    $.ajax({
                        type: 'POST',
                        url: 'preview.php',
                        data: form,
                        dataType: 'json',
                        success: function(response) {
                            if (response.error) {
                                var errmsg = '';
                                var messages = response.message;
                                for (i in messages) {
                                    errmsg += messages[i];
                                }
                                $('.message').html(errmsg);
                                $('#alert').show();
                            } else {
                                $('#preview_modal').modal('show');
                                $('#preview_body').html(response.list);
                            }
                        }
                    });
                }

            });

        });
    </script>
</body>

</html>