<?php
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

	<h1>Persistence</h1>
		
	<div class="left" style="margin: 5px;">
		<form action="" method="post" name="formSave">
		<input type="hidden" name="command" value="save" />
			<div id="widget">
				<h1>SAVE</h1>
				<p>
					<label>Save the DB on disk.</label>
					<span><input type="submit" value="Save" /></span>
				</p>
				<div style="margin: 4px;"></div>
			</div>		
		</form>	
		
		<br />

		<form action="" method="post" name="formBgsave">
		<input type="hidden" name="command" value="bgsave" />
			<div id="widget">
				<h1>BGSAVE</h1>
				<p>
					<label>Save the DB in background. &nbsp;</label>
					<span><input type="submit" value="Save" /></span>
				</p>
				<div style="margin: 4px;"></div>
			</div>		
		</form>			
	</div>
	
	<div class="clear"></div>	
	
</td>

<?php $ROUTER->getInclude('footer'); ?>