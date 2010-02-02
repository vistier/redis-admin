<?php
	/* verify session */
	//$ROUTER->getSecurity($LINK->getLink('logout'));
	
	if($_POST['command']=='create_schema' AND !empty($_POST['schema'])){
	 	$post = $DB->Request('post');	
		$DB->setNewSchema($post);
		$VARS['command']="CREATE SCHEMA {$post['schema']};";
	}
?>
<?php $VARS['meta_title'] 	= "Dashboard"; ?>
<?php $VARS['header'] 		= true; ?>
<?php $VARS['menu'] 		= true; ?>
<?php $ROUTER->getInclude('header'); ?>

<td id="content" valign="top">

	<div id="column_left">
	
		<form action="" method="post">
		<input type="hidden" name="command" value="create_schema" />
		<div id="widget_1" class="widget">
			<div class="widget_title">Create New Schema</div>
			<div class="row">
				<div class="left"><strong>Schema: &nbsp;</strong></div>
				<div class="right"><span><input type="text" name="schema" maxlength="30" width="20" />
				<input type="submit" value="Create" /></div>
				<div class="clear"></div>
			</div>
			<div style="margin: 4px;"></div>
		</div>
		</form>	
	
		<br />
		
		<div id="widget_2" class="widget">
			<div class="widget_title">Uptime</div>
			<div style="padding: 5px;">
				<div class="left"><strong>Uptime in Minutes:</strong></div>
				<div class="right"><?php echo ceil(($VARS['info']['uptime_in_seconds'])/60); ?></div>
				<div class="clear"></div>
			</div>
			
			<div style="padding: 5px;">
				<div class="left"><strong>Uptime in Days:</strong></div>
				<div class="right"><?php echo $VARS['info']['uptime_in_days']; ?></div>
				<div class="clear"></div>
			</div>															
		</div>
	
		<br />
		
		<div id="widget_3" class="widget">
			<div class="widget_title">Connections</div>
			<div style="padding: 5px;">
				<div class="left"><strong>Connected Clients:</strong></div>
				<div class="right"><?php echo $VARS['info']['connected_clients']; ?></div>
				<div class="clear"></div>
			</div>
			
			<div style="padding: 5px;">
				<div class="left"><strong>Total Connections Received:</strong></div>
				<div class="right"><?php echo numformat($VARS['info']['total_connections_received']); ?></div>
				<div class="clear"></div>
			</div>																												
		</div>	
		
		<br />	
				
		<div id="widget_4" class="widget">
			<div class="widget_title">Replication</div>						
			<div style="padding: 5px;">
				<div class="left"><strong>Role:</strong></div>
				<div class="right"><?php echo $VARS['info']['role']; ?></div>
				<div class="clear"></div>
			</div>						
		
			<div style="padding: 5px;">
				<div class="left"><strong>Connect Slaves:</strong></div>
				<div class="right"><?php echo $VARS['info']['connected_slaves']; ?></div>
				<div class="clear"></div>				
			</div>
																											
		</div>
		
	</div>
	
	<div id="column_right">	
	
		<div id="widget_5" class="widget">
			<div class="widget_title">Info</div>
			<div style="padding: 5px;">
				<div class="left"><strong>Redis Version:</strong></div>
				<div class="right"><?php echo $VARS['info']['redis_version']; ?></div>
				<div class="clear"></div>
			</div>
			
			<div style="padding: 5px;">
				<div class="left"><strong>Redis Admin Version:</strong></div>
				<div class="right"><?php echo '0.0.7' ?></div>
				<div class="clear"></div>
			</div>		
	
			<div style="padding: 5px;">
				<div class="left"><strong>Arch Bits:</strong></div>
				<div class="right"><?php echo $VARS['info']['arch_bits']; ?></div>
				<div class="clear"></div>
			</div>
	
			<div style="padding: 5px;">
				<div class="left"><strong>Multiplexing API:</strong></div>
				<div class="right"><?php echo $VARS['info']['multiplexing_api']; ?></div>
				<div class="clear"></div>
			</div>																												
		</div>

		<br />	

		<div id="widget_6" class="widget">
			<div class="widget_title">Status</div>			
			<div style="padding: 5px;">
				<div class="left"><strong>Used Memory:</strong></div>
				<div class="right"><?php echo getSize($VARS['info']['used_memory']); ?></div>
				<div class="clear"></div>				
			</div>
					
			<div style="padding: 5px;">
				<div class="left"><strong>Total Commands Processed:</strong></div>
				<div class="right"><?php echo numformat($VARS['info']['total_commands_processed']); ?></div>
				<div class="clear"></div>				
			</div>																									
		</div>

		<br />	
						
		<div id="widget_7" class="widget">
			<div class="widget_title">Persistence</div>				
			<div style="padding: 5px;">
				<div class="left"><strong>Last Save Time:</strong></div>
				<div class="right"><?php echo date('Y-m-d H:i:s', $VARS['info']['last_save_time']); ?></div>
				<div class="clear"></div>				
			</div>
								
			<div style="padding: 5px;">
				<div class="left"><strong>Changes Since Last Save:</strong></div>
				<div class="right"><?php echo numformat($VARS['info']['changes_since_last_save']); ?></div>
				<div class="clear"></div>				
			</div>
	
			<div style="padding: 5px;">
				<div class="left"><strong>Bgsave in Progress:</strong></div>
				<div class="right"><?php echo $VARS['info']['bgsave_in_progress']; ?></div>
				<div class="clear"></div>				
			</div>
			
			<div style="padding: 5px;">
				<div class="left"><strong>Bgrewriteaof in Progress:</strong></div>
				<div class="right"><?php echo $VARS['info']['bgrewriteaof_in_progress']; ?></div>
				<div class="clear"></div>				
			</div>															
		</div>
				
	</div>
	<div class="clear"></div>	
	
</td>

<?php $ROUTER->getInclude('footer'); ?>