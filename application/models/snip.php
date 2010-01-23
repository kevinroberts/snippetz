<?php defined('SYSPATH') or die('No direct script access.');
/**
* Snip Model
*/
class Snip_Model extends Model
{
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
	
	
	public function listLanguages() 
	{
		$formString = '<select id="language">';
		$formString .= '<option value="none">Select a Language</option>';
		$brushes = array('as3', 'bash', 'csharp', 'cpp', 'css', 'pascal', 'diff','groovy','js', 'java', 'jfx' ,'perl' ,'php', 'plain' , 'powershell' ,'py' , 'rails', 'scala', 'sql' , 'vb' , 'xml');
		$brushNames = array('ActionScript3', 'Bash/shell' ,'C#' , 'C++' , 'CSS' ,'Delphi' , 'Diff', 'Groovy' , 'JavaScript' , 'Java', 'JavaFX' , 'Perl' , 'PHP' , 'Plain Text' , 'PowerShell' , 'Python' , 'Ruby' , 'Scala' , 'SQL' , 'Visual Basic' , 'XML / XHTML');
		for ($i = 0 ; $i < count($brushes) ; $i++ )
		{
		$formString .= '<option value="' . $brushes[$i] . '">' . $brushNames[$i] . '</option>';
		}
		$formString .= '</select>';
		return $formString;
	}
}

?>