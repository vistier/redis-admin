<?php
	/* verify session */
	$ROUTER->getSecurity($LINK->getLink('logout'));
	
	if($_POST['command']=='save'){
	 	$DB->save();
		$VARS['command']="SAVE; OK;";
	}
	if($_POST['command']=='bgsave'){
	 	$DB->save(true);	 
		$VARS['command']="BGSAVE; OK;";
	}	
?>
<?php $VARS['meta_title'] 	= "Persistence"; ?>
<?php $VARS['header'] 		= true; ?>
<?php $VARS['menu'] 		= true; ?>
<?php $ROUTER->getInclude('header'); ?>

<td id="content" valign="top">

	<div class="widget_title">Persistence</div>
		
	<div class="left" style="margin: 5px;">
		<form action="" method="post" name="formSave">
		<input type="hidden" name="command" value="save" />
			<div id="widget_1" class="widget">
				<div class="widget_title">SAVE</div>
				<div class="row">
					<div class="left">Save the DB on disk.</div>
					<div class="right"><input type="submit" value="Save" /></div>
					<div class="clear"></div>
				</div>
				<div style="margin: 4px;"></div>
			</div>		
		</form>	
		
		<br />

		<form action="" method="post" name="formBgsave">
		<input type="hidden" name="command" value="bgsave" />
			<div id="widget_2" class="widget">
				<div class="widget_title">BGSAVE</div>
				<div class="row">
					<div class="left">Save the DB in background. &nbsp;</div>
					<div class="right"><input type="submit" value="Save" /></div>
					<div class="clear"></div>
				</div>
				<div style="margin: 4px;"></div>
			</div>		
		</form>			
	</div>
	
	<div class="clear"></div>	
	
</td>

<?php $ROUTER->getInclude('footer'); ?>