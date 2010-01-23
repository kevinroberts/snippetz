<?php
/**
* Website Controller
*/
class Website_Controller extends Template_Controller
{
	function __construct()
	{
		parent::__construct();
		
		// Load site wide dependencies
		$this->database = new Database;
		$this->profiler = new Profiler;

	}
	
}

?>