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
	
	public function get_snips($sql_limit, $sql_offset, $id)
	{
		$results = '';
		$db = Database::instance();
		$query = $db->from('snips')->where(array('user_id =' => $id))->limit($sql_limit*10)->offset($sql_offset)->get();
		if ($query)
		{
			$results .= "<ul class=\"snipList\">\n";
			foreach ($query as $row)
			{
				$results .= "<li>\n";
				$results .= $row->title."&nbsp;&nbsp; snip id:";
				$results .= $row->snip_id."&nbsp;";
				$results .= "</li>\n";
			}
			$results .= "</ul>\n";
		}
		return $results;
	}
	
	public function get_total_snips($id)
	{
		$db = Database::instance();
		$query = $this->db->from("snips")->where(array('user_id =' => $id))->get();
		return $query->count();
		
	}
}

?>