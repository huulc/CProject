

<h3>View</h3>

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
			<th>File Upload</th>
			<th>Time start task</th>
			<th>Time stop task</th>
		</tr>
	</thead>
	<tbody>
  		<tr>
  		
  			<td><?php echo $tasks['Task']['id'];?></td>
		    <td><?php echo $tasks['Task']['name'];?></td>
		    <td><?php echo $tasks['Task']['project_id'];?></td>
		    <td><?php echo $tasks['Task']['content'];?></td>
		    <td><?php echo $tasks['Task']['des_task'];?></td>
		    <td><?php echo h(Task::getTaskStatus($tasks['Task']['status']));?></td>
		    <td><?php echo h(Task::getTaskPosition($tasks['Task']['position']));?></td>
		    <td class="user-assige" ref="<?php echo $tasks['Task']['id'];?>"></td>
		    <td>
				<?php echo $this->Html->link($file['File']['name'], array('controller' => 'tasks', 'action' => 'dowload', $file['File']['id'],ADMIN_PATH)); ?>
		    </td>
		    <td><?php echo $tasks['Task']['start_time'];?></td>
		    <td><?php echo $tasks['Task']['end_time'];?></td>
		    
		    <td><?php echo $this->Html->link('Edit', array('controller' => 'tasks', 'action' => 'edit',$tasks['Task']['id'])); ?></td>

	  	</tr>	  
	</tbody>
</table>




    <div class="pagination">
        <div class="pr_paginator">
            <?php echo $this->Paginator->numbers($options = array('separator' => false)) . '  '; ?>
        </div>
    </div>