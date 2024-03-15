
	<?php
		foreach ($scripts['foot'] as $file)
		{
			$url = starts_with($file, 'http') ? $file : base_url($file);
			echo "<script src='$url'></script>".PHP_EOL;
		}
	?>

	<?php // Google Analytics ?>
	<?php $this->load->view('_partials/ga') ?>
<!-- <script type="text/javascript">
   $('a').each(function(){
		var oldUrl = $(this).attr("href"); // Get current url
     	var newUrl = oldUrl.replace(/_/g, '-'); // Create new url
  		$(this).attr("href", newUrl);
	});
</script> -->
</body>
</html>