<?php
	/* verify session */
	$ROUTER->getSecurity($LINK->getLink('logout'));
	
	/* return requests */
	$get = $DB->Request('get');
	$post = $DB->Request('post');
	
	/* define pattern to get keys */
	if(empty($get['pattern'])){
		$pattern	=	"all";
	}elseif(!empty($get['pattern'])){
	 	$pattern	=	$get['pattern']."*";
	}
	
	/* search keys */
	if($post['command']=='search_key' AND !empty($post['pattern'])){
		$pattern	= $post['pattern'];		 	
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
<?php $VARS['meta_title'] 	= "Show Keys"; ?>
<?php $VARS['header'] 		= true; ?>
<?php $VARS['menu'] 		= true; ?>
<?php $ROUTER->getInclude('header'); ?>

<td id="content" valign="top">

	<div class="widget_title"><?php echo $_SESSION['REDIS']['DATABASE']; ?>, <?php echo $DB->getSingleKeyValue(15, "schema:sid:".$_SESSION['REDIS']['DATABASE']); ?></div>
		
	<?php $ROUTER->getInclude('menu-key'); ?>
	
	<div class="left" style="margin: 0 5px;">	
									
		<form action="" method="post" name="form">
		<input type="hidden" name="command" id="command" value="" />
		
		<div id="search">
			Search: &nbsp;
			<input type="text" name="pattern" size="20" value="<?php echo $post['pattern']; ?>" />
			<input type="submit" onclick="SubmitForm('form', false, 'search_key');" title="Type a KEY to Search" value="SEARCH" /> &nbsp;	
			<span class="info">* wildcard</span>
		</div>
		
		<table id="table" width="100%">
		<tr><td colspan="4"><strong>Keys</strong></td></tr>
		<tr>
			<td width="30"></td>
			<td class="bold">Name</td>
			<td align="center" class="bold">Type</td>
			<td align="center" class="bold">Values</td>									
		</tr>		
		<?php
				$res = $DB->getSchemaKeys($pattern); 
				for($x=0; $x<$res['count']; $x++){ ?>
			<tr>
				<td align="center">
					<input <?php if($_SESSION['REDIS']['DATABASE']==15) echo 'disabled'; ?> type="checkbox" name="chk[]" value="<?php echo $res['keys'][$x]; ?>" />
				</td>			
				<td>
					<a href="<?php echo $LINK->getLink('values'); ?>?key=<?php echo $res['keys'][$x]; ?>" title="Show values from key <?php echo $res['keys'][$x]; ?>"><?php echo $res['keys'][$x]; ?></a>
				</td>
				<td align="center">
					<?php if(!empty($res['keys'][$x])){ ?>
					<?php echo $DB->type($res['keys'][$x]); ?>
					<?php } ?>				
				</td>				
				<td align="center">
					<?php if(!empty($res['keys'][$x])){ ?>
					<?php echo $DB->getNumElements($res['keys'][$x]); ?>
					<?php } ?>
				</td>					
			</tr>			
		<?php } ?>
		<tr><td colspan="4">
			<span class="left">
			<a href="#" onclick="SetAllCheckBoxes('form', 'chk[]', true); return false; ">Check all</a></span>
			&nbsp;&nbsp;			
			<span class="right">			
			<a href="#" onclick="SetAllCheckBoxes('form', 'chk[]', false); return false; ">Uncheck all</a></span>
			<span class="clear"></span>			
		</td></tr>
		</table>

		<div style="margin: 5px 2px;">	
			<input type="submit" onclick="SubmitForm('form', 'DEL KEYS? There is NO undo!','delete_key');" title="DEL" value="DEL" /> &nbsp; 
			Move to:&nbsp;
			<select name="db"><option value=''>--Select--</option>
			<?php $res = $DB->getSchemas(); 
				  for($x=0; $x<$res['count']; $x++){ 
		 	  	  $schema_name = explode(':', $res['keys'][$x]); ?>	
				  <?php if( $schema_name[2] != 15 ) { ?>
				  <option <?php if($post['db']==$schema_name[2]) echo 'selected'; ?> value="<?php echo $schema_name[2]; ?>">
				  <?php if(!empty($res['keys'][$x])) {?><?php echo $DB->getSingleKeyValue(15, $res['keys'][$x]); ?><?php } ?></option><?php } ?>
				  <?php } ?>	
			</select>	
			<input type="submit" onclick="SubmitForm('form', 'MOVE KEYS?','move_key');" title="MOVE" value="MOVE" />				
		</div>
		</form>	
		
	</div>
	<div class="clear"></div>	
	
</td>

<?php $ROUTER->getInclude('footer'); ?>