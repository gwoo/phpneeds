<h2>
	<?=$this->title("Ideas")?>
	<em><?=$this->html->link('(add one)', array('Ideas::add'));?></em>
</h2>
<div id="latest-ideas" class="list">
<h3>Latest</h3>
<?php
if (!empty($latest)) :
	foreach ($latest as $idea) :
		
		$up = $this->html->link("∆", 
			array('Ideas::vote', 'id' => $idea->_id), 
			array('title' => 'upvote', 'class' => 'button')
		);
		echo "<li>{$up}<span class='button'>{$h($idea->score)}</span> {$h($idea->summary)}</li>";

	endforeach;
endif;
?>
</div>

<div id="popular-ideas" class="list">
<h3>Popular</h3>
<ul>
<?php
if (!empty($popular)) :
	foreach ($popular as $idea) :

		$up = $this->html->link("∆", 
			array('Ideas::vote', 'id' => $idea->_id), 
			array('title' => 'upvote', 'class' => 'button')
		);
		echo "<li>{$up}<span class='button'>{$h($idea->score)}</span> {$h($idea->summary)}</li>";

	endforeach;
endif;
?>
</ul>
</div>
