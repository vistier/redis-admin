<?php
	/* verify session */
	$ROUTER->getSecurity($LINK->getLink('logout'));
	
	if($_POST['command']=="addkey-string" AND !empty($_POST['key']) AND !empty($_POST['value']) AND !empty($_POST['type'])){
	 	$post = $DB->Request('post');
	 	$DB->setNewKey($post);
		header('location: '.$LINK->getLink('keys'));
		exit(0);
	}
?>
<?php $VARS['meta_title'] 	= "Add Key String"; ?>
<?php $VARS['header'] 		= true; ?>
<?php $VARS['menu'] 		= true; ?>
<?php $ROUTER->getInclude('header'); ?>

<td id="content" valign="top">

	<?php $ROUTER->getInclude('menu-key'); ?>
	
	<div class="left" style="margin: 10px 5px;">	
									
		<form action="" method="post">
		<input type="hidden" name="command" value="addkey-string" />
		<input type="hidden" name="type" value="string" />			
		<div id="widget_1" class="widget">
			<div class="widget_title">Add Key String</div>
			<table>
				<tr>
				<td width="100"><strong>Key: &nbsp;</strong></td>
				<td><input type="text" name="key" maxlength="30" width="20" /></td>
				</tr>
				<tr>
				<td width="100"><strong>Value: &nbsp;</strong></td>
				<td><input type="text" name="value" width="20" /></td>
				</tr>															
			</table>
			<p><input type="submit" value="Execute" /></p>			
			<div class="clear" style="margin: 4px;"></div>
		</div>
		</form>	
	
		<br />
		
	</div>	
	<div class="clear"></div>	
	
</td>

<?php $ROUTER->getInclude('footer'); ?>