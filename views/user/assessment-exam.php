
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

<div class="container home-block">

	<div class="profile">
		<div class="row">
			<div class="col-md-3 md-margin-bottom-40">  
                <?php $this->load->view('_partials/user_menu'); ?>
			</div>
            <div class="col-md-9">
                <div class="tag-box tag-box-v3">
                    <div class="headline"><h2>Assessment</h2></div>
                    <?php echo $form->open(); ?>
	                <?php echo $form->messages(); ?>

                    <?php $slNo=0; foreach ($questions as $question) {$slNo++?>                  
                        <fieldset id="<?= $question["id"] ?>" class="div_exam">
                                <section>
                                    <label class="label"><strong><?= $slNo ?>. <?= $question["question"] ?></strong></label>
                                    <div class="form-group">
                                        <label class="checkbox">
                                            <input type="radio" name="<?= $question["id"] ?>" class="icheck-input checkbox-input" value="1" style="position: absolute; opacity: 0;" />
                                            <?= $question["option1"] ?>
                                        </label>
                                        <label class="checkbox">
                                            <input type="radio" name="<?= $question["id"] ?>" class="icheck-input checkbox-input" value="2" style="position: absolute; opacity: 0;" />
                                            <?= $question["option2"] ?>
                                        </label>
                                        <label class="checkbox">
                                            <input type="radio" name="<?= $question["id"] ?>" class="icheck-input checkbox-input" value="3" style="position: absolute; opacity: 0;" />
                                            <?= $question["option3"] ?>
                                        </label>
                                        <label class="checkbox">
                                            <input type="radio" name="<?= $question["id"] ?>" class="icheck-input checkbox-input" value="4" style="position: absolute; opacity: 0;" />
                                            <?= $question["option4"] ?>
                                        </label>
                                    </div>
                                </section>
                        </fieldset>                  
                    <?php }?>
                        <footer>
                            <button class="btn-u pull-right submit" type="button">Submit</button>                           
                         </footer>
                         <input type="hidden" id="hd_assessment" name="hd_assessment" value="">
                <?php echo $form->close(); ?>
                </div>
                
                <script type="text/javascript">
                    $(function () {
                        $("input:radio").iCheck({//iradio_minimal-green
                            radioClass: "iradio_square-green",
                            inheritClass: true,
                        });
                    });
                    
             $('.submit').click(function(){
					//alert('HI');
                    getAssessment();
					$("#sky-form3").trigger('submit');
				});
                    //GET Reservation Types DETAILS START
        function getAssessment() {
            var data = [];
            $('input[type=radio]:checked').each(function () {            
                var quistionId = $(this).attr("name");
				//alert(quistionId);
                var answer = $(this).val();
                //alert(answer);        
                var alldata = {
                'quistionId' : quistionId,
                'answer' : answer               
                };
                data.push(alldata);
            });
            $("#hd_assessment").val(JSON.stringify(data));
            //alert(JSON.stringify(data));
        };
        //GET Reservation Types DETAILS END
                </script>
                
            </div>