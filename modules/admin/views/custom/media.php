<link rel="stylesheet" href="<?php echo BASE_URL?>assets/grocery_crud/css/jquery_plugins/fancybox/jquery.fancybox.css" />
<script src='<?php echo BASE_URL?>assets/grocery_crud/js/jquery_plugins/jquery.fancybox.js'></script>
<style>
.container {
  position: relative;
  width: 100%;
  overflow: hidden;
  padding-top: 56.25%; /* 16:9 Aspect Ratio */
}

.responsive-iframe {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  width: 100%;
  height: 100%;
  border: none;
}
</style>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">      
        <div class="container">
        <iframe class="responsive-iframe" src="../filemanager/dialog.php?type=0"></iframe>
</div>        
      
    </div>
    
</div>