<?php
	/* verify session */
	$ROUTER->getSecurity($LINK->getLink('logout'));
	
	if($_POST['command']=='drop_schema' AND !empty($_POST['chk'])){
	 	$post = $DB->Request('post');	
		for($x=0; $x<count($post['chk']); $x++){
			$DB->setDropSchema($post['chk'][$x]);
		}
		$VARS['command']="OK";
	}
?>
<?php $VARS['meta_title'] 	= "Schemas"; ?>
<?php $VARS['header'] 		= true; ?>
<?php $VARS['menu'] 		= true; ?>
<?php $ROUTER->getInclude('header'); ?>

<td id="content" valign="top">

	<div class="widget_title">Schemas</div>
		
	<div class="left" style="margin: 5px;">
	<form action="" method="post" name="form">
	<input type="hidden" name="command" id="command" value="" />
		
		<table id="table">
		<tr><td colspan="5"><strong>Schemas</strong></td></tr>
		
		<tr>
		<td width="30"></td>
		<td align="center"><strong>Instance</strong></td>
		<td><strong>Alias</strong></td>
		<td align="center"><strong>Size</strong></td>	
		<td align="center"><strong>Expire</strong></td>					
		</tr>
		
			<?php
				/* get schemas */ 	
				$res = $DB->getSchemas(); 
				for($x=0; $x<$res['count']; $x++){ 
				
					/* make schema data */ 
		 			$schema_name 	= explode(':', $res['keys'][$x]); 
					$schema_value	= explode(',',$VARS['info']['db'.$schema_name[2]]);
					$schema_size	= str_replace('keys=','', $schema_value[0]);
					$schema_expires	= str_replace('expires=','', $schema_value[1]);					
			?>
			<tr>
				<td align="center">
					<?php if( $schema_name[2] != 15 ) { ?>
					<input type="checkbox" name="chk[]" value="<?php echo $schema_name[2]; ?>" />
					<?php }else{ ?>
					<input disabled type="checkbox" name="no-use" value="" />					
					<?php } ?>					
				</td>
				<td align="center">db<?php echo $schema_name[2]; ?></td>				
				<td>
					<a href="<?php echo $LINK->getLink('keys'); ?>?db=<?php echo $schema_name[2]; ?>" title="db<?php echo $schema_name[2]; ?>">
					<?php if(!empty($res['keys'][$x])){ ?>
					<?php echo $DB->getSingleKeyValue(15, $res['keys'][$x]); ?><?php } ?>
					</a>
				</td>
				<td align="center"><?php echo $schema_size; ?></td>					
				<td align="center"><?php echo $schema_expires; ?></td>									
			</tr>			
		<?php } ?>
		<tr><td colspan="5">
			<span class="left">
			<a href="#" onclick="SetAllCheckBoxes('form', 'chk[]', true); return false; ">Check all</a></span>
			&nbsp;&nbsp;			
			<span class="right">			
			<a href="#" onclick="SetAllCheckBoxes('form', 'chk[]', false); return false; ">Uncheck all</a></span>
			<span class="clear"></span>			
		</td></tr>
		</table>

		<div style="margin: 5px 2px;">	
			<input type="submit" onclick="SubmitForm('form', 'FLUSHDB? There is NO undo!','drop_schema');" title="FLUSHDB" value="FLUSHDB" />
		</div>
		
	</form>	
	</div>
	
	<div class="clear"></div>	
	
</td>

<?php $ROUTER->getInclude('footer'); ?>