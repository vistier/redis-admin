<?php

	session_start();
	
	header("Content-Type: text/html; charset=UTF-8");
		 
	/* essentials includes */			 
	include('functions.php');
	include('config.php');	
			 
	/* classes */
	$DB 	=& new Database;	
	$LINK	=& new Link;	
	$ROUTER =& new Router;
		
	/* generate .htaccess */
	$ROUTER->setHtaccess();
		
	/* return $_GET */
	$get = $DB->Request('get');
	
	/* create default schema */
	$DB->setDefaultSchema($get);
	$DB->select_db($_SESSION['REDIS']['DATABASE']);
	
	/* set default vars */
	$VARS['info'] = $DB->info();
	$VARS['uri'] = $ROUTER->getURI();
		
	/* include controller */
	$ROUTER->getController();
	
?>