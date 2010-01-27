<?php

	class Link {						
		
		function __construct(){}
			
		function getLink($link){

		 	$$destination = false;
		 	
			/* meta links  */		
			if($link=="favicon") $destination = "html/favicon.ico";						
			if($link=="css") $destination = "html/css/default.css";		
			if($link=="js") $destination = "html/js/default.js";
			if($link=="jquery") $destination = "html/js/jquery-1.4.min.js";
			if($link=="images") $destination = "html/images";																			

			/* links */							
			if($link=="dashboard") $destination = "dashboard";	
			if($link=="schemas") $destination = "schemas";	
			if($link=="persistence") $destination = "persistence";											
			if($link=="keys") $destination = "keys";						
			if($link=="values") $destination = "values";		
			if($link=="help") $destination = "help";					
			if($link=="addkey-string") $destination = "addkey-string";		
			if($link=="addkey-list") $destination = "addkey-list";		
			if($link=="addkey-set") $destination = "addkey-set";		
			if($link=="addkey-zset") $destination = "addkey-zset";		
			if($link=="command") $destination = "command";
			if($link=="logout") $destination = "logout";										
								
			if($destination) return $this->getHome().$destination;							
			
			/* imagens */
			if($link=="logo-b") return $this->getLink("images")."/logo-b.jpg";	
			if($link=="logo-s") return $this->getLink("images")."/logo-s.jpg";					
			if($link=="logo-n") return $this->getLink("images")."/logo-n.jpg";		
			if($link=="bt-remove") return $this->getLink("images")."/bt-remove.png";					
					
		}
		
		function getHost(){
			global $_SERVER;
			return 'http://'.$_SERVER['HTTP_HOST'];			
		}
				
		function getHome(){	
		 	return $this->getHost().$this->getRootHome();
		}
		
		function getRootHome(){
			global $_SERVER;
		 	$homefolder = str_replace($_SERVER["DOCUMENT_ROOT"],'',$_SERVER["SCRIPT_FILENAME"]);
		 	return str_replace('index.php','',$homefolder);	
		}
		
		function getSession(){
			global $_SESSION; 
			if(empty($_SESSION['REDIS']['HOSTNAME'])){
				header("HTTP/1.1 301 Moved Permanently"); 
				header('location: '.$this->getLink('logout'));
				exit(0);			 	
			}
		}		
	}