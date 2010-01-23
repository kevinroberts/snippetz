<?php
// Show update message if user was directed from user_settings
if (isset($_GET['pass'])): 
?>
<script type="text/javascript">
$(function() {
	$("#dialog").dialog({
		bgiframe: true,
		modal: true,
		height: 250,
		width: 350,
		buttons: {
			Ok: function() {
				$(this).dialog('close');
			}
		}
	});
});
</script>
<div id="dialog" title="Account Updated" style="display:none;">
	<p>
		<span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
		Your account information has been successfully updated.
	</p>
</div>
<?php endif; ?>
<div id="col3">
      <div id="col3_content" class="clearfix">
<h1>Welcome to Snippetz!</h1>
<p>I wrote this simple web application after being frustrated by the lack of tools available to store simple snippets of code I often need to reuse on various web projects. I have looked at pastebin and snipplr.com but neither seem to offer what I needed. This was also a chance for me to try out the PHP framework <a target="_blank" href="http://kohanaphp.com">Kohana</a> and the <abbr title="Model View Controller">MVC</abbr> design pattern. To get started using Snippetz you need to first register for an account.</p>
    </div>
      <!-- IE Column Clearing -->
      <div id="ie_clearing"> &#160; </div>
 </div>