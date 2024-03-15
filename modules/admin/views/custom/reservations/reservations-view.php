<?php

?>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <?php echo $form->open(); ?>
        <?php echo $form->messages(); ?>
        <div class="custom-title-bar">
            <div class="ftitle">Reservation # H00<?= $data[0]['id'] ?></div>
        </div>

        <div class="custom-box">
            <div class="col-md-12">
                <table class="table table-striped table-bordered bycolor-table">
                    <tbody>
                        <tr>
                            <td style="width: 50%"><strong>Badge Owner</strong></td>
                            <td><?= $data[0]['first_name'] ?> <?= $data[0]['last_name'] ?> (#<?= $data[0]['badge'] ?>)</td>
                        </tr>
                        <tr>
                            <td><strong>Lease</strong></td>
                            <td><?= $data[0]['leases_name'] ?></td>
                        </tr>
                        <tr>
                            <td><strong>Lease Area</strong></td>
                            <td><?= $data[0]['lease_areas_name'] ?></td>
                        </tr>
                        <tr>
                            <td><strong>Reservation Type</strong></td>
                            <td><?= $data[0]['reservation_types_name'] ?></td>
                        </tr>
                        <tr>
                            <td><strong>Date</strong></td>
                            <td>
                                <ul class="list-unstyled">
                                    <li>
                                        <strong>Start:
                                        </strong> <?= date('l, F j, Y', strtotime($data[0]["start_date"])) ?>
                                    </li>
                                    <li>
                                        <strong>End:
                                        </strong> <?= date('l, F j, Y', strtotime($data[0]["end_date"])) ?>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Status</strong></td>
                            <td>
                                <?php
                                if ($data[0]['reservation_status'] == 'active') {
                                    if ((strtotime($data[0]["end_date"] . " +1 days") <= strtotime(date('Y-m-d')))) {
                                        // echo 'completed';
                                        if ($data[0]['reservation_type_id'] != '38' && $data[0]['reservation_type_id'] != '39' && $data[0]['reservation_type_id'] != '40') {
                                            if ($data[0]['reservation_status'] == 'active') {
                                                if ($data[0]['harvest_report'] == 0) {
                                                    echo '<span>Pending Report</span>';
                                                } else {
                                                    echo '<span class="label label-primary">Completed</span>';
                                                }
                                            }
                                        } else { /// ADDED By biplab 22-9-22
                                            echo '<span class="label label-primary">Completed</span>';
                                        }
                                    } else {
                                        echo '<span>active</span>';
                                    }
                                } else if ($data[0]['reservation_status'] == 'cancel') echo '<span>Cancelled</span>';
                                else if ($data[0]['reservation_status'] == 'trash') echo '<span>Trashed</span>';
                                else echo  $data[0]['reservation_status'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Draw Hunt</strong></td>
                            <td><?= $data[0]['draw_hunt'] == 1 ? "Yes" : "NO" ?></td>
                        </tr>
                        <tr>
                            <td><strong>Booked On</strong></td>
                            <td> <?= date('l, F j, Y, h:i:sa', strtotime($data[0]["reservation_created_on"])) ?></td>
                        </tr>
                        <?php
                        if ($data[0]['reservation_status'] != 'active') {
                            echo ' <tr>
                        <td><strong>Cancelleed / Trashed On</strong></td>
                        <td>' . date('l, F j, Y, h:i:sa', strtotime($data[0]["reservation_cancelled_on"])) . '</td>
                    </tr>';
                        }
                        ?>
                        <tr>
                            <td><strong>Attending</strong></td>
                            <td>
                                <ul class="list-unstyled">
                                    <?php if ($data[0]['use_spot']) { ?>
                                        <li><i class="fa fa-check color-green"></i> <?= $data[0]['first_name'] ?> <?= $data[0]['last_name'] ?> (owner)</li>
                                    <?php } else { ?>
                                        <li><i class="fa fa-check color-green"></i> <?= $data[0]['first_name'] ?> <?= $data[0]['last_name'] ?> (Member Not Attending)</li>
                                    <?php } ?>
                                    <?php $users = array();
                                    $users = $controller->reservation_users($data[0]['id']); ?>
                                    <?php foreach ($users as $guest) { ?>
                                        <li><i class="fa fa-check color-green"></i> <?= $guest['name'] ?> </li>
                                    <?php } ?>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Harvest Report</strong></td>
                            <td>
                                <?php if ($data[0]['reservation_type_id'] != '38' && $data[0]['reservation_type_id'] != '39' && $data[0]['reservation_type_id'] != '40') { ?>
                                    <?php if ($data[0]['reservation_status'] == 'active') { ?>
                                        <?php if ($data[0]['harvest_report'] == 0) { ?> <a class="add" href="/admin/harvest-reports/add/<?= $data[0]['id'] ?>"><i class="fa fa-plus"></i> Add</a> <?php }
                                                                                                                                                                                                if ($data[0]['harvest_report'] == 1) { ?> <a class="view" href="/admin/harvest-reports/view/<?= $data[0]['id'] ?>"><i class="fa fa-search"></i> View</a><?php } ?>
                                    <?php } ?>
                                <?php } ?>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- REMOVE 24HRS BLOCK SECTION -->
        <?php if ($ishold && $isStartDateLessToday) {?>
        <div class="custom-title-bar mt-5">
            <div class="ftitle">Remove 24-hours hold for this reservation</div>
        </div>
        <div class="custom-box">
            <div class="col-md-12">
                <div class="col-md-10 pull-left">
                    <button type="submit" class="cust-btn submit" name="submit" value="1">Cancel without 24-hours hold</button>
                </div>
            </div>
        </div>
        <?php  } ?>
         <!-- REMOVE 24HRS BLOCK SECTION -->
        <?php echo $form->close(); ?>
    </div>
</div>
<div class="row mt-5">
    <a href="/admin/reservations/" data-toggle="tooltip" title="Back" class="btn btn-primary ml-5">
        < Back</a>
            <br />
</div>
<script type="text/javascript">
    $('#reservations_trash').submit(function() {
        if (confirm('Confirm to remove 24-hours hold')) {
            return true;
        }
        //window.location.href = "reservations";
        return false;
    });
</script>