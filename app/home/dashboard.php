<?php
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

	<div class="left" style="margin: 5px;">
	
		<form action="" method="post">
		<input type="hidden" name="command" value="create_schema" />
		<div id="widget">
			<h1>Create New Schema</h1>
			<p>
				<label><strong>Schema: &nbsp;</strong></label>
				<span><input type="text" name="schema" maxlength="30" width="20" />
				<input type="submit" value="Create" /></span>
			</p>
			<div style="margin: 4px;"></div>
		</div>
		</form>	
	
		<br />
		
		<div id="widget">
			<h1>Uptime</h1>
			<p style="padding: 5px;">
				<label><strong>Uptime in Minutes:</strong></label>
				<span><?php echo ceil(($VARS['info']['uptime_in_seconds'])/60); ?></span>
			</p>
			
			<p style="padding: 5px;">
				<label><strong>Uptime in Days:</strong></label>
				<span><?php echo $VARS['info']['uptime_in_days']; ?></span>
			</p>															
		</div>
	
		<br />
		
		<div id="widget">
			<h1>Connections</h1>
			<p style="padding: 5px;">
				<label><strong>Connected Clients:</strong></label>
				<span><?php echo $VARS['info']['connected_clients']; ?></span>
			</p>

			
			<p style="padding: 5px;">
				<label><strong>Total Connections Received:</strong></label>
				<span><?php echo numformat($VARS['info']['total_connections_received']); ?></span>
			</p>
																												
		</div>	
		
		<br />	
				
		<div id="widget">
			<h1>Replication</h1>
						
			<p style="padding: 5px;">
				<label><strong>Role:</strong></label>
				<span><?php echo $VARS['info']['role']; ?></span>
			</p>						
		
			<p style="padding: 5px;">
				<label><strong>Connect Slaves:</strong></label>
				<span><?php echo $VARS['info']['connected_slaves']; ?></span>
			</p>
																											
		</div>
		
	</div>
	
	<div class="left" style="margin: 5px; width: 300px;">	
		<div id="widget">
			<h1>Info</h1>
			<p style="padding: 5px;">
				<label><strong>Redis Version:</strong></label>
				<span><?php echo $VARS['info']['redis_version']; ?></span>
			</p>
			
			<p style="padding: 5px;">
				<label><strong>Redis Admin Version:</strong></label>
				<span><?php echo '0.0.2' ?></span>
			</p>		
	
			<p style="padding: 5px;">
				<label><strong>Arch Bits:</strong></label>
				<span><?php echo $VARS['info']['arch_bits']; ?></span>
			</p>
	
			<p style="padding: 5px;">
				<label><strong>Multiplexing API:</strong></label>
				<span><?php echo $VARS['info']['multiplexing_api']; ?></span>
			</p>
																												
		</div>

		<br />	

		<div id="widget">
			<h1>Status</h1>			
			<p style="padding: 5px;">
				<label><strong>Used Memory:</strong></label>
				<span><?php echo getSize($VARS['info']['used_memory']); ?></span>
			</p>
					
			<p style="padding: 5px;">
				<label><strong>Total Commands Processed:</strong></label>
				<span><?php echo numformat($VARS['info']['total_commands_processed']); ?></span>
			</p>
																									
		</div>

		<br />	
						
		<div id="widget">
			<h1>Persistence</h1>	
			
			<p style="padding: 5px;">
				<label><strong>Last Save Time:</strong></label>
				<span><?php echo date('Y-m-d H:i:s', $VARS['info']['last_save_time']); ?></span>
			</p>
								
			<p style="padding: 5px;">
				<label><strong>Changes Since Last Save:</strong></label>
				<span><?php echo numformat($VARS['info']['changes_since_last_save']); ?></span>
			</p>
	
			<p style="padding: 5px;">
				<label><strong>Bgsave in Progress:</strong></label>
				<span><?php echo $VARS['info']['bgsave_in_progress']; ?></span>
			</p>
			
			<p style="padding: 5px;">
				<label><strong>Bgrewriteaof in Progress:</strong></label>
				<span><?php echo $VARS['info']['bgrewriteaof_in_progress']; ?></span>
			</p>
																					
		</div>
				
		
	</div>
	
	<div class="clear"></div>	
	
</td>

<?php $ROUTER->getInclude('footer'); ?>