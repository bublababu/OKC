<script
    src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.3/icheck.min.js"
    integrity="sha512-RGDpUuNPNGV62jwbX1n/jNVUuK/z/GRbasvukyOim4R8gUEXSAjB4o0gBplhpO8Mv9rr7HNtGzV508Q1LBGsfA=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
></script>
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.3/skins/all.min.css"
    integrity="sha512-wcKDxok85zB8F9HzgUwzzzPKJhHG7qMfC7bSKrZcFTC2wZXVhmgKNXYuid02cHVnFSC8KOJCXQ8M83UVA7v5Bw=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
/>
<?php
$lodge_id = isset($lodge_id) && $lodge_id != "" ? $lodge_id : "";
$lodge_name = isset($lodge_data[0]["name"]) && $lodge_data[0]["name"] != "" ? $lodge_data[0]["name"] : "";

$start_date = isset($start_date) && $start_date != "" ? $start_date : "";
$add_days = isset($add_days) && $add_days != "" ? $add_days : "";
?>
<div class="container home-block">
    <div class="row tab-v3">
        <div class="col-md-3 md-margin-bottom-40">
            <ul class="nav nav-pills nav-stacked">
                <li class="">
                    <a href="/reservations/activity"><i class="fa fa-location-arrow"></i> 1. Location</a>
                </li>
                <li class="disabled">
                    <a href="#"><i class="fa fa-calendar"></i> 2. Available Dates</a>
                </li>
                <li class="active">
                    <a href="#"><i class="fa fa-book"></i> 3. Book</a>
                </li>
            </ul>
        </div>
        <div class="col-md-9">
            <div class="tag-box tag-box-v3">
                <div class="headline"><h2>Book</h2></div>
                <div class="row">
                    <div class="col-md-12">
                        <h5>Please select an location from the list below.</h5>
                        <ul class="list-unstyled">
                            <li>
                                <i class="fa fa-check color-green"></i> <strong>Location:</strong>
                                <?= $lodge_name ?>
                            </li>
                            <li>
                                <i class="fa fa-check color-green"></i> <strong>Start Date:</strong>
                                <?= date('l, F j, Y',strtotime($start_date))  ?>
                            </li>
                            <li>
                                <i class="fa fa-check color-green"></i> <strong>Length:</strong>
                                <?= $add_days ?>
                                Days
                            </li>
                        </ul>
                        <hr class="devider devider-db" />
                        <!-- <form action="/lodge-reservations/book/1/2022-01-06/5" method="post" name="lodge-reservation-beds" autocomplete="off" class="sky-form" id="sky-form3"> -->
                        <?php echo $form->open(); ?>
                        <?php echo $form->messages(); ?>
                        <fieldset>
                            <section>
                                <label class="label"><strong>Select up to 2 of the available beds below.</strong></label>
                                <div class="form-group">
                                <?php foreach($bedId as $bed) :?>
                                 <?php $bedRoom=$controller->bedroom($bed,0);?>
                                    <label class="checkbox">
                                        <input type="checkbox" name="beds[]" class="icheck-input checkbox-input" value="<?=$bed?>" style="position: absolute; opacity: 0;" />
                                        <?=$bedRoom[0]['lodgename']?> , <?=$bedRoom[0]['name']?>
                                    </label>
                                    <?php endforeach ?>                                   
                                </div>
                            </section>
                        </fieldset>
                        <footer>
                        <?php if($iseligible){ ?>
                               <button class="btn-u" type="submit">Book It</button>
                               <?php } else { ?>
                                <h3 class="text-danger">This reservation cannot be completed. If you believe this to be in error, please contact an administrator.</h3>
                                <?php } ?>
                        </footer>
                        <input type="hidden" name="user_id" value="<?= $user_id ?>">
				            <input type="hidden" name="lodge_id" value="<?= $lodge_id ?>">
				            <input type="hidden" name="startDate" value="<?= $start_date ?>">
				            <input type="hidden" name="end_date" value="<?= $end_date ?>">
                        <!-- </form> -->
                        <?php echo $form->close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $("input:checkbox").iCheck({
                checkboxClass: "icheckbox_minimal-green",
                inheritClass: true,
            });
            // $("input.checkbox-input").on("ifToggled", function (e) {
            //     if ($("input.checkbox-input").filter(":checked").length >= 2) {
            //         $("input.checkbox-input").not(":checked").iCheck("disable");
            //     } else {
            //         $("input.checkbox-input").not(":checked").iCheck("enable");
            //     }
            // });
        });
    </script>
</div>
