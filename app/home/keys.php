<?php
	$get = $DB->Request('get');
	if(empty($get['pattern'])){
		$pattern	=	"all";
	}elseif(!empty($get['pattern'])){
	 	$pattern	=	$get['pattern']."*";
	}
	if($_POST['command']=="delete_key" AND !empty($_POST['chk'])){
	 	$post = $DB->Request('post');	
		for($x=0; $x<count($post['chk']); $x++){
			$DB->setDeleteKey($post['chk'][$x]);
		}
		$VARS['command']="OK";		
	}	
?>
<?php $VARS['meta_title'] 	= "Show Keys"; ?>
<?php $VARS['header'] 		= true; ?>
<?php $VARS['menu'] 		= true; ?>
<?php $ROUTER->getInclude('header'); ?>

<td id="content" valign="top">

	<?php $ROUTER->getInclude('submenu'); ?>
	
	<div class="left" style="margin: 10px 5px;">	
									
		<form action="" method="post" name="form">
		<input type="hidden" name="command" value="delete_key" />
		<table id="table" width="100%">
		<tr><td colspan="4"><strong>Keys</strong></td></tr>
		<tr>
			<td></td>
			<td class="bold">Name</td>
			<td class="bold">Type</td>
			<td class="bold">Value</td>									
		</tr>		
		<?php
				$res = $DB->getSchemaKeys($pattern); 
				for($x=0; $x<$res['count']; $x++){ ?>
			<tr>
				<td>
					<input type="checkbox" name="chk[]" value="<?php echo $res['keys'][$x]; ?>" />					
				</td>			
				<td><?php echo $res['keys'][$x]; ?></td>
				<td>
					<?php if(!empty($res['keys'][$x])){ ?>
					<?php echo $DB->type($res['keys'][$x]); ?>
					<?php } ?>				
				</td>				
				<td>
					<?php if(!empty($res['keys'][$x])){ ?>
					<?php echo $DB->getKeyValue($res['keys'][$x]); ?>
					<?php } ?>
				</td>					
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
			<input type="image" onclick="if(confirm('DELETE KEY?')){return true;}else{return false;}" src="<?php echo $LINK->getLink('bt-remove'); ?>" title="DELETE KEY" />
		</div>
		</form>	
		
	</div>
	<div class="clear"></div>	
	
</td>

<?php $ROUTER->getInclude('footer'); ?>