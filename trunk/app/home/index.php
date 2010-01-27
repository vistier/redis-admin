<?php
	if(!empty($_SESSION['REDIS']['HOSTNAME'])){
		header("HTTP/1.1 301 Moved Permanently"); 
		header('location: '.$LINK->getLink('dashboard'));
		exit(0);		
	}

	if(!empty($_POST['host']) AND !empty($_POST['user']) AND !empty($_POST['pass'])){
	 
		$post = $DB->Request('post');
		
		if( ($post['user']==$config['admin']['user']) AND ($post['pass']==$config['admin']['pass']) ){
		 
			$_SESSION['REDIS']['HOSTNAME']=$post['host'];
			
			header("HTTP/1.1 301 Moved Permanently"); 
			header('location: '.$LINK->getLink('dashboard'));
			exit(0);
			
		}else{
			$VARS['error']="The username or password you entered is incorrect."; 
		}
	}
?>
<?php $ROUTER->getInclude('header'); ?>

</table>

<div id="home_logo">
	<img src="<?php echo $LINK->getLink('logo-s'); ?>" title="Redis Admin" alt="Redis Admin" />
</div>

<?php if(!empty($VARS['error'])){ ?><div id="error"><?php echo $VARS['error']; ?></div><?php } ?>

<form action="" method="post">
<input type="hidden" name="host" value="localhost" />
<div id="widget_1" class="widget" style="width: 300px;">
	<div class="widget_title">Login</div>
	<div class="row">
		<div class="left"><strong>Username:</strong></div>
		<div class="right"><input type="text" name="user" width="20" /></div>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<div class="left"><strong>Password:</strong></div>
		<div class="right"><input type="password" name="pass" width="20" /></div>
		<div class="clear"></div>
	</div>

	<div class="row">
		<div class="left"></div>
		<div class="right"><input type="submit" value="Connect" /></div>
		<div class="clear"></div>
	</div>	
</div>
</form>

<br />

<style>#footer { border: 0; }</style>

<table>

<?php $ROUTER->getInclude('footer'); ?>