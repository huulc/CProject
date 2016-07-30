<?php echo $this->Html->link('Add project', array('controller' => 'projects', 'action' => 'add')); ?>


<table class="table table-striped">
	<thead>
		<tr>
			<th>Project name</th>
			<th>Status</th>
			<th>Description</th>
			<th>User create</th>
		</tr>
	</thead>
	<tbody>
	  	<?php foreach ($Project as $key => $value): ?>
	  		<tr>
			    <td><?php echo $value['Project']['name'];?></td>
			    <td><?php echo h(Project::getProjectStatus($value['Project']['status']));?></td>
			    <td><?php echo $value['Project']['description'];?></td>
			    <td><?php echo $value['Project']['user_id'];?></td>
			    <td><?php echo $this->Html->link('Edit', array('controller' => 'projects', 'action' => 'edit',$value['Project']['id'])); ?></td>
		  	</tr>
		<?php endforeach; ?>	  
	</tbody>
</table>




<div class="pagination">
    <div class="pr_paginator">
        <?php echo $this->Paginator->numbers($options = array('separator' => false)) . '  '; ?>
    </div>
</div>