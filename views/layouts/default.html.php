<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2010, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
?>
<!doctype html>
<html>
<head>
	<?php echo $this->html->charset();?>
	<title>PHP needs > <?php echo $this->title(); ?></title>
	<?php echo $this->html->style(array('debug', 'lithium', 'php_needs')); ?>
	<?php echo $this->scripts(); ?>
	<?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?>
</head>
<body class="app">
	<div id="container">
		<div id="header">
			<h1><?=$this->html->link('PHP Needs', array('Ideas::index'));?></h1>
			<h2>
				Powered by <?php echo $this->html->link('Lithium', 'http://lithify.me/'); ?>.
			</h2>
			<?php if (!empty($this->request()->user)):
				printf("<div id='user'>hi, %s<p>please vote</p></div>", $this->request()->user);
			endif; ?>
		</div>
		<div id="content">
			<?php echo $this->content(); ?>
		</div>
	</div>
</body>
</html>