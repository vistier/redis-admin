	<div id="submenu">
		<a class="<?php if($VARS['uri'][1]=="keys") echo "odd"; ?>" 
		href="<?php echo $LINK->getLink('keys'); ?>">Show Keys</a>
		
		<?php if($_SESSION['REDIS']['DATABASE'] != 15){ ?>
		<a class="<?php if($VARS['uri'][1]=="addkey-string") echo "odd"; ?>" 
		href="<?php echo $LINK->getLink('addkey-string'); ?>">Add Key String</a>
		
		<a class="<?php if($VARS['uri'][1]=="addkey-list") echo "odd"; ?>" 
		href="<?php echo $LINK->getLink('addkey-list'); ?>">Add Key List</a>
		
		<a class="<?php if($VARS['uri'][1]=="addkey-set") echo "odd"; ?>" 
		href="<?php echo $LINK->getLink('addkey-set'); ?>">Add Key Set</a>	
		<?php } ?>
		
		<a class="<?php if($VARS['uri'][1]=="command") echo "odd"; ?>" 
		href="<?php echo $LINK->getLink('command'); ?>">Command</a>
	</div>