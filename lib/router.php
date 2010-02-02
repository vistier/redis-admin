<?php

	class Router{
		
		function __construct(){}
		
		function getURI(){			
			global $_SERVER, $LINK;
			$URI = explode('?', $_SERVER['REQUEST_URI']);
			$URI = '/'.str_replace($LINK->getHome(), '', $LINK->getHost().$URI[0]);
			$URI = explode('/', $URI);
			return $URI;			
		}
	
		function setHtaccess(){
			global $LINK, $_SESSION;
			if(empty($_SESSION['REDIS']['HOSTNAME'])){
				if($handle = @fopen(".htaccess", "w")){
				$content = "<IfModule mod_rewrite.c>
				RewriteEngine On
				RewriteBase {$LINK->getRootHome()}
				RewriteCond %{REQUEST_FILENAME} !-f
				RewriteCond %{REQUEST_FILENAME} !-d
				RewriteRule . {$LINK->getRootHome()}index.php [L]
				</IfModule>";	
				fwrite($handle, $content);
				fclose($handle);		
				}else{
					echo "<h1>Can´t create .htaccess file. Verify directory privileges.</h1>"; 
					exit(1);
				}
			}	
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
			if(empty($VARS['uri'][1])){ $FILENAME = 'home/index.php'; }
			elseif(!empty($VARS['uri'][1]) AND empty($VARS['uri'][2])){ $FILENAME = 'home/'.$VARS['uri'][1].'.php'; }			
			elseif(!empty($VARS['uri'][1]) AND !empty($VARS['uri'][2])){ $FILENAME = $VARS['uri'][1].'/'.$VARS['uri'][2].'.php'; }
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