<?php
	
	require '../system/vendor/class.eyemysqladap.inc.php';
	require '../system/vendor/class.eyedatagrid.inc.php';
	
	$db = new EyeMySQLAdap('localhost', 'root', 'kr7943', 'snippetz');
	$x = new EyeDataGrid($db);
	
	// Set the query
	$x->setQuery("*", "snips", 'snip_id', 'user_id = '.$userID.'');

	// Allows filters
	//$x->allowFilters();
	$x->showRowNumber();
	$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "deleteSnip(%_P%,".$userID.")");
	$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "window.location='/home/edit/%_P%'");
	$x->setColumnType('language', EyeDataGrid::TYPE_CUSTOM, '%language%');
	$x->setColumnType('title', EyeDataGrid::TYPE_CUSTOM, '<a href="/home/snip/%_P%">%title%</a>');
	
	$x->setColumnType('private', EyeDataGrid::TYPE_ARRAY, array('1' => 'yes', '0' => 'no'));
	$x->hideColumn('user_id');
	$x->hideColumn('snip_id');
	$x->hideColumn('snippet');
	$x->hideColumn('description');

?>
<script type="text/javascript" charset="utf-8">
jQuery(function($) {
	$("#dialog").hide();
});
function postDestroy(snipID, code)
{
	$.ajax({
	   type: "POST",
	   url: "/snips/snip_delete",
	   data: "snipID="+snipID+"&code="+code,
	   beforeSend: function(){
	   },
	   complete: function(data){
		window.location.reload();
	   }
	 });
}

function deleteSnip(snipID, code)
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
				postDestroy(snipID, code);

			},
			Cancel: function() {
				$(this).dialog('destroy');
			}
		}
	});
}
</script>
<div id="dialog" title="Delete this snippet?">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Snip will be permanently deleted and cannot be recovered. Are you sure?</p>
</div>
<div id="col3">
      <div id="col3_content" class="clearfix">
		<h1 class="library">Snippetz Manager</h1>
		<?php
		// Print the table
		$x->printTable();
		?>

    </div>
      <!-- IE Column Clearing -->
      <div id="ie_clearing"> &#160; </div>
 </div>