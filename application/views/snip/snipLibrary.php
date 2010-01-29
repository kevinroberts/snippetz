<script type="text/javascript" charset="utf-8">
	jQuery(function($) {
		$(".steps > li:first-child").addClass("first");
		$(".steps > li:last-child").addClass("last");
	});
</script>
<div id="col3">
      <div id="col3_content" class="clearfix">
		<h1 class="library">Snippetz Library</h1>
		<?php echo $this->pagination->render() ?>
		<div class="container">
		<?php echo $items?>
		</div>
		<?php echo $this->pagination->render() ?>
    </div>
      <!-- IE Column Clearing -->
      <div id="ie_clearing"> &#160; </div>
 </div>

