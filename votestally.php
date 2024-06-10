<!-- Votes Tally Section -->
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
$sql = "SELECT * FROM positions ORDER BY priority ASC";
$query = $conn->query($sql);
while ($row = $query->fetch_assoc()) {
    $position_id = $row['id'];
    $position_description = $row['description'];

    // Fetch candidates for this position
    $candidates_sql = "SELECT * FROM candidates WHERE position_id = '$position_id'";
    $candidates_query = $conn->query($candidates_sql);

    echo "
    <div class='row'>
        <div class='col-sm-6'>
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
        $votes_sql = "SELECT COUNT(*) AS num_votes FROM votes WHERE candidate_id = '$candidate_id'";
        $votes_query = $conn->query($votes_sql);
        $votes_row = $votes_query->fetch_assoc();
        $num_votes = $votes_row['num_votes'];

        echo "
        <li class='list-group-item'>$num_votes</li>";
    }

    echo "
                </ul>
            </div>
        </div>
    </div>
</div>";
}
?>
<!-- End Votes Tally Section -->