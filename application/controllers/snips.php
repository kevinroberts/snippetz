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
		require '../system/vendor/markdown.php';

	}
	
	public function index()
    {
        header('HTTP/1.1 404 File Not Found');
    }

	public function snip_submit() 
	{
		$input = Input::instance();
		$post = $_POST;
		if (isset($post["user"]) AND isset($post['title']) AND isset($post['lang']) AND isset($post['private_check']) AND isset($post['snippet']))
		{
			$userID = $post["user"];
			$title = $post['title'];
			$snips_model = new Snip_Model();
			$language = $snips_model->brush_to_lang($post['lang']);
			$snippet = $post['snippet'];
			$private = $post['private_check'];
			//$description = $post['description'];
			$description = $input->post('description',NULL,TRUE);
			
			if (valid::standard_text($title) and valid::standard_text($userID) and (strlen($private) == 1)) 
			{
				$preRestoreChars = array("~AMP~", "~EQUAL~");
				$restoreChars = array("&", "=");
				$snippet = str_replace($preRestoreChars, $restoreChars, $snippet);
				$title = str_replace($preRestoreChars, $restoreChars, $title);
				$description = str_replace($preRestoreChars, $restoreChars, $description);
				$snippet = htmlspecialchars($snippet);
				$parser_class = MARKDOWN_PARSER_CLASS;
				$parser = new $parser_class;
				$title = mysql_real_escape_string($title);
				$snippet = mysql_real_escape_string($snippet);
				
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
					$description = $parser->transform($description);
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
					CURRENT_TIMESTAMP , '".$private."', '".mysql_real_escape_string($description)."' 
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
	
	public function snip_delete()
	{
		$post = $_POST;
		if (isset($post["snipID"]) and isset($post['code']))
		{
			if (Auth::instance()->logged_in())
			{
			$currentUser = Auth::instance()->get_user();
			if ($currentUser->id == $post['code'])
				{
					$sql = "DELETE FROM `snips` WHERE `snips`.`snip_id` = ".mysql_real_escape_string($post['snipID'])." LIMIT 1";
					$db = Database::instance();
					$result = $db->query($sql);
					echo "Success: your snippet was deleted";
				}
			}
			else
			{
			echo "Error: Insufficient privileges"; die();
			}
					
		}
		else
		{
			echo "Error: wrong params";die();
		}
		
	}
	public function snip_edit()
	{
		$input = Input::instance();
		$post = $_POST;
		if (isset($post["user"]) AND isset($post['snipID']) AND isset($post['title']) AND isset($post['lang']) AND isset($post['private_check']) AND isset($post['snippet']))
		{
			$userID = $post["user"];
			$snipID = mysql_real_escape_string($post["snipID"]);
			$title = $post['title'];
			$snips_model = new Snip_Model();
			$language = $snips_model->brush_to_lang($post['lang']);
			$snippet = $post['snippet'];
			$private = mysql_real_escape_string($post['private_check']);
			//$description = $post['description'];
			$description = $input->post('description',NULL,TRUE);
			
			if (valid::standard_text($title) and valid::standard_text($userID) and (strlen($private) == 1)) 
			{
				$preRestoreChars = array("~AMP~", "~EQUAL~");
				$restoreChars = array("&", "=");
				$snippet = str_replace($preRestoreChars, $restoreChars, $snippet);
				$title = str_replace($preRestoreChars, $restoreChars, $title);
				$description = str_replace($preRestoreChars, $restoreChars, $description);
				$snippet = htmlspecialchars($snippet);
				$title = mysql_real_escape_string($title);
				$snippet = mysql_real_escape_string($snippet);
				$parser_class = MARKDOWN_PARSER_CLASS;
				$parser = new $parser_class;
				
				$db = Database::instance();
				if ($description == 'null')
				{
					$sql = "UPDATE `snippetz`.`snips` SET `language` = '".$language."' , `snippet` = '".$snippet."' , `title` = '".$title."' , `date_added` = CURRENT_TIMESTAMP , `private` = ".$private." WHERE `snip_id` = ".$snipID.";";
					$result = $db->query($sql);
				}
				else
				{
					$description = $parser->transform($description);
					$description = str_replace("\n", "<br />", $description);
					$sql = "UPDATE `snippetz`.`snips` SET `language` = '".$language."' , `snippet` = '".$snippet."' , `title` = '".$title."' , `date_added` = CURRENT_TIMESTAMP , `private` = ".$private." , `description` = '".mysql_real_escape_string($description)."' WHERE `snip_id` = '".$snipID."';";
					$result = $db->query($sql);
					
				}
				if ($result)
				{
					echo "Success! Your snippet has been updated, view it now: <a href='/home/snip/".$snipID."'>here</a> .";
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