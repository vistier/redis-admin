<?php
	/* verify session */
	$ROUTER->getSecurity($LINK->getLink('logout'));
	
	/* return requests */
	$get = $DB->Request('get');
	$post = $DB->Request('post');		
	
	/* verify key exists */
	if(!empty($get['key'])){
	 	$key = $DB->getKeyExists($get['key']);
	 	if($key==0){
			header('location: '.$LINK->getLink('keys'));
			exit(0);
	 	}else{
	 		$key = $get['key']; 
		}
	}	
	
	/* define post amount */
	if(empty($post['amount'])){
		$post['amount'] = 10;
	}
	
	/* define post key as key */
	if(!empty($post['key'])){
		$key = $post['key'];	
	}
	
	/* incr keys */
	if($post['command']=="incr_key" AND !empty($key)){
		$DB->setIncr($key, 1);
		$VARS['command']="OK";
	}	
		
	/* decr keys */
	if($post['command']=="decr_key" AND !empty($key)){
		$DB->setDecr($key, 1);
		$VARS['command']="OK";
	}	
	
	/* incr or decr by keys */
	if($post['command']=="incr_decr_by" AND !empty($post['amount']) AND !empty($post['incr_decr_by']) AND !empty($key)){
		if($post['incr_decr_by']=='incr_by') $DB->setIncr($key, $post['amount']);		
		if($post['incr_decr_by']=='decr_by') $DB->setDecr($key, $post['amount']);
		$VARS['command']="OK";
	}		
		
		
	/* delete keys */
	if($post['command']=="delete_key" AND !empty($post['chk'])){
		for($x=0; $x<count($post['chk']); $x++){
			$DB->setDeleteKey($post['chk'][$x]);
		}
		$VARS['command']="OK";		
	}	
	
	/* move keys to db */
	if($post['command']=="move_key" AND !empty($post['chk']) AND !empty($post['db'])){
		for($x=0; $x<count($post['chk']); $x++){
			$DB->setMoveKey($post['chk'][$x], $post['db']);
		}
		$VARS['command']="OK";		 
	}
?>
<?php $VARS['meta_title'] 	= "Show values from ".$key; ?>
<?php $VARS['header'] 		= true; ?>
<?php $VARS['menu'] 		= true; ?>
<?php $ROUTER->getInclude('header'); ?>

<td id="content" valign="top">

	<div class="widget_title"><?php echo $_SESSION['REDIS']['DATABASE']; ?>, <?php echo $DB->getSingleKeyValue(15, "schema:sid:".$_SESSION['REDIS']['DATABASE']); ?>, <?php echo $key; ?></div>
		
	<?php $ROUTER->getInclude('menu-key'); ?>
	
	<div class="left" style="margin: 0 5px;">	
									
		<form action="" method="post" name="form">
		<input type="hidden" name="command" id="command" value="" />
		<input type="hidden" name="key" id="key" value="<?php echo $key; ?>" />
				
		<table id="table" width="100%">
		<tr><td colspan="3"><strong><?php echo $key; ?></strong></td></tr>
		<tr>
			<td width="30"></td>
			<td class="bold">Value</td>
			<td class="bold"></td>								
		</tr>		
		<?php
				$res = $DB->getKeyValue($key, 0, 10); 
				for($x=0; $x<$res['count']; $x++){ ?>
			<tr>
				<td align="center">
					<input <?php if($_SESSION['REDIS']['DATABASE']==15) echo 'disabled'; ?> type="checkbox" name="chk[]" value="<?php echo $res['keys'][$x]; ?>" />
				</td>			
				<td>
					<?php echo $res['keys'][$x]; ?>
				</td>			
				<td align="center">
					<?php if( $DB->getType($key) == 'string' AND $_SESSION['REDIS']['DATABASE']!=15){ ?>
						<a href="<?php echo $LINK->getLink('addkey-string'); ?>?key=<?php echo $key;?>&action=edit">edit</a>
					<?php } ?>
				</td>					
			</tr>			
		<?php } ?>
		<tr><td colspan="3">
			<span class="left">
			<a href="#" onclick="SetAllCheckBoxes('form', 'chk[]', true); return false; ">Check all</a></span>
			&nbsp;&nbsp;
			<span class="right">			
			<a href="#" onclick="SetAllCheckBoxes('form', 'chk[]', false); return false; ">Uncheck all</a></span>
			<span class="clear"></span>			
		</td></tr>
		</table>

		<div style="margin: 5px 2px;">	
		
			<?php if($DB->getType($key)=='string'){ ?>
			<input type="submit" onclick="SubmitForm('form', 'DEL KEY? There is NO undo!','delete_key');" title="DEL" value="DEL" />			
			<input type="submit" onclick="SubmitForm('form', 'INCR KEY?','incr_key');" title="INCR" value="INCR" />	
			<input type="submit" onclick="SubmitForm('form', 'DECR KEY?','decr_key');" title="DECR" value="DECR" />	
			&nbsp;			
									
			<select name="incr_decr_by">
			<option>--Select--</option>
			<option <?php if($post['incr_decr_by']=='incr_by') echo "selected"; ?> value="incr_by">INCR BY</option>			
			<option <?php if($post['incr_decr_by']=='decr_by') echo "selected"; ?> value="decr_by">DECR BY</option>			
			</select>
			<input type="text" name="amount" size="4" id="amount" value="<?php echo $post['amount']; ?>" />
			<input type="submit" onclick="SubmitForm('form', 'INCR OR DECR BY KEY?','incr_decr_by');" title="OK" value="OK" />			
			&nbsp;			
			
			<?php } ?>							
			
		</div>
		</form>	
		
	</div>
	<div class="clear"></div>	
	
</td>

<?php $ROUTER->getInclude('footer'); ?>