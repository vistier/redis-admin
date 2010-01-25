<?php
	/* verify session */
	$ROUTER->getSecurity($LINK->getLink('logout'));
	
	/* get requests */
	$post = $DB->Request('post');
	$get = $DB->Request('get');
		 	
	if($post['command']=="addkey-sorted-list" AND isset($post['key']) AND isset($post['member']) AND isset($post['score']) AND !empty($post['type'])){
	 	$DB->setNewKey($post);
		header('location: '.$LINK->getLink('values').'?key='.$post['key']);
		exit(0);
	}
?>
<?php $VARS['meta_title'] 	= "Add Key Sorted List"; ?>
<?php $VARS['header'] 		= true; ?>
<?php $VARS['menu'] 		= true; ?>
<?php $ROUTER->getInclude('header'); ?>

<td id="content" valign="top">

	<div class="widget_title"><?php echo $_SESSION['REDIS']['DATABASE']; ?>, <?php echo $DB->getSingleKeyValue(15, "schema:sid:".$_SESSION['REDIS']['DATABASE']); ?></div>
		
	<?php $ROUTER->getInclude('menu-key'); ?>
	
	<div class="left" style="margin: 10px 5px;">	
									
		<form action="" method="post">
		<input type="hidden" name="command" value="addkey-sorted-list" />	
		<input type="hidden" name="type" value="zset" />				
		<div id="widget">
			<div class="widget_title">Add Key Sorted Set</div>
			<table>
				<tr>
				<td width="100"><strong>Key: &nbsp;</strong></td>
				<td><input <?php if($get['key']) echo 'readonly="readonly"'; ?> type="text" name="key" maxlength="30" width="20" value="<?php echo $get['key']; ?>" /></td>
				</tr>
				<tr>
				<td width="100"><strong>Score: &nbsp;</strong></td>
				<td><input type="text" name="score" width="20" /></td>
				</tr>				
				<tr>
				<td width="100"><strong>Member: &nbsp;</strong></td>
				<td><input type="text" name="member" width="20" /></td>
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