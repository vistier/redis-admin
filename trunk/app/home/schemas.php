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
	<input type="hidden" name="command" value="drop_schema" />
		
		<table id="table">
		<tr><td colspan="4"><strong>Schemas</strong></td></tr>
		<?php 	
				$res = $DB->getSchemas(); 
				for($x=0; $x<$res['count']; $x++){ 
		 		$schema_name = explode(':', $res['keys'][$x]); ?>
			<tr>
				<td>
					<?php if( $schema_name[2] != 15 ) { ?>
					<input type="checkbox" name="chk[]" value="<?php echo $schema_name[2]; ?>" />
					<?php }else{ ?>
					<input disabled type="checkbox" name="no-use" value="" />					
					<?php } ?>					
				</td>
				<td>db<?php echo $schema_name[2]; ?></td>				
				<td>
					<a href="<?php echo $LINK->getLink('keys'); ?>?db=<?php echo $schema_name[2]; ?>" title="db<?php echo $schema_name[2]; ?>">
					<?php if(!empty($res['keys'][$x])){ ?>
					<?php $DB->select_db(15); ?>
					<?php echo $DB->getKeyValue($res['keys'][$x]); ?><?php } ?>
					</a>
				</td>
				<td><?php echo $VARS['info']['db'.$schema_name[2]]; ?></td>					
			</tr>			
		<?php } ?>
		<tr><td colspan="4">
			<span class="left">
			<a href="#" onclick="SetAllCheckBoxes('form', 'chk[]', true); return false; ">Check all</a></span>
			<span class="right">			
			<a href="#" onclick="SetAllCheckBoxes('form', 'chk[]', false); return false; ">Uncheck all</a></span>
			<span class="clear"></span>			
		</td></tr>
		</table>

		<div style="margin: 5px 2px;">	
			<input type="image" onclick="if(confirm('DROP SCHEMA?')){return true;}else{return false;}" src="<?php echo $LINK->getLink('bt-remove'); ?>" title="DROP SCHEMA" />
		</div>
		
	</form>	
	</div>
	
	<div class="clear"></div>	
	
</td>

<?php $ROUTER->getInclude('footer'); ?>