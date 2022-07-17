<?
	// Проверка доступа к файлу
	if(!defined('CHECK')){
		die('No hacking!');
	}
	
	function dump($variables){
		echo "<pre>";
			var_dump($variables);
		echo "</pre>";
	}
	
	function out_mod($text){
		global $mod_content;
		
		$mod_content .= $text;
	}
	
	function out($text){
		global $content;
		
		$content .= $text;
	}
	
	function out_admin($text){
		if($_SESSION['user']){
			echo $text;
		}
	}
	
	function out_user($text){
		if(empty($_SESSION['user'])){
			echo $text;
		}
	}
	
	function isAdmin(){
		if($_SESSION['user']) return true;
		else return false;
	}
	
	function load_template($temp_name){
		global $content;
		global $mod_content;
		
		$template = '';
		ob_start();
		require TEMPDIR.$temp_name;
		$template = ob_get_contents();
		ob_end_clean();
		
		return $template;
	}
	
	function escapeStr($string){
		global $db;
		
		return mysqli_real_escape_string($db, $string);
	}
	
	function fullEscapeStr($string){
		global $db;
		
		return mysqli_real_escape_string($db, trim(strip_tags($string)));
	}
	
?>