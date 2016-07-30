<table class="table table-striped">
	<thead>
		<tr>
			<th>Users name</th>
			<th>Full name</th>
			<th>Email</th>
		</tr>
	</thead>
	<tbody>
  		<tr>
		    <td><?php echo $user['User']['username'];?></td>
		    <td><?php echo $user['User']['name'];?></td>
		    <td><?php echo $user['User']['email'];?></td>
		    <td><?php echo $this->Html->link('Edit', array('controller' => 'users', 'action' => 'edit',$user['User']['id'])); ?></td>
	  	</tr>	  
	</tbody>
</table>

<div class="pagination">
    <div class="pr_paginator">
        <?php echo $this->Paginator->numbers($options = array('separator' => false)) . '  '; ?>
    </div>
</div>