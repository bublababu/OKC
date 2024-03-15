<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <?php echo $form->open(); ?>
        <?php echo $form->messages(); ?>
        <div class="custom-title-bar">
            <div class="ftitle">Reservation Information</div>
        </div>
        <div class="custom-box">
            <div class="form-field-box">
            <div class="m-3"> Are you sure that you want to cancel the reservation for <strong>'<?=$data[0]['first_name']?> <?=$data[0]['last_name']?>'</strong> for the lease <strong>'<?=$data[0]['leases_name']?> - <?=$data[0]['lease_areas_name']?>'</strong> 
            for the dates <strong><?=$data[0]['start_date']?> - <?=$data[0]['end_date']?>'</strong>?</div>
            </div>

            <div class="form-field-box button-container">
                <div class="col-md-10 pull-left">
                    <button type="submit" class="cust-btn submit" name="submit" value="1">Cancel with 24-hour hold</button>
                    <button type="submit" class="cust-btn submit" name="submit" value="2">Cancel without hold</button>
                    <!-- <button type="submit" class="cust-btn cancel" name="submit" value="0">Cancel</button> -->
                </div>
            </div>

        </div>
        <?php echo $form->close(); ?>
    </div>
</div>
<script type="text/javascript">
$('#reservations_cancel').submit(function() {
    if(confirm('Do you really want to Confirm Cancellation?')) {
        return true;
    }
    window.location.href = "reservations";
    return false;
});
</script>