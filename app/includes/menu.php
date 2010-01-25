<div>
	<h1>Schemas</h1>
	<ul>

		<li>
		<a href="<?php echo $LINK->getLink('keys'); ?>?db=15" title="db15">
		<?php echo '15, '.$DB->getSingleKeyValue(15, 'schema:sid:15'); ?></a>
		</li>		
		
		<?php $res = $DB->getSchemas(); 
			  for($x=0; $x<$res['count']; $x++){ 
		 	  $schema_name = explode(':', $res['keys'][$x]); ?>
		
			<?php if( $schema_name[2] != 15 ) { ?>
			<li>
				<?php if($schema_name[2]==$_SESSION['REDIS']['DATABASE']) {?><strong><?php } ?>
				<a href="<?php echo $LINK->getLink('keys'); ?>?db=<?php echo $schema_name[2]; ?>" title="db<?php echo $schema_name[2]; ?>">
				<?php if(!empty($res['keys'][$x])) {?>
				<?php $DB->select_db(15); ?>
				<?php echo $schema_name[2].', '.$DB->getSingleKeyValue(15, $res['keys'][$x]); ?>
				<?php } ?>
				</a>
				<?php if($schema_name[2]==$_SESSION['REDIS']['DATABASE']) {?></strong><?php } ?>
			</li>		
			<?php } ?>
			
		<?php } ?>
	</ul>
</div>
