<h3>Add an Idea</h3>
<?=$this->form->create($idea); ?>
	<?=$this->form->field('summary');?>
	<?=$this->form->submit('add'); ?>
<?=$this->form->end();?>
