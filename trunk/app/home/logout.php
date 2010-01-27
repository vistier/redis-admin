<?php

	/* unset session */
	unset($_SESSION);
	
	/* destroi a sessao */
	session_destroy();
	
	/* redireciona usuario para home */
	header("HTTP/1.1 301 Moved Permanently"); 
	header('location: '.$LINK->getHome());
	exit(0);	
?>