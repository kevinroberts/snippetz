<style type="text/css">
#codeBlock {
	margin-left:-15px;	
}
#lang {
	float:right;
	margin-right:11px;
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
	<div id="codeBlock">
		<pre class="brush: <?= $language ?>"><?= $snippet ?></pre>
		<div class="code_footer">snip submitted :: <?php echo date("F j, Y, g:i a" ,strtotime($date_added)); ?> :: by <?= $username ?></div>
	</div>
	<?php if($description != ''):?>
	<div id="snipDescription"><?= $description ?></div>
	<?php endif; ?>
    </div>
      <!-- IE Column Clearing -->
      <div id="ie_clearing"> &#160; </div>
 </div>