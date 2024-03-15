<script src="https://envato.stammtec.de/themeforest/melon/plugins/flot/jquery.flot.min.js"></script>
<script src="https://envato.stammtec.de/themeforest/melon/plugins/flot/jquery.flot.pie.min.js"></script>
<script src="https://envato.stammtec.de/themeforest/melon/plugins/flot/jquery.flot.tooltip.min.js"></script>

<link rel="stylesheet" href="<?php echo BASE_URL?>assets/daterangepicker/daterangepicker.css" />
<script src='<?php echo BASE_URL?>assets/daterangepicker/moment.min.js'></script>
<script src='<?php echo BASE_URL?>assets/daterangepicker/daterangepicker.js'></script>
<?php
   $colorArray= array();
	 $colorArray['Bobcat']='#e6bb3c';
	 $colorArray['Buck']='#D7ECFC';
	 $colorArray['Coyote']='#E5A5A5';
	 $colorArray['Doe']='#A6D3A6';
	 $colorArray['Hog']='#CAA0F6';
	 $colorArray['Duck']='#DECD99';
	 $colorArray['Goose']='#8adce6';
	 $colorArray['Quail']='#D19E9E';
	 $colorArray['Pheasant']='#044511';
	 $colorArray['Turkey']='#200326';
	 
	 
	// print_r($revIds);
	// echo '<pre>';
	// print_r($gameData);
	 
?>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
   
        <div class="box box-primary">
            
            <div class="row p-3">

									<div class="col-sm-4">
										 <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
				 <i class="fa fa-calendar"></i>&nbsp;<span></span> <i class="fa fa-caret-down"></i>
										 </div>
								</div>
						 
						   <div class="btn-group">
                    <button type="button" class="btn btn-md btn-default dropdown-toggle text-capitalize" data-toggle="dropdown">
                        <i class="fa fa-home"></i>&nbsp;Lease: All&nbsp;<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu text-capitalize">
                        <li><a href="/admin/reports/harvest">All</a></li>
                         <?php $leases=array(); $leases = $controller->leaselist(); ?>
                            <?php  foreach ($leases as $lease) { ?>
                             <li> <a href="/admin/reports/harvest"><?=$lease['name']?> </a></li>
                        <?php } ?>
                    </ul>
                   </div> 
						 
						 
						   <div class="btn-group">
								<button type="button" class="btn btn-md btn-default dropdown-toggle text-capitalize" data-toggle="dropdown">
										<i class="fa fa-home"></i>&nbsp;Lease Areas: All&nbsp;<span class="caret"></span>
								</button>
								<ul class="dropdown-menu text-capitalize">
										<li><a href="/admin/reports/harvest">All</a></li>
										 <?php $leases=array(); $leases = $controller->leaseArealist(); ?>
												<?php  foreach ($leases as $lease) { ?>
												 <li> <a href="/admin/reports/harvest"><?=$lease['lname']?>&nbsp; &nbsp; &nbsp;<?=$lease['aname']?> </a></li>
										<?php } ?>
								</ul>
							 </div>
							 
							   <div class="btn-group">
								<button type="button" class="btn btn-md btn-default dropdown-toggle text-capitalize" data-toggle="dropdown">
										<i class="fa fa-home"></i>&nbsp;Game Type: All&nbsp;<span class="caret"></span>
								</button>
								<ul class="dropdown-menu text-capitalize">
										<li><a href="/admin/reports/harvest">All</a></li>
										 <?php $games=array(); $games = $controller->gamelist(); ?>
												<?php  foreach ($games as $game) { ?>
												 <li> <a href="/admin/reports/harvest"><?=$game['name']?></a></li>
										<?php } ?>
								</ul>
							 </div> 
							 
							 
        </div>
           
        </div>
				
				<div class="col-md-6">
        <div class="portlet">
            <div class="portlet-header">
                <h3><i class="fa fa-bar-chart-o"></i>Harvest Totals</h3>
								<div id="placeholder" style="width:500px;height:400px;"></div>
						</div>
				</div>		
				</div>
				
				
				<div class="col-md-6">
        <div class="portlet">

            <div class="portlet-header">

                <h3>
                    <i class="fa fa-bar-chart-o"></i>
                    Raw Harvest Totals
                </h3>

            </div> <!-- /.portlet-header -->

            <div class="portlet-content">

                <table class="table">
                  <tbody>
                <?php foreach($gameData as $game) {?>
                  <tr>
                        <td><?=$game['gameName']?></td>
                        <td><?=$game['total']?></td>
                    </tr>
                <?php } ?>      

               </tbody></table>

            </div> <!-- /.portlet-content -->

        </div>
    </div>
				
				
				
				<div class="col-md-12">
        <div class="portlet">

            <div class="portlet-header">

                <h3>
                    <i class="fa fa-bar-chart-o"></i>
                    Lease Areas
                </h3>

            </div> <!-- /.portlet-header -->

            <div class="portlet-content">

                <table class="table">
                                    <tbody><tr>
                        <td>Velma - Area 2</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>1</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Velma - Area 1</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>1</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>3</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Duncan - A6</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>1</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>1</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Sooner - A1</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Velma - Area 4</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Moore - A1</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>2</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>5</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>5</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Duncan - A2</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Duck</td>
                                        <td>12</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Goose</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Duncan - All Areas</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Duck</td>
                                        <td>20</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Goose</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Quail</td>
                                        <td>4</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Sooner - All Areas</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Quail</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Jet - G.H. Pond</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>1</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>D.O.K. - A3E</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>4</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>2</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Roark - All Areas</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Duck</td>
                                        <td>8</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Goose</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Moore - All Areas</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Duck</td>
                                        <td>13</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Goose</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Wagnon - New A3</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Sooner - A3</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Duncan - A3b</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>1</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>2</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Sooner - A8</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>1</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>2</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Duncan - A3a</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>2</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>1</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Harmon - A4</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>1</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>2</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>D.O.K. - A2</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>3</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Roark - A2</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>4</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>2</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Sooner - A5</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>1</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>1</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Moore - A3</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>1</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>1</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>1</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Duncan - A7</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>1</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>1</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Roark - A1</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>2</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>5</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Harmon - A3</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Duncan - A4</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>2</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>1</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Wagnon - New A4</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>2</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>1</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>D.O.K. - A1</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>1</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>4</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Duncan - A8</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>1</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>1</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Duncan - A10</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>1</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Wagnon - A2</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>2</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Sooner - A2</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Jet - 9 Ac</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>2</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Harmon - A1</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>1</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>3</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>D. Howard - D. Howard</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>J. Howard - J. Howard</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>1</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Jet - G.H. No.</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>2</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>1</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>2</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Jet - G.H. So.</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>4</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Jet - Barn</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Wagnon - A1</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>3</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Jet - Cochran - A1</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Pheasant</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>1</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Turkey</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Sooner - A7</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>2</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Wagnon - New A2</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>1</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>1</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>1</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>D.O.K. - A1A</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Sooner - A4</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Wagnon - New A1</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Duncan - A1</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Harmon - A2</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>1</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>D.O.K. - A3W</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>2</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>D.O.K. - A4</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Jet - Cochran - A3</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>1</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Jet - Cochran - All Areas</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Duck</td>
                                        <td>3</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Goose</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Harmon - All Areas</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Quail</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Wagnon - Ellis All Areas</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Quail</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                    <tr>
                        <td>Velma - Area 3</td>
                        <td>
                            <table class="table table-bordered table-condensed" width="50%">
                                <tbody>
                                                                    <tr>
                                        <td style="width: 30%">Bobcat</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Buck</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Coyote</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Doe</td>
                                        <td>0</td>
                                    </tr>
                                                                    <tr>
                                        <td style="width: 30%">Hog</td>
                                        <td>0</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </td>
                    </tr>
                                </tbody></table>

            </div> <!-- /.portlet-content -->

        </div>
    </div>
				
				
				
      
    </div>
</div>
<style>
	#flotTip {
    padding: 3px 5px;
    background-color: #000;
    z-index: 100;
    color: #fff;
    opacity: .80;
    filter: alpha(opacity=85);
}
</style>
<script type="application/x-javascript">
    datapie = [
<?php foreach($gameData as $game) { ?>
   {
    label: "<?=$game['gameName']?>",
    data: <?=$game['total']*100/$total?>,
    color: '<?=$colorArray[$game['gameName']]?>'
  },
<?php } ?>
//datapie = [{
//    label: "Running1",
//    data: 19.5,
//    color: '#e1ab0b'
//  },
//  {
//    label: "Stopped",
//    data: 4.5,
//    color: '#fe0000'
//  },
//  {
//    label: "Terminated",
//    data: 36.6,
//    color: '#93b40f'
//  }
];

function legendFormatter(label, series) {
  return '<div ' +
    'style="font-size:8pt;text-align:center;padding:2px;">' +
    label + ' ' + Math.round(series.percent) + '%</div>';
};

$.plot($("#placeholder"), datapie, {

  series: {
    pie: {
      show: true,
      threshold: 0.1
      // label: {show: true}
    }
  },
  grid: {
    hoverable: true
  },
  tooltip: true,
  tooltipOpts: {
    cssClass: "flotTip",
    content: "%p.0%, %s",
    shifts: {
      x: 20,
      y: 0
    },
    defaultTheme: false
  },


  legend: {
    show: true,
    labelFormatter: legendFormatter
  }

});
</script>

    <script type="text/javascript">
$(function() {
  //  var start = moment().startOf('month');
   // var end = moment().endOf('month');
    var start = new Date("<?php echo $startDate; ?>");
    var end = new Date("<?php echo $endDate; ?>");   
    function cb(start, end) {
        $('#reportrange span').html(moment(start).format('MMMM D, YYYY') + ' - ' + moment(end).format('MMMM D, YYYY'));
    }
    $('#reportrange').daterangepicker(
        {
            //format: 'YYYY-MM-DD',
            startDate: start,
            endDate: end,
          ranges: {
             'Today': [moment(), moment()],
             'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
             'Last 7 Days': [moment().subtract('days', 6), moment()],
             'This Month': [moment().startOf('month'), moment().endOf('month')],
             'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
          }          
        },
        function(start, end) {
            $('#reportrange span').html(moment(start).format('MMMM D, YYYY') + ' - ' + moment(end).format('MMMM D, YYYY'));
            var baseUrl = '/admin/reports/harvest';
            var queryParameters = {}, queryString = location.search.substring(1), re = /([^&=]+)=([^&]*)/g, m;
            while (m = re.exec(queryString)) {
                queryParameters[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
            }
            queryParameters['startDate'] = start.format('YYYY-MM-DD');
            queryParameters['endDate'] = end.format('YYYY-MM-DD');
            var newUrl = baseUrl + '?' + $.param(queryParameters);
            window.location.href = newUrl;
        },cb);  
    cb(start, end);
});
</script>

