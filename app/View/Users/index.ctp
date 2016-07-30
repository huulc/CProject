<?php echo $this->Html->link('Add User', array('controller' => 'users', 'action' => 'add')); ?>


<table class="table table-striped">
	<thead>
		<tr>
			<th>Users name</th>
			<th>Full name</th>
			<th>Email</th>
		</tr>
	</thead>
	<tbody>
	  	<?php foreach ($users as $key => $value): ?>
	  		<tr>
			    <td><?php echo $value['User']['username'];?></td>
			    <td><?php echo $value['User']['name'];?></td>
			    <td><?php echo $value['User']['email'];?></td>
			    <td><?php echo $this->Html->link('Edit', array('controller' => 'users', 'action' => 'edit',$value['User']['id'])); ?></td>
			    <td><?php echo $this->Html->link('View', array('controller' => 'users', 'action' => 'view',$value['User']['id'])); ?></td>
		  	</tr>
		<?php endforeach; ?>	  
	</tbody>
</table>


<div class="pagination">
    <div class="pr_paginator">
        <?php echo $this->Paginator->numbers($options = array('separator' => false)) . '  '; ?>
    </div>
</div>