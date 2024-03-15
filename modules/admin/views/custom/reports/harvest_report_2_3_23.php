<script src="https://envato.stammtec.de/themeforest/melon/plugins/flot/jquery.flot.min.js"></script>
<script src="https://envato.stammtec.de/themeforest/melon/plugins/flot/jquery.flot.pie.min.js"></script>
<script src="https://envato.stammtec.de/themeforest/melon/plugins/flot/jquery.flot.tooltip.min.js"></script>

<link rel="stylesheet" href="<?php echo BASE_URL?>assets/daterangepicker/daterangepicker.css" />
<script src='<?php echo BASE_URL?>assets/daterangepicker/moment.min.js'></script>
<script src='<?php echo BASE_URL?>assets/daterangepicker/daterangepicker.js'></script>
<?php
$colorList  = ['#e6bb3c','#D7ECFC','#E5A5A5','#A6D3A6','#CAA0F6','#DECD99','#8adce6','#D19E9E','#AA8484','#044511','#200326','#4F7AFB','#BF55E6','#E655C2','#E65555'];
$colorCount = 0;
//    $colorArray= array();
// 	 $colorArray['Bobcat']='#e6bb3c';
// 	 $colorArray['Buck']='#D7ECFC';
// 	 $colorArray['Coyote']='#E5A5A5';
// 	 $colorArray['Doe']='#A6D3A6';
// 	 $colorArray['Hog']='#CAA0F6';
// 	 $colorArray['Duck']='#DECD99';
// 	 $colorArray['Goose']='#8adce6';
// 	 $colorArray['Quail']='#D19E9E';
// 	 $colorArray['Pheasant']='#044511';
// 	 $colorArray['Turkey']='#200326';
// 	 $colorArray['Small Game']='#200326';
	 
	// print_r($revIds);
	// echo '<pre>';
	// print_r($gameData);
	if(!isset($lease)&& $lease=="")
    {
        $lease_list="all";
    }
	else
	{
		$lease_list=$lease;
	}
	if(!isset($leaseArea)&& $leaseArea=="")
    {
        $leaseArea="all";
    }	

	if(!isset($gametype)&& $gametype=="")
    {
        $gametype="all";
    }	

	$startDate_uri= isset($startDate)&& $startDate!=""?"&amp;startDate=".$startDate:"";
	$endDate_uri=isset($endDate)&& $endDate!=""?"&amp;endDate=".$endDate:"";
	$lease_uri=isset($lease)&& $lease!=""?"&amp;lease=".$lease:"";
	$lease_area_uri=isset($leaseArea)&& $leaseArea!=""?"&amp;leaseArea=".$leaseArea:"";
	$gametype_uri=isset($gametype)&& $gametype!=""?"&amp;gametype=".$gametype:"";
	 
?>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">

		<div class="box box-primary">

			<div class="row p-4 mb-3 mt-4">

				<div class="col-sm-4 mb-3">
					<div id="reportrange"
						style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
						<i class="fa fa-calendar"></i>&nbsp;<span></span> <i class="fa fa-caret-down"></i>
					</div>
				</div>

				<div class="col-sm-8">
					<div class="btn-group">
						<button type="button" class="btn btn-md btn-default dropdown-toggle text-capitalize"
							data-toggle="dropdown">
							<i class="fa fa-home"></i>&nbsp;Lease: <span id="lease"></span>&nbsp;<span
								class="caret"></span>
						</button>
						<ul class="dropdown-menu text-capitalize">
							<li><a class="lease"
									href="/admin/reports/harvest?lease=all<?=$lease_area_uri .$gametype_uri. $startDate_uri . $endDate_uri?>">All</a>
							</li>
							<?php $leases=array(); $leases = $controller->leaselist(); ?>
							<?php  foreach ($leases as $lease) { ?>
							<li> <a class="lease"
									href="/admin/reports/harvest?lease=<?=$lease['id']?><?=$lease_area_uri .$gametype_uri. $startDate_uri . $endDate_uri?>"><?=$lease['name']?>
								</a></li>
							<?php } ?>
						</ul>
					</div>


					<div class="btn-group">
						<button type="button" class="btn btn-md btn-default dropdown-toggle text-capitalize"
							data-toggle="dropdown">
							</i>&nbsp;Lease Areas: <span id="lease_area">&nbsp;<span class="caret"></span>
						</button>
						<ul class="dropdown-menu text-capitalize">
							<li><a class="lease_area"
									href="/admin/reports/harvest?leaseArea=all<?=$lease_uri .$gametype_uri. $startDate_uri . $endDate_uri?>">All</a>
							</li>
							<?php $leases=array(); $leases = $controller->leaseArealist(); ?>
							<?php  foreach ($leases as $lease) { ?>
							<li> <a class="lease_area"
									href="/admin/reports/harvest?leaseArea=<?=$lease['id']?><?=$lease_uri .$gametype_uri. $startDate_uri . $endDate_uri?>"><?=$lease['lname']?>&nbsp;
									&nbsp; &nbsp;<?=$lease['aname']?> </a></li>
							<?php } ?>
						</ul>
					</div>

					<div class="btn-group">
						<button type="button" class="btn btn-md btn-default dropdown-toggle text-capitalize"
							data-toggle="dropdown">
							<i class="fa fa-fire"></i>&nbsp;Game Type: <span id="game_type">&nbsp;<span
									class="caret"></span>
						</button>
						<ul class="dropdown-menu text-capitalize">
							<li><a class="game_type"
									href="/admin/reports/harvest?gametype=all<?=$lease_uri . $lease_area_uri . $startDate_uri . $endDate_uri?>">All</a>
							</li>
							<?php $games=array(); $games = $controller->gamelist(); ?>
							<?php  foreach ($games as $game) { ?>
							<li> <a class="game_type"
									href="/admin/reports/harvest?gametype=<?=$game['id']?><?=$lease_uri . $lease_area_uri . $startDate_uri . $endDate_uri?>"><?=$game['name']?></a>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>

			</div>



			<div class="col-md-6 mb-5">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="custom-title-bar">
							<div class="ftitle"><i class="fa fa-bar-chart-o"></i> Harvest Totals</div>
						</div>
						<div class="custom-box">
							<div id="placeholder" style="width:500px;height:400px;"></div>
						</div>
					</div>
				</div>
			</div>


			<div class="col-md-6 mb-5">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="custom-title-bar">
							<div class="ftitle"><i class="fa fa-bar-chart-o"></i> Raw Harvest Totals</div>
						</div>

						<div class="custom-box">
							<div class="col-md-12">
								<table class="table monocolor-table">
									<tbody>
										<?php foreach($gameData as $game) {?>
										<tr>
											<td><?=$game['gameName']?></td>
											<td><?=$game['total']?></td>
										</tr>
										<?php } ?>

									</tbody>
								</table>
							</div>
						</div> <!-- /.portlet-content -->
					</div>
				</div>
			</div>

			<div class="col-md-12">

				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 pb-5">
						<div class="custom-title-bar">
							<div class="ftitle"><i class="fa fa-bar-chart-o"></i> Lease Areas</div>
						</div>

						<div class="custom-box">
							<div class="col-md-12">
								<table class="table bycolor-table harvest-outer-table">
									<tbody>

										<?php  
					$game_id=isset($gametype)&& $gametype!=""?$gametype:"";
					foreach($leaseData as $lease):
					
					$gameData_other=$controller->finalData($lease['revid'], $game_id);
					 if(count($gameData_other)==0) continue;
			       
					  ?>

										<tr>
											<td><?=$lease['lname']?> - <?=$lease['aname']  ?></td>
											<td>
												<table class="table bycolor-table table-bordered table-condensed"
													width="50%">
													<tbody>
														<?php foreach($gameData_other as $other): ?>
														<tr>
															<td style="width: 30%"><?=$other['gameName']?></td>
															<td><?=$other['total']?></td>
														</tr>
														<?php endforeach?>

													</tbody>
												</table>
											</td>
										</tr>
										<?php  endforeach; ?>


									</tbody>
								</table>
							</div>
						</div> <!-- /.portlet-content -->
					</div>
				</div>
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
	datapie = [ <?php foreach($gameData as $game) {
			?> {
				label: "<?=$game['gameName']?>",
				data: <?= $game['total'] * 100 / $total ?> ,
				color: '<?=$colorList[$colorCount]?>' <?php
				$colorCount++;
				if ($colorCount > 14) $colorCount = 0; ?>
			}, <?php } ?>
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
			label + ' </div>';
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
	$(function () {
		//  var start = moment().startOf('month');
		// var end = moment().endOf('month');
		var start = new Date("<?php echo $startDate; ?>");
		var end = new Date("<?php echo $endDate; ?>");

		function cb(start, end) {
			$('#reportrange span').html(moment(start).format('MMMM D, YYYY') + ' - ' + moment(end).format(
				'MMMM D, YYYY'));
		}
		$('#reportrange').daterangepicker({
				//format: 'YYYY-MM-DD',
				startDate: start,
				endDate: end,
				ranges: {
					'Today': [moment(), moment()],
					'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
					'Last 7 Days': [moment().subtract('days', 6), moment()],
					'This Month': [moment().startOf('month'), moment().endOf('month')],
					'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month',
						1).endOf('month')]
				}
			},
			function (start, end) {
				$('#reportrange span').html(moment(start).format('MMMM D, YYYY') + ' - ' + moment(end).format(
					'MMMM D, YYYY'));
				var baseUrl = '/admin/reports/harvest';
				var queryParameters = {},
					queryString = location.search.substring(1),
					re = /([^&=]+)=([^&]*)/g,
					m;
				while (m = re.exec(queryString)) {
					queryParameters[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
				}
				queryParameters['startDate'] = start.format('YYYY-MM-DD');
				queryParameters['endDate'] = end.format('YYYY-MM-DD');
				var newUrl = baseUrl + '?' + $.param(queryParameters);
				window.location.href = newUrl;
			}, cb);
		cb(start, end);

		$('.lease').click(function () {
			var value = $(this).text();
			//alert(value);  
			Cookies.set('lease', '' + value + '') //set the cookie value  
		});
		var leaseValue = Cookies.get('lease') //get the value from cookie  
		if (typeof leaseValue !== 'undefined') {
			$('#lease').text(leaseValue);
		}
		var leaseAll = "<?php echo $lease_list ?>";
		if (leaseAll == "all") {
			$('#lease').text("All");
		}


		$('.lease_area').click(function () {
			var value = $(this).text();
			//alert(value);  
			Cookies.set('lease_area', '' + value + '') //set the cookie value  
		});
		var lease_areaValue = Cookies.get('lease_area') //get the value from cookie  
		if (typeof lease_areaValue !== 'undefined') {
			$('#lease_area').text(lease_areaValue);
		}
		var lease_areaAll = "<?php echo $leaseArea ?>";
		if (lease_areaAll == "all") {
			$('#lease_area').text("All");
		}


		$('.game_type').click(function () {
			var value = $(this).text();
			//alert(value);  
			Cookies.set('game_type', '' + value + '') //set the cookie value  
		});
		var game_typeValue = Cookies.get('game_type') //get the value from cookie  
		if (typeof game_typeValue !== 'undefined') {
			$('#game_type').text(game_typeValue);
		}
		var game_typeAll = "<?php echo $gametype ?>";
		if (game_typeAll == "all") {
			$('#game_type').text("All");
		}
	});
</script>