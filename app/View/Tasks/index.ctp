

<?php echo $this->Html->link('Add Task', array('controller' => 'tasks', 'action' => 'add')); ?>


<table class="table table-striped">
	<thead>
		<tr>
			<th>Task Id</th>
			<th>Task name</th>
			<th>Name Project</th>
			<th>Content</th>
			<th>Description</th>
			<th>Status</th>
			<th>Position</th>
			<th>User assiged</th>
			<th>Time start task</th>
			<th>Time stop task</th>
		</tr>
	</thead>
	<tbody>
	  	<?php foreach ($task as $key => $value): ?>
	  		<tr>
	  		
	  			<td><?php echo $value['Task']['id'];?></td>
			    <td><?php echo $value['Task']['name'];?></td>
			    <td><?php echo $value['Task']['project_id'];?></td>
			    <td><?php echo $value['Task']['content'];?></td>
			    <td><?php echo $value['Task']['des_task'];?></td>
			    <td><?php echo h(Task::getTaskStatus($value['Task']['status']));?></td>
			    <td><?php echo h(Task::getTaskPosition($value['Task']['position']));?></td>
			    <td class="user-assige" ref="<?php echo $value['Task']['id'];?>"></td>
			    <td><?php echo $value['Task']['start_time'];?></td>
			    <td><?php echo $value['Task']['end_time'];?></td>
			    
			    <td><?php echo $this->Html->link('Edit', array('controller' => 'tasks', 'action' => 'edit',$value['Task']['id'])); ?></td>
			    <td><?php echo $this->Html->link('View', array('controller' => 'tasks', 'action' => 'view',$value['Task']['id'])); ?></td>

		  	</tr>
	    	
		<?php endforeach; ?>
	  
	</tbody>
</table>




    <div class="pagination">
        <div class="pr_paginator">
            <?php echo $this->Paginator->numbers($options = array('separator' => false)) . '  '; ?>
        </div>
    </div>
