<?php defined('SYSPATH') or die('No direct script access.');
/**
* Snip Model
*/
class Snip_Model extends Model
{
	public $brushes = array('as3', 'bash', 'csharp', 'cpp', 'css', 'css; html-script: true', 'pascal', 'diff','groovy','js', 'js; html-script: true' , 'java', 'jfx' ,'perl' ,'php', 'php; html-script: true', 'plain' , 'powershell' ,'py' , 'rails', 'scala', 'sql' , 'vb' , 'xml');
	public $brushNames = array('ActionScript3', 'Bash/shell' ,'C#' , 'C++' , 'CSS', 'CSS with HTML' ,'Delphi' , 'Diff', 'Groovy' , 'JavaScript', 'Javascript with HTML' , 'Java', 'JavaFX' , 'Perl' , 'PHP', 'PHP with HTML' , 'Plain Text' , 'PowerShell' , 'Python' , 'Ruby' , 'Scala' , 'SQL' , 'Visual Basic' , 'XML / XHTML');
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
	
	
	public function listLanguages() 
	{
		$formString = '<select id="language">';
		$formString .= '<option value="none">Select a Language</option>';
		$availableBrushes = $this->brushes;
		$availableBrushesNames =  $this->brushNames;
		for ($i = 0 ; $i < count($availableBrushes) ; $i++ )
		{
		$formString .= '<option value="' . $availableBrushes[$i] . '">' . $availableBrushesNames[$i] . '</option>';
		}
		$formString .= '</select>';
		return $formString;
	}
	
	public function brush_to_lang($inputBrush)
	{
		$key = array_search($inputBrush, $this->brushes);
		
		return $this->brushNames[$key];
		
	}
	public function lang_to_brush($inputBrush)
	{
		$key = array_search($inputBrush, $this->brushNames);
		
		return $this->brushes[$key];
		
	}
	
	public function get_snips($sql_limit, $sql_offset, $id)
	{
		$results = '';
		$db = Database::instance();
		$query = $db->from('snips')->where(array('user_id =' => $id))->limit($sql_limit*10)->offset($sql_offset)->orderby('date_added', 'DESC')->get();
		if ($query)
		{
			if ($sql_limit == 1)
			$results .= "<ol start='".($sql_limit)."' class='snipList'>\n";
			else
			$results .= "<ol start='".($sql_limit * 10)."' class='snipList'>\n";
			foreach ($query as $row)
			{
				$results .= "<li>\n";
				$timeago = date::timespan(strtotime($row->date_added), time() , "days");
				if ($timeago == 0)
					{
					$timeago = date::timespan(strtotime($row->date_added), time() , "hours");
					$timeago .= " hours";
					}
				else
				$timeago .= " days";
				
				$results .= "<h2>";
				$username = $this->db->query("SELECT username FROM users WHERE id = ".$row->user_id."");
				foreach ($username as $row2)
				{
					$username = $row2->username;
				}
				$results .= "<a href='/home/snip/".$row->snip_id."'>".$row->title."</a></h2><span class='favLink'><a href=\"#\">Favorite</a></span>".
				"submitted ".$timeago." ago by ".$username." ";
				$results .= "<p>";
				$results .= "<pre>".text::limit_words($row->snippet, 10, "...<a href='/home/snip/".$row->snip_id."'>see more</a>")."</pre>";
				if (strlen($row->description) > 1)
					$results .= "Description: ".strip_tags(text::limit_words($row->description, 25));
				$results .= "</p>\n";
				$results .= "</li>\n";
			}
			$results .= "</ol>\n";
		}
		return $results;
	}
	
	public function get_snips_public($sql_limit, $sql_offset)
	{
		$results = '';
		$db = Database::instance();
		$query = $db->from('snips')->where(array('private =' => '0'))->limit($sql_limit*10)->offset($sql_offset)->orderby('date_added', 'DESC')->get();
		if ($query)
		{
			if ($sql_limit == 1)
			$results .= "<ol start='".($sql_limit)."' class='snipList'>\n";
			else
			$results .= "<ol start='".($sql_limit * 10)."' class='snipList'>\n";
			foreach ($query as $row)
			{
				$results .= "<li>\n";
				$timeago = date::timespan(strtotime($row->date_added), time() , "days");
				if ($timeago == 0)
					{
					$timeago = date::timespan(strtotime($row->date_added), time() , "hours");
					$timeago .= " hours";
					}
				else
				$timeago .= " days";
				
				$results .= "<h2>";
				$username = $this->db->query("SELECT username FROM users WHERE id = ".$row->user_id."");
				foreach ($username as $row2)
				{
					$username = $row2->username;
				}
				$results .= "<a href='/home/snip/".$row->snip_id."'>".$row->title."</a></h2><span class='favLink'><a href=\"#\">Favorite</a></span>".
				"submitted ".$timeago." ago by ".$username." ";
				$results .= "<p>";
				$results .= "<pre>".text::limit_words($row->snippet, 10, "...<a href='/home/snip/".$row->snip_id."'>see whole snippet</a>")."</pre>";
				if (strlen($row->description) > 1)
					$results .= "Description: ".strip_tags(text::limit_words($row->description, 25));
				$results .= "</p>\n";
				$results .= "</li>\n";
			}
			$results .= "</ol>\n";
		}
		return $results;
	}
	
	public function get_total_snips($id)
	{
		$db = Database::instance();
		$query = $this->db->from("snips")->where(array('user_id =' => $id))->get();
		return $query->count();
	}
	
	public function get_total_snips_public()
	{
		$db = Database::instance();
		$query = $this->db->from("snips")->where(array('private =' => '0'))->get();
		return $query->count();
	}
	
}

?>