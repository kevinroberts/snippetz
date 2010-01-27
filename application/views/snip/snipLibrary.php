<style type="text/css" media="screen">
	/* Pagination */
	p.pagination
	{
		text-align: center;
	    padding: 3px;
	    margin: 3px;
	}
	p.pagination a
	{
	    padding: 2px 5px 2px 5px;
	    margin: 2px;
	    border: 1px solid #AAAADD;
	    text-decoration: none; /* no underline */
	    color: #000099;
	}
	p.pagination a:hover, div.pagination a:active
	{
	    border: 1px solid #000099;
	    color: #000;
	}
	p.pagination span.current
	{
	    padding: 2px 5px 2px 5px;
	    margin: 2px;
	    border: 1px solid #000099;
	    font-weight: bold;
	    background-color: #993300;
	    color: #FFF;
	}
	p.pagination span.disabled
	{
	    padding: 2px 5px 2px 5px;
	    margin: 2px;
	    border: 1px solid #EEE;
	    color: #DDD;
	}
</style>
<div id="col3">
      <div id="col3_content" class="clearfix">
		<h1>My Snippetz</h1>
		<?php echo $this->pagination->render() ?>
		<?php echo $items?>
    </div>
      <!-- IE Column Clearing -->
      <div id="ie_clearing"> &#160; </div>
 </div>

