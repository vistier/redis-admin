<?php

	class Link {						
		
		function __construct(){}
			
		function getLink($link){
		 
		 	global $config, $REDIS, $LINK, $ROUTER, $VARS;

			/* meta links  */		
			if($link=="favicon") return "/html/favicon.ico";						
			if($link=="css") return "/html/css/default.css";		
			if($link=="js") return "/html/js/default.js";
			if($link=="jquery") return "/html/js/jquery-1.4.min.js";
			if($link=="images") return "/html/images";																			

			/* links */							
			if($link=="dashboard") return "/dashboard";	
			if($link=="schemas") return "/schemas";	
			if($link=="persistence") return "/persistence";											
			if($link=="keys") return "/keys";						
			if($link=="values") return "/values";		
			if($link=="help") return "/help";					

			if($link=="addkey-string") return "/addkey-string";		
			if($link=="addkey-list") return "/addkey-list";		
			if($link=="addkey-set") return "/addkey-set";		
			if($link=="addkey-zset") return "/addkey-zset";		
			if($link=="command") return "/command";
																																	
			if($link=="logout") return "/logout";										
															
			/* imagens */
			if($link=="logo-b") return $this->getLink("images")."/logo-b.jpg";	
			if($link=="logo-s") return $this->getLink("images")."/logo-s.jpg";					
			if($link=="logo-n") return $this->getLink("images")."/logo-n.jpg";		
			if($link=="bt-remove") return $this->getLink("images")."/bt-remove.png";					
					
		}
		
		function getHome(){
		 	global $_SERVER;
		 	return 'http://'.$_SERVER['HTTP_HOST'];
		}
		
		function getHost(){
			global $VARS;
			return 'http://'.$VARS['link']['host'];			
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