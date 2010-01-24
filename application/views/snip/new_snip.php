<style type="text/css">
.NFCheck {
	left:auto !important;
	top:auto !important;
}
.errors {
	margin-left:20px !important;
}
.addDescription {
	padding-left:15px;
}
</style>
<script type="text/javascript">
	function toggleDesc()
	{
		 $("#descriptionRow").slideToggle("fast", function() {
		    // Animation complete.
			  $("#description").focus();
		  });
	}
	function postSnippet()
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
		snippet = snippet.replace("&", "~AMP~");
		snippet = snippet.replace("=", "~EQUAL~");
		description = description.replace("&", "~AMP~");
		description = description.replace("=", "~EQUAL~");
		title = title.replace("&", "~AMP~");
		title = title.replace("=", "~EQUAL~");
		if (private_check == 'no')
			private_check = 0;
		else
			private_check = 1;
		if (description == '')
			description = 'null';
		$.ajax({
		   type: "POST",
		   url: "/snips/snip_submit",
		   data: "user="+<?php echo $user->id; ?>+"&title="+title+"&lang="+lang+"&private_check="+private_check+"&description="+description+"&snippet="+snippet,
		   beforeSend: function(){
			 $("#ajaxLoader").attr('style', '');
			 $("#snippet_error").text("");
			 $("#title_error").text("");
			 $("#lang_error").text("");$("#description_error").text("");
		   },
		   complete: function(data){
			    //alert(data.responseText);
			 	$("#ajaxLoader").attr('style', 'display:none;');
				$("#success_Message").show();
				$("#success_Message").html(data.responseText);
				// reset form values
				$("#title").val('');
				$("#snippet").val('');
				$("#description").val('');
		   }
		 });		
	}
</script>

<div id="dialog" title="What are private snippets?" style="display:none;">
	<p>
	Marking a snippet as private means no one will be able to view this snippet. It won't show up anywhere on the website, the RSS feeds, or through the API. Your private snippets will only show up in your list of snippets when you are logged in. (Default = private)
	</p>
</div>
<div id="col3">
      <div id="col3_content" class="clearfix">
<h1>Add New Snippet:</h1>
<div id="ajaxLoader" style="display:none"><img src="/files/orange_loading.gif" /> Submitting your snippet... </div>
<div id="success_Message" class="fbinfobox"></div>
<form class="niceform">
<table class="newSnip">
	<tr>
		<td><input type="text" name="title" id="title" size="55" /> <span id="title_error" class="errors"></span></td>
	</tr>
	<tr>
		<td> <?= $languages ?> <span id="lang_error" class="errors"></span></td>
	</tr>
	<tr>
		<td> <textarea name="snippet" id="snippet" rows="15" cols="70"></textarea><span id="snippet_error" class="errors"></td>
	</tr>
	<tr>
		<td> <input name="private" id="private" type="checkbox" checked="checked" />  private (<a id="private_dlg" title="what does this mean?" href="#">?</a>)<span class="addDescription"><a id="descriptionLink" title="Click to add a short description" href="#" onclick="toggleDesc()">Add a description? (optional)</a></span></td>
	</tr>
	<tr id="descriptionRow">	
		<td>
			<textarea name="description" id="description" rows="10" cols="70"></textarea><span id="description_error" class="errors"></span>
		</td>
		<td><a target="_blank" href="http://daringfireball.net/projects/markdown/dingus">Markdown enabled</a></td>
	</tr>
	<tr>
		<td> <input name="submit" id="submit" type="button" onclick="postSnippet();" value="submit snip" /></td>
	</tr>
</table>
</form>

    </div>
      <!-- IE Column Clearing -->
      <div id="ie_clearing"> &#160; </div>
 </div>