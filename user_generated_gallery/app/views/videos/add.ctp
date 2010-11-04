<div class="videos form">
<?php echo $this->Form->create('Video');?>
	<fieldset>
 		<legend><?php __('Add Video'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->input('approved');
		echo $this->Form->input('flagged');
		echo $this->Form->input('views');
		echo $this->Form->input('Collection');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Videos', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Collections', true), array('controller' => 'collections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Collection', true), array('controller' => 'collections', 'action' => 'add')); ?> </li>
	</ul>
</div>