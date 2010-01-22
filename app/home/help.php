<?php
	/* verify session */
	$ROUTER->getSecurity($LINK->getLink('logout'));
?>
<?php $VARS['meta_title'] 	= "Help"; ?>
<?php $VARS['header'] 		= true; ?>
<?php $VARS['menu'] 		= true; ?>
<?php $ROUTER->getInclude('header'); ?>

<td id="content" valign="top">

	<div class="widget_title">Help</div>
	
	<div class="left" style="margin: 5px; width: 300px;">	
									
		<form action="" method="post">
		<input type="hidden" name="command" value="create_schema" />
		<div id="widget_1" class="widget">
			<div>Not yet.</div>
		</div>
		</form>	
		
	</div>
	<div class="clear"></div>	
	
</td>

<?php $ROUTER->getInclude('footer'); ?>