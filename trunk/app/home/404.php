<?php header("http/1.0 404 not found"); ?>
<?php $VARS['meta_title'] = "404 Not Found"; ?>
<?php $VARS['header'] = true; ?>
<?php $ROUTER->getInclude('header'); ?>
<div style="margin: 10px auto; width: 400px;"><img src="<?php echo $LINK->getLink('logo-b'); ?>" /></div>
<?php $ROUTER->getInclude('footer'); ?>