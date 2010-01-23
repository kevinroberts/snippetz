<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
* Snips Controller
*/
class Snips_Controller extends Controller
{	
	function __construct()
	{
		parent::__construct();
		
		$this->database = new Database;
		//$this->profiler = new Profiler;

	}
	
	public function index()
    {
        header('HTTP/1.1 404 File Not Found');
    }

	public function snip_submit() 
	{
		$post = $_POST;
		if (isset($post["user"]) AND isset($post['title']) AND isset($post['lang']) AND isset($post['private_check']) AND isset($post['snippet']))
		{
			$userID = $post["user"];
			$title = $post['title'];
			$language = $post['lang'];
			$snippet = $post['snippet'];
			$private = $post['private_check'];
			$description = $post['description'];
			
			if (valid::standard_text($title) and valid::standard_text($userID) and valid::standard_text($description) and (strlen($private) == 1)) 
			{
				$preRestoreChars = array("~AMP~", "~EQUAL~");
				$restoreChars = array("&", "=");
				$snippet = str_replace($preRestoreChars, $restoreChars, $snippet);
				$snippet = html::specialchars($snippet);
				$description = filter_var($description,FILTER_SANITIZE_SPECIAL_CHARS);
				
				$db = Database::instance();
				if ($description == 'null')
				{
				$result = $db->query("INSERT INTO `snippetz`.`snips` (
				`snip_id` ,
				`user_id` ,
				`language` ,
				`snippet` ,
				`title` ,
				`date_added` ,
				`private`
				)
				VALUES (
				NULL , '".$userID."', '".$language."', '".$snippet."', '".$title."',
				CURRENT_TIMESTAMP , '".$private."'
				);");
				}
				else
				{
					$result = $db->query("INSERT INTO `snippetz`.`snips` (
					`snip_id` ,
					`user_id` ,
					`language` ,
					`snippet` ,
					`title` ,
					`date_added` ,
					`private`,
					`description`
					)
					VALUES (
					NULL , '".$userID."', '".$language."', '".$snippet."', '".$title."',
					CURRENT_TIMESTAMP , '".$private."', '".$description."' 
					);");	
				}
				if ($result)
				{
					echo "Success! Your snippet has been saved, view it now: <a href='/home/snip/".$result->insert_id()."'>here</a> or stay here and enter some more.";
				}
				else
					echo "DB error";
				
			}
			else
			{
				echo "Error: title field contains illegal characters"; die();
			}
			
		}
		else
		{
			echo "Error: wrong params";die();
		}
		
	}
}

?>