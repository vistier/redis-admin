<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="pt-BR">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Expires" content="Tue, 01 Jan 2000 12:12:12 GMT">
<meta http-equiv="Pragma" content="no-cache">
<title><?php if(!empty($VARS['meta_title'])) echo $VARS['meta_title'].' - '; ?>Redis Admin</title>
<link rel="shortcut icon" href="<?php echo $LINK->getLink('favicon'); ?>" type="image/x-icon" /> 
<link rel="stylesheet" href="<?php echo $LINK->getLink('css'); ?>" type="text/css" media="screen" />
<script src="<?php echo $LINK->getLink('js'); ?>" type="text/javascript"></script>
</head>
<body>

<?php if( $VARS['header'] ){ ?>

<div id="header">

	<div class="left center" style="width: 155px;">
		<a href="<?php echo $LINK->getLink('dashboard'); ?>"><img src="<?php echo $LINK->getLink('logo-n'); ?>" /></a>
	</div>
	<div class="left">
		<div style="margin: 5px 0;">
			<div>
				<div class="left"><strong>Server: </strong><?php echo $_SESSION['REDIS']['HOSTNAME']; ?></div>
				<div class="left" style="margin: 0 20px;"><strong>Instance: </strong>
				<?php echo $_SESSION['REDIS']['DATABASE']; ?>
				</div>				
				<div class="left"><strong>Schema: </strong>
				<?php $DB->select_db(15); ?>
				<?php echo $DB->getSingleKeyValue(15, "schema:sid:".$_SESSION['REDIS']['DATABASE']); ?></div>
				<div class="clear"></div>
			</div>
			<div style="padding: 5px 0;"><strong>Monitor: </strong>
			<?php if(!empty($VARS['command'])){ echo $VARS['command']; }else{ echo "idle"; }?>
			</div>			
		</div>
		<div style="margin-top: 15px;">
		<strong>
		<a href="<?php echo $LINK->getLink('dashboard'); ?>">Dashboard</a> &nbsp;&nbsp;
		<a href="<?php echo $LINK->getLink('schemas'); ?>">Schemas</a> &nbsp;&nbsp;					
		<a href="<?php echo $LINK->getLink('command'); ?>">Command</a> &nbsp;&nbsp;					
		<a href="<?php echo $LINK->getLink('persistence'); ?>">Persistence</a> &nbsp;&nbsp;			
		<a href="<?php echo $LINK->getLink('help'); ?>">Help</a> &nbsp;&nbsp;					
		<a href="<?php echo $LINK->getLink('logout'); ?>">Logout</a>
		</strong>
		</div>
	</div>
	<div class="clear"></div>	
	
</div>

<?php } ?>

<table id="wrap">

<?php if( $VARS['menu'] ){ ?>

<td id="menu" valign="top">
	<?php $ROUTER->getInclude('menu'); ?>
</td>

<?php } ?>