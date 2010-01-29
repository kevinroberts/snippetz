<script type="text/javascript" charset="utf-8">
	function editSubmit () 
	{
		var title = $("#title").val();
		var lang = $("#language").val();
		var snippet = $("#snippet").val();
		var private_check = $("#private:checked").val();
		var description = $("#description").val();
		// Check if default values were submitted
		if (title == 'Your Snippet Title' || title == '')
			{
				$("#title").val("");
				$("#title").effect("highlight");$("#title").focus();
				$("#title_error").text("Please enter a title for your snippet");
				return(false);
			}
		if (lang == 'none')
		{
			$("#language").effect("highlight");
			$("#lang_error").text("Please enter a language for your snippet");
			return(false);
		}
		if (snippet == '\n\n\ntype / paste snippet code here...' || snippet == '')
		{
			$("#snippet").effect("highlight");$("#snippet").focus();
			$("#snippet_error").text("Please enter a snippet");
			return(false);	
		}
		if (! title.match(/^[A-Za-z0-9_`!@#$%^&*()-=+{}"\., ]+$/))
		{
			$("#title").effect("highlight");$("#title").focus();
			$("#title_error").text("Please use a title with alphanumeric values only");
			return(false);
		}
		if (description.length > 1024)
		{
			$("#description").effect("highlight");$("#description").focus();
			$("#description_error").text("Please shorten your description to fewer than 1024 characters");
			return(false);
		}
		snippet = snippet.replace(/&/g,"~AMP~");
		snippet = snippet.replace(/[=]+/g, "~EQUAL~");
		description = description.replace(/&/g, "~AMP~");
		description = description.replace(/[=]+/g, "~EQUAL~");
		title = title.replace(/&/g, "~AMP~");
		title = title.replace(/[=]+/g, "~EQUAL~");
		if (private_check === undefined)
			private_check = 0;
		else
			private_check = 1;
		if (description == '')
			description = 'null';
		$.ajax({
		   type: "POST",
		   url: "/snips/snip_edit",
		   data: "user="+<?php echo $user->id; ?>+"&snipID="+<?php echo $snipID; ?>+"&title="+title+"&lang="+lang+"&private_check="+private_check+"&description="+description+"&snippet="+snippet,
		   beforeSend: function(){
			 $("#ajaxLoader").attr('style', '');
			window.scroll(0,0);
			 $("#snippet_error").text("");
			 $("#title_error").text("");
			 $("#lang_error").text("");$("#description_error").text("");
		   },
		   complete: function(data){
			    //alert(data.responseText);
			 	$("#ajaxLoader").attr('style', 'display:none;');
				$("#success_Message").show();
				$("#success_Message").html(data.responseText);
				$("#snip_edit_table").hide();
		   }
		 });
	}
</script>
<style type="text/css" media="screen">
	input {
		font-family: helvetica sans-serif;
		font-size: 12pt;
	}
	textarea {
		font-family: helvetica sans-serif;
		font-size: 12pt;
	}
	#snippet {
		font-family: courier new;
		font-size: 12pt;
	}
	#col3_content h1 {
		padding-left:240px;
	}
	#snip_edit_table {
		border-width: 0px;
		border-spacing: 0px;
		border-style: none;
		border-color: gray;
		border-collapse: collapse;
		background-color: white;
	}
	#snip_edit_table td {
		padding: 5px;
		border-style: none;
		border-color: gray;
		background-color: white;
	}
	#submit {
		position:relative;
		left: 280px;
	}
	#private_dlg {
		cursor:pointer;
	}
</style>
<div id="dialog" title="What are private snippets?" style="display:none;">
	<p>
	Marking a snippet as private means no one will be able to view this snippet. It won't show up anywhere on the website, the RSS feeds, or through the API. Your private snippets will only show up in your list of snippets when you are logged in. (Default = private)
	</p>
</div>
<div id="col3">
      <div id="col3_content" class="clearfix">
<h1>Snippet Editor</h1>
<div id="ajaxLoader" style="display:none"><img src="/files/orange_loading.gif" /> Submitting your snippet... </div>
<div id="success_Message" class="fbinfobox"></div>
<form method="post" accept-charset="utf-8">
<table id="snip_edit_table">
	<tr>
		<td>
			Title:
		</td>
		<td>
			<input type="text" size="55" name="title" value=<?php echo "'".$title."'" ?> id="title" /><span id="title_error" class="errors"></span>
		<td>
	</tr>
	<tr>
		<td>
			Language:
		</td>
		<td>
			<?= $languages ?><span id="lang_error" class="errors"></span>
		</td>
	</tr>
	<tr>
		<td>
			Snippet:
		</td>
		<td>
			<textarea name="snippet" id="snippet" rows="15" cols="70"><?= $snippet ?></textarea><span id="snippet_error" class="errors"></span>
		</td>
	</tr>
	<tr>
		<td>
			Description:
		</td>
		<td>
			<?php if($description != '' || $description == 'null'):?>
			<textarea name="description" id="description" rows="10" cols="70"><?= $description ?></textarea><span id="description_error" class="errors"></span>
			<?php else: ?>
			<textarea name="description" id="description" rows="10" cols="70"></textarea><span id="description_error" class="errors"></span>
			<?php endif; ?>
		</td>
	</tr>
	<tr>
		<td>
		</td>
		<td> <input name="private" id="private" type="checkbox" <?php 
				if($private == 1)
					echo "checked='checked'";
				else
					echo "";
				?> />  private (<a id="private_dlg" title="what does this mean?">?</a>)</td>
	</tr>
	<tr>
		<td>
		<input type="button" onclick="editSubmit();" name="submit" value="submit" id="submit">
		</td>
	</tr>
</table>
</form>
    </div>
      <!-- IE Column Clearing -->
      <div id="ie_clearing"> &#160; </div>
 </div>