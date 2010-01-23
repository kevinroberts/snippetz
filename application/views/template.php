<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title><?= $title; ?></title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<?= $template_head; ?>
		<link href="/files/CSS/my_layout.css" rel="stylesheet" type="text/css" />
		<link rel="shorcut icon" type="image/x-ico" href="/files/favicon.ico" />
		<?php //echo "<script type=\"text/javascript\" src=\"/files/site.js\"> </script>\n"; ?>
		<!--[if lte IE 7]>
		<link href="/files/CSS/patch_my_layout.css" rel="stylesheet" type="text/css" />
		<![endif]-->
		
	</head>
	
	<body>
		  <div class="page_margins">
		    <div class="page">
		      <div id="header">
		        <div id="topnav">
		          <!-- start: skip link navigation -->
		          <a class="skip" title="skip link" href="#navigation">Skip to the navigation</a><span class="hideme">.</span>
		          <a class="skip" title="skip link" href="#content">Skip to the content</a><span class="hideme">.</span>
		<a href="#">Privacy</a> | <a href="#">Contact</a> | <a href="#">Imprint</a>

		<form method="get" action="http://www.google.com/search">
		<div id="search">
		<input type="text"   name="q" size="25"
		 maxlength="255" value="" />
		<br />
		<input type="submit" value="Google Search" />
		</div>
		</form> 
		          <!-- end: skip link navigation -->
		        </div>
		        <?= $page_head ?>
		      </div>
		      <div id="nav">
		        <!-- skiplink anchor: navigation -->
		        <a id="navigation" name="navigation"></a>
		        <div class="hlist">
		          <!-- main navigation: horizontal list -->
			<?php 
			echo $page_nav; 
			?>
		        </div>
		      </div>
		      <div id="main">
				<div id="col1">
				      <div id="col1_content" class="clearfix">          	
						<!-- Login Box -->
						<?= $page_login ?>
				  		<?php
						$browser = $_SERVER['HTTP_USER_AGENT']; $foxfire = "Firefox";
						$pos = strpos($browser, $foxfire);
				  		if ($pos !== false) {
				    		echo ""; }
				    		else {
				     			echo "<span class='foxfire'><br />This Page is Best Viewed in Firefox<br />";
				    			echo "<a style='padding-left:1.5cm;' href='http://www.mozilla.com/firefox?from=sfx&uid=0&t=306'> <img border='0' alt='Spreadfirefox Affiliate 	Button' src='http://sfx-images.mozilla.org/affiliates/Buttons/firefox3/110x32_get_ffx.png' /></a></span>";
				     			} ?>
						</div>
				</div>
			<?php 
			    echo $page_content; 
			?>
		      </div>
		      <!-- begin: #footer -->
		      <div id="footer">
		   Copyright &copy;2010 | <a href="http://kevinroberts.us" title="Design by Kevin Roberts">Kevin Roberts</a> | Powered by <a href="http://www.kohanaphp.com/" target="_blank">Kohana PHP</a> | Page rendered in {execution_time} seconds, using {memory_usage} of memory
		      </div>
		    </div>
		  </div>
	</body>

</html>