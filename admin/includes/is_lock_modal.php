<div class="modal fade" id="is_lock">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?php
                $parse = parse_ini_file('config.ini', FALSE, INI_SCANNER_RAW);
                $title = $parse['election_title'];
                ?>
                <h4 class="modal-title"> <label for="lockStatus">Lock Votes: <?php echo $title; ?></label></h4>
            </div>
            <div class="modal-body">
                <?php
                // Fetch the is_lock value from the votes table
                $is_lock_query = $conn->query("SELECT is_lock FROM votes");
                $is_lock_row = $is_lock_query->fetch_assoc();
                $is_lock = $is_lock_row['is_lock'];

                // Determine the button text based on the is_lock value
                $button_text = ($is_lock == 1) ? "Unlock Voting" : "Lock Voting";
                $button_class = ($is_lock == 1) ? "btn-success" : "btn-primary";
                ?>
                <form id="lockForm" method="POST" action="update_lock_status.php">
                    <div class="form-group">
                        <div class="radio">
                        <?php if ($is_lock == 0): ?>
                            <label><input type="radio" name="lockStatus" value="1"> Yes</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="lockStatus" value="0" > No</label>
                        </div>
                        <?php endif; ?>
                        <?php if ($is_lock == 1): ?>
                            <label><input type="radio" name="lockStatus" value="0"> Yes</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="lockStatus" value="1" > No</label>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                        <button type="submit" class="btn btn-success btn-flat" name="saveLock"><i class="fa fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
