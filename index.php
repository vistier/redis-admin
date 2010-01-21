<?php

	session_start();
	
	header("Content-Type: text/html; charset=ISO-8859-1");
		 
	/* essentials includes */			 
	include('functions.php');
	include('config.php');	
			 
	/* classes */
	$DB 	=& new Database;	
	$LINK	=& new Link;	
	$ROUTER =& new Router;
	
	/* return $_GET */
	$get = $DB->Request('get');
	
	/* create Default Schema */
	$DB->setDefaultSchema($get);
	$DB->select_db($_SESSION['REDIS']['DATABASE']);
	
	/* set default vars */
	$VARS['info'] = $DB->info();
	$VARS['uri'] = $ROUTER->getURI();
	
	/* include a Controller */
	$ROUTER->getController();			
	
?>