
<div class="container home-block">	

<div id="googleMap" style="width:100%;height:400px;"></div>
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
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtjzDA7ZRoXnLumCn1FVvvMV_9urxWZd4&callback=myMap"></script>	 -->