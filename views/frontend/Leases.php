<div class="container home-block">	

	<div class="row">
	
		<div class="col-md-8">
		
				<div class="headline"><h2>Our Locations</h2></div>
				<?php foreach ($leases as $lease): ?>
					<?php 
						$name=$lease['name'];
						$lease_id=$lease['id'];
						$location_description=$lease['location_description'];
						$count_leases = $controller->count_lease_areas($lease_id);
						//print_r($count_leases);
					?>
				<div class="row clients-page">
					<div class="col-md-12">
						<h3><?php if(isset($name) && $name!="") echo stripslashes($name);?></h3>
						<ul class="list-inline">
							<li><i class="fa fa-check color-green"></i> <?php if(isset($count_leases) && $count_leases!="") echo stripslashes($count_leases);?> Lease Areas</li>
						</ul>
						<?php if(isset($location_description) && $location_description!="") echo stripslashes($location_description);?>
                   <a class="btn-u btn-u-sm" href="/leases/view/<?php if(isset($lease_id) && $lease_id!="") echo stripslashes($lease_id);?>">View More</a>
					</div>
				</div>
				<?php endforeach;?>	
		</div>
	
		<div class="col-md-4">
				<div class="headline"><h2>Map</h2></div>
				<div id="googleMap" style="width:100%;height:350px;"></div>					
		</div>
	</div>
	<script>
		function LeasesMap() {
    var mapProp= {
      center:new google.maps.LatLng(36.084621,-96.921387),
      zoom:6,
    };
    var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
	<?php foreach ($leases as $lease): ?>
	var myLatLng = new google.maps.LatLng(<?= $lease['latitude']; ?>, <?= $lease['longitude']; ?>);
		var myMarkerOptions = {
		position: myLatLng,
		map: map,
		title: '<?= $lease['name']; ?>'
		}
	var myMarker = new google.maps.Marker(myMarkerOptions);
	<?php endforeach;?>	
    }
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJDRg3eIoFF01OXLowbSwtFVz2nYUAxOQ&callback=LeasesMap"></script>
</div>