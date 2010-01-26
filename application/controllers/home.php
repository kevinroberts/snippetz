<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
* Home Controller
*/
class Home_Controller extends Website_Controller
{
	protected $user;	
	
	function __construct()
	{
		parent::__construct();
		
		// Load sessions, to support logins
		$this->session = Session::instance();
		
		$this->template->template_head = '<script type="text/javascript" src="/files/jquery-1.3.2.min.js"> </script>
		<script type="text/javascript" src="/files/jqueryUI/jquery-ui-1.7.2.custom.min.js"> </script>
		<link href="/files/jqueryUI/css/cupertino/jquery-ui-1.7.2.custom.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="/files/jquery.jclock-1.2.0.js"> </script>
		<script type="text/javascript" src="/files/jquery.ajaxContent.js"> </script>';
		
		if (Auth::instance()->logged_in())
		{
			// Set the current user
			$this->user = $_SESSION['auth_user'];
			$this->template->page_login = View::factory('home_loginbox')
				->bind('user', $this->user);
		}
		else
		{
			$this->template->page_login = View::factory('home_loginbox');
		}
		// Load the page head 
		$this->template->page_head = "<img style=\"position:absolute; top: 5%; left: 0px; width:100px;\" src=\"/files/snippet-icon.png\" alt=\"lantern\" /><h1 style=\"padding-left: 70px;\">Snippetz</h1><span style=\"padding-left:50px;\">your personal code repository</span>";
	}
	
	function index ()
	{
		// Load the page title
		$this->template->title = "Snippetz ( ".date("F d, Y", time())." )";

		// Load the main page navigation
		$home_nav = new view('home_nav');
		$home_nav->highlight = 'home';
		$this->template->page_nav = $home_nav;
		
		// Load the page content based on whether user is logged in or not:
		$this->template->page_content = new View('home_content');
	}
	
	public function logged_in()
	{
		if ( ! is_object($this->user))
		{
			// No user is currently logged in
			url::redirect('home/login');
		}
		// Load the page title
		$this->template->title = "Snippetz ( ".date("F d, Y", time())." )";
		
		$home_nav = new view('home_nav');
		$home_nav->highlight = 'home';
		$this->template->page_nav = $home_nav;

		$this->template->page_content = View::factory('user_settings')
			->bind('user', $this->user);
	}
	
	public function login()
	{
		// check whether a user is logged in already
		if (Auth::instance()->logged_in())
		{ 
			// if is, return to page where login was called
			 url::redirect($this->session->get("requested_url")); 
		}
		$this->template->title = 'Login to Snippetz';
		$this->template->template_head = '<link href="/files/niceforms/niceforms-default.css" rel="stylesheet" type="text/css" />'.
		'<script type="text/javascript" src="/files/niceforms/niceforms.js"> </script>';

		// Load the main page navigation
		$home_nav = new view('home_nav');
		$home_nav->highlight = 'home';
		$this->template->page_nav = $home_nav;
		
		// Load the page content
		$this->template->page_content = View::factory('login')
			->bind('post', $post)
			->bind('errors', $errors);

		$post = Validation::factory($_POST)
			->pre_filter('trim')
			->add_rules('username', 'required', 'length[3,127]')
			->add_rules('password', 'required');

		if ($post->validate())
		{
			$user = ORM::factory('user', $post['username']);

			if ( ! $user->loaded)
			{
				// The user could not be located
				$post->add_error('username', 'not_found');
			}
			elseif (isset($post['remember_check']))
			{
				if ($post['remember_check'] == 'rememberMe') 
				{
				if (Auth::instance()->login($user, $post['password'], TRUE))
					{
					if ($post['return_to'] !== 'home') {
					$url = explode('~',$post['return_to']);
					$len = count($url);
					if ($len > 1 and $len < 3)
					$redirect = $url[0]."/".$url[1];
					if ($len > 2 and $len < 4)
					$redirect = $url[0]."/".$url[1]."/".$url[2];
					url::redirect($redirect);
					}
					else
					url::redirect('home');
					}
				}
			}
			elseif (Auth::instance()->login($user, $post['password']))
			{
				// Successful login
				// Redirect to page they wanted...
				if ($post['return_to'] !== 'home') {
				$url = explode('~',$post['return_to']);
				$len = count($url);
				if ($len > 1 and $len < 3)
				$redirect = $url[0]."/".$url[1];
				if ($len > 2 and $len < 4)
				$redirect = $url[0]."/".$url[1]."/".$url[2];
				url::redirect($redirect);
				}
				else
				url::redirect('home');
			}
			else
			{
				// Incorrect password
				$post->add_error('password', 'incorrect');
			}
		}

		$errors = $post->errors('form_errors');
	}
	
	public function register()
	{
		$this->template->title = 'Register for Snippetz';
		$this->template->template_head = '<link href="/files/niceforms/niceforms-default.css" rel="stylesheet" type="text/css" />'.
		'<script type="text/javascript" src="/files/niceforms/niceforms.js"> </script>';
		
		// Load the main page navigation
		$home_nav = new view('home_nav');
		$home_nav->highlight = 'home';
		$this->template->page_nav = $home_nav;

		// Load the page content
		$this->template->page_content = View::factory('register')
			->bind('post', $post)
			->bind('errors', $errors);
			
		// Will be converted into a Validation object
		$post = $_POST;

		// Create a new user
		$user = ORM::factory('user');

		// Give the user login privileges
		$user->add(ORM::factory('role', 'login'));

		// Validate and save the new user
		if ($user->validate($post, TRUE))
		{
			// Log in now
			Auth::instance()->login($user, $post['password']);

			// Redirect to the logged_in page
			url::redirect('home/logged_in');
		}

		$errors = $post->errors('form_errors');
		
	}

	public function logout()
	{
		Auth::instance()->logout();

		url::redirect('home/login?logout=1');
	}
	
	public function user_settings()
	{
		if ( ! is_object($this->user))
			{
			// No user is currently logged in
			url::redirect('home/login?loginRequired=1&return_to=home~user_settings');
			}
			// Load the page title
			$this->template->title = "Snippetz ( ".date("F d, Y", time())." )";
			// Load the form plugins
			//$this->template->template_head = '';

			// Load the main page navigation
			$home_nav = new view('home_nav');
			$home_nav->highlight = 'settings';
			$this->template->page_nav = $home_nav;

			
			$this->template->page_content = View::factory('user_settings')
				->bind('user', $this->user)
				->bind('post', $post)
				->bind('errors', $errors);
				
			// Will be converted into a Validation object
			$post = Validation::factory($_POST)
				->pre_filter('trim')
				->add_rules('username', 'length[4,127]')
				->add_rules('email', 'length[4,127]', 'valid::email')
				->add_rules('profile_pic', 'valid::url', 'length[4,255]')
				->add_rules('password', 'matches[password_confirm]', 'length[5,127]')
				->add_rules('password_confirm', 'matches[password]');
			
			// IF Form validates
			if ($post->validate())
			{
				$user = ORM::factory('user', $this->user->id); 
				if (isset($post['password'])) 
				{
					if (strlen($post['password']) > 1) { // keep the password from updating if the field was left empty
						$user->password = $post['password'];
						$user->save();
					}	
				}
				if (isset($post['email']))
				{
					$user->email = $post['email'];
					$user->save();
				}
				if (isset($post['profile_pic']))
				{
					if (strlen($post['profile_pic']) > 1) {
					$user->profile_pic = $post['profile_pic'];
					$user->save();
					}
				}
				if (isset($post['username']))
				{
					$user->username = $post['username'];
					$user->save();
				}
				url::redirect('/home?pass=updated');
			}
			
			$errors = $post->errors('form_errors');
	}

	public function new_snip()
	{
		if ( ! is_object($this->user))
		{
			// No user is currently logged in
			url::redirect('home/login?loginRequired=1&return_to=home~new_snip');
		}
		
		$snips_model = new Snip_Model();
		$langs = $snips_model->listLanguages();
		// Load the page title
		$this->template->title = "New Snip";
		
		$home_nav = new view('home_nav');
		$home_nav->highlight = 'new_snip';
		$this->template->page_nav = $home_nav;
		
		$this->template->template_head .= '
		<script type="text/javascript" src="/files/jquery.defaultvalue.js"> </script>
		<link href="/files/niceforms/niceforms-default.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="/files/niceforms/niceforms.js"> </script>
		<script type="text/javascript">
			jQuery(function($) {
				$("#title, #snippet").defaultvalue("Your Snippet Title", "\n\n\ntype / paste snippet code here...");
				$("#success_Message").hide();
				$("#descriptionRow").hide();
				$(\'#private_dlg\').click(function() {
				  	$("#dialog").dialog({
						bgiframe: true,
						modal: true,
						width: 450,
						buttons: {
							Ok: function() {
								$(this).dialog(\'close\');
							}
						}
					});
				});
			});
		</script>';
		
		$content = View::factory('snip/new_snip')
			->bind('user', $this->user);
			
		$content->languages = $langs;
		$this->template->page_content = $content;
		
	}
	
	public function snip ($id)
	{
		$db = Database::instance();
		$id = mysql_real_escape_string($id);
		$sql = 'SELECT `snip_id`, `user_id`, `language`, `snippet`, `title`, `date_added`, `private`, `description` FROM `snips` WHERE `snip_id` = '.$id.' LIMIT 0, 30 '; 
		$result = $db->query($sql);
		if ($result and $result->count() > 0)
		{
		foreach ($result as $row)
		{		
		   	$user_id = $row->user_id;
		   	$language = $row->language;
   		   	$snippet = $row->snippet;
			$title = $row->title;
			$date_added = $row->date_added;
			$private = $row->private;
			$description = $row->description;
		}
		if ($private == '1')
		{
			// Redirect if no one is logged in and tries to view private snippet
			if ( ! is_object($this->user))
			{
				url::redirect('/home/login?loginRequired=1&return_to=home~snip~'.$id);
			}
			// Redirect User if they are not the owner of the snippet
			if ($this->user->id != $user_id)
			{
				url::redirect('/home/?forbiddenSnip=1&currentUser='.$this->user->id."&neededUser=".$user_id);
			}
		}
		
		$this->template->title = "Snip: ".text::limit_words($title, 7);
		
		$this->template->template_head .= '
			<script type="text/javascript" src="/files/syntax/scripts/shCore.js"></script>
			<script type="text/javascript" src="/files/syntax/scripts/shBrushBash.js"></script>
			<script type="text/javascript" src="/files/syntax/scripts/shBrushCpp.js"></script>
			<script type="text/javascript" src="/files/syntax/scripts/shBrushCSharp.js"></script>
			<script type="text/javascript" src="/files/syntax/scripts/shBrushCss.js"></script>
			<script type="text/javascript" src="/files/syntax/scripts/shBrushDelphi.js"></script>
			<script type="text/javascript" src="/files/syntax/scripts/shBrushDiff.js"></script>
			<script type="text/javascript" src="/files/syntax/scripts/shBrushGroovy.js"></script>
			<script type="text/javascript" src="/files/syntax/scripts/shBrushJava.js"></script>
			<script type="text/javascript" src="/files/syntax/scripts/shBrushJScript.js"></script>
			<script type="text/javascript" src="/files/syntax/scripts/shBrushPhp.js"></script>
			<script type="text/javascript" src="/files/syntax/scripts/shBrushPlain.js"></script>
			<script type="text/javascript" src="/files/syntax/scripts/shBrushPowerShell.js"></script>
			<script type="text/javascript" src="/files/syntax/scripts/shBrushPython.js"></script>
			<script type="text/javascript" src="/files/syntax/scripts/shBrushRuby.js"></script>
			<script type="text/javascript" src="/files/syntax/scripts/shBrushScala.js"></script>
			<script type="text/javascript" src="/files/syntax/scripts/shBrushSql.js"></script>
			<script type="text/javascript" src="/files/syntax/scripts/shBrushVb.js"></script>
			<script type="text/javascript" src="/files/syntax/scripts/shBrushXml.js"></script>
			<link type="text/css" rel="stylesheet" href="/files/syntax/styles/shCore.css"/>
			<link type="text/css" rel="stylesheet" href="/files/syntax/styles/shThemeDefault.css"/>
			<script type="text/javascript">
				SyntaxHighlighter.config.clipboardSwf = "/files/syntax/scripts/clipboard.swf";
				SyntaxHighlighter.all();
				jQuery(function($) {
					$("#dialog").hide();
				});
				</script>';
		
		$home_nav = new view('home_nav');
		$home_nav->highlight = 'none';
		$this->template->page_nav = $home_nav;
		
		$result = $db->query("SELECT username FROM users WHERE id = ".$user_id." LIMIT 0, 1");
		foreach ($result as $row)
		{		
		   	$username = $row->username;
		}
		
		$content = View::factory('snip/snip');
		if (is_object($this->user))
		{
		if ($this->user->id != $user_id)
			$is_logged_in = "0";
			else
			$is_logged_in = "1";
		}
		else
			$is_logged_in = "0";
			
		$content->username = $username;
		$content->snipID = $id;
		$content->is_logged_in = $is_logged_in;
		$content->user_id = $user_id;
		$content->language = $language;
		$content->title = $title;
		$content->snippet = $snippet;
		$content->date_added = $date_added;
		$content->private = $private;
		$content->description = $description;
		
		$this->template->page_content = $content;
		
		}
		else
			throw new Kohana_404_Exception('home/snip/'.$id);
		
	}
	
	public function edit($id)
	{
		$db = Database::instance();
		$id = mysql_real_escape_string($id);
		$sql = 'SELECT `snip_id`, `user_id`, `language`, `snippet`, `title`, `date_added`, `private`, `description` FROM `snips` WHERE `snip_id` = '.$id.' LIMIT 0, 30 '; 
		$result = $db->query($sql);
		if ($result and $result->count() > 0)
		{
		foreach ($result as $row)
		{		
		   	$user_id = $row->user_id;
		   	$language = $row->language;
   		   	$snippet = $row->snippet;
			$title = $row->title;
			$date_added = $row->date_added;
			$private = $row->private;
			$description = $row->description;
		}
			// Redirect if no one is logged in and tries to edit private snippet
			if ( ! is_object($this->user))
			{
				url::redirect('/home/login?loginRequired=1&return_to=home~edit~'.$id);
			}
			// Redirect User if they are not the owner of the snippet (Change to only if snippet is private?)
			if ($this->user->id != $user_id)
			{
				url::redirect('/home/?forbiddenSnip=1&currentUser='.$this->user->id."&neededUser=".$user_id);
			}
	
		$this->template->title = "Snippet Editor";
		$home_nav = new view('home_nav');
		$home_nav->highlight = 'none';
		$this->template->page_nav = $home_nav;
		
		$this->template->template_head .= '
		<script type="text/javascript">
			jQuery(function($) {
				$("#success_Message").hide();
				$("#language").val("'.$language.'");
				$(\'#private_dlg\').click(function() {
				  	$("#dialog").dialog({
						bgiframe: true,
						modal: true,
						width: 450,
						buttons: {
							Ok: function() {
								$(this).dialog(\'destroy\');
							}
						}
					});
				});
			});
		</script>';
		
		$snips_model = new Snip_Model();
		$langs = $snips_model->listLanguages();
		
		$content = View::factory('snip/edit')
			->bind('user', $this->user);
			
		$content->snipID = $id;
		$content->user_id = $user_id;
		$content->language = $language;
		$content->title = $title;
		$content->snippet = $snippet;
		$content->date_added = $date_added;
		$content->private = $private;
		$content->description = $description;
		
		$content->languages = $langs;
		$this->template->page_content = $content;
		
		}
		else
		{
			throw new Kohana_404_Exception('home/edit/'.$id);	
		}
				
				
	}
	
	public function library ($page_no = 1) 
	{
		if ( ! is_object($this->user))
		{
			// No user is currently logged in
			url::redirect('home/login?loginRequired=1&return_to=home~library');
		}
		$userID = $this->user->id;
		$items = new Snip_Model();
		
	
		$this->pagination = new Pagination(array(
	        'base_url'    => 'home/library/', // Set our base URL to controller 'items' and method 'page'
	        'uri_segment' => 'library', // Our URI will look something like http://domain/items/page/19
	        'total_items' => $items->get_total_snips($userID) // Total number of items.
		    ));
		//Load the snip library table
		$snips = $items->get_snips($page_no, $this->pagination->sql_offset, $userID);
		$content = new View('snip/snipLibrary');
		$content->items = $snips; // page to get starting at offset, number of items to get
		
		$this->template->title = "Your Snippetz Library";
		$home_nav = new view('home_nav');
		$home_nav->highlight = 'library';
		$this->template->page_nav = $home_nav;
		
		$this->template->page_content = $content;
		
		
		
	}
}

?>