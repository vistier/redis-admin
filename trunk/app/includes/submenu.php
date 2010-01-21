	<div id="submenu">
		<a class="<?php if($VARS['uri'][1]=="keys") echo "odd"; ?>" 
		href="<?php echo $LINK->getLink('keys'); ?>">Show Keys</a>
		
		<a class="<?php if($VARS['uri'][1]=="create-key") echo "odd"; ?>" 
		href="<?php echo $LINK->getLink('create-key'); ?>">Create Key</a>
		
		<a class="<?php if($VARS['uri'][1]=="create-list") echo "odd"; ?>" 
		href="<?php echo $LINK->getLink('create-list'); ?>">Create List</a>
		
		<a class="<?php if($VARS['uri'][1]=="create-set") echo "odd"; ?>" 
		href="<?php echo $LINK->getLink('create-set'); ?>">Create Set</a>	
						
		<a class="<?php if($VARS['uri'][1]=="command") echo "odd"; ?>" 
		href="<?php echo $LINK->getLink('command'); ?>">Command</a>
	</div>