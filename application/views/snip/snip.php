<?php if($is_logged_in == '1'): ?>
<script type="text/javascript">
function postDestroy()
{
	var snipID = <?php echo "'".$snipID."'"; ?>;
	var code = <?php echo "'".$user_id."'"; ?>;
	$.ajax({
	   type: "POST",
	   url: "/snips/snip_delete",
	   data: "snipID="+snipID+"&code="+code,
	   beforeSend: function(){
		 $("#options").hide();
		 $("#snipDescription").hide();
		 $("#codeBlock").html("deleting...");
	   },
	   complete: function(data){
		     $("#codeBlock").html(data.responseText);
	   }
	 });
}

function deleteSnip()
{
	$("#dialog").dialog({
		bgiframe: true,
		resizable: true,
		height:180,
		width: 350,
		modal: true,
		overlay: {
			backgroundColor: '#000',
			opacity: 0.5
		},
		buttons: {
			'Delete snip': function() {
				$(this).dialog('close');
				postDestroy();

			},
			Cancel: function() {
				$(this).dialog('close');
			}
		}
	});
}
</script>
	<?php endif; ?>
<style type="text/css">
#codeBlock {
	margin-left:-15px;	
}
#lang {
	float:right;
	margin-right:11px;
	position:relative;
	top:-16px;
}
#options {
	position:absolute;
	top:9px;
	left:14px;
}
.code_footer {
	background-color:Gainsboro;
	border:1px solid lightGrey;
	color:lightslateBlue;
	display:inline-block;
	width:99%;
	text-align:center;
	padding-top:5px;
	font-family:Helvetica;
	font-size:medium;
}
.code_header {
	background-color:Gainsboro;
	border:1px solid lightGrey;
	color:lightslateBlue;
	display:inline-block;
	width:99%;
	text-align:center;
	padding-top:5px;
	font-family:Helvetica;
	font-size:large;
}
#snipDescription {
	margin-top:10px;
}

</style>
<div id="col3">
      <div id="col3_content" class="clearfix">
<h1 style="text-decoration:underline;"></h1>
<div class="code_header"> <?= $title ?> </div>
<span id="lang">Published in: <?= $language ?></span>
<?php if($is_logged_in == '1'): ?>
<span id="options"><a href="/home/edit/<?= $snipID ?>">edit</a> | <a href="javascript:deleteSnip();" >delete</a></span>
<div id="dialog" title="Delete this snippet?">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Snip will be permanently deleted and cannot be recovered. Are you sure?</p>
</div>
<? endif; ?>
	<div id="codeBlock">
		<pre class="brush: <?= $language ?>"><?= $snippet ?></pre>
		<div class="code_footer">snip submitted :: <?php echo date("F j, Y, g:i a" ,strtotime($date_added)); ?> :: by <?= $username ?></div>
	</div>
	<?php if($description != '' || $description == 'null'):?>
	<div id="snipDescription"><?= $description ?></div>
	<?php endif; ?>
    </div>
      <!-- IE Column Clearing -->
      <div id="ie_clearing"> &#160; </div>
 </div>