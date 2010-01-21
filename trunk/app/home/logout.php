<?php

	/* destroi a sessao */
	session_destroy();
	
	/* redireciona usuario para home */
	header("HTTP/1.1 301 Moved Permanently"); 
	header('location: /');
	exit(0);	
?>