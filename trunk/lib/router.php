<?php

	class Router{
		
		function __construct(){}
		
		function getURI(){			
			global $_SERVER;
			$URI = explode('?', $_SERVER['REQUEST_URI']);
			$URI = explode('/', $URI[0]);
			return $URI;			
		}
	
		function getInclude($name){
		 	global $_GET, $_POST, $_SESSION;
			global $config, $DB, $LINK, $REDIS, $ROUTER, $VARS;
			$DIR = $config['dir']['home'];	
			$FILENAME = 'app/includes/'.$name.'.php'; 
			if(!empty($FILENAME) AND file_exists($DIR.'/'.$FILENAME)){ include($DIR.'/'.$FILENAME); }
		}
			
		function getController(){
		 	global $_GET, $_POST, $_SESSION;
			global $config, $DB, $LINK, $REDIS, $ROUTER, $VARS;
			$DIR = $config['dir']['home'];	
			$URI = $this->getURI();
			if(empty($URI[1])){ $FILENAME = 'home/index.php'; }
			elseif(!empty($URI[1]) AND empty($URI[2])){ $FILENAME = 'home/'.$URI[1].'.php'; }			
			elseif(!empty($URI[1]) AND !empty($URI[2])){ $FILENAME = $URI[1].'/'.$URI[2].'.php'; }
			if(!empty($FILENAME) AND file_exists($DIR.'app/'.$FILENAME)){ include($DIR.'app/'.$FILENAME); }
			else{ include($DIR.'app/home/404.php'); }
		}		
		
		function getSecurity($redirect_to){
			global $_SESSION;
			if(empty($_SESSION['REDIS']['HOSTNAME'])){
				header("HTTP/1.1 301 Moved Permanently"); 
				header('location: '.$redirect_to);
				exit(0);			 	
			}	 
		}
	
	}

?>