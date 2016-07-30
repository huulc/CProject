<header>
	<div class="top-header">
		<div class="row">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
					<a class="navbar-brand" href="#"></a>
				</div>
				<ul class="nav navbar-nav">
					<?php if($this->Session->read('Auth')) : ?>
					<li><?php echo $this->Html->link('Project', array('controller' => 'projects', 'action' => 'index')); ?></li>
					<li><?php echo $this->Html->link('Task', array('controller' => 'tasks', 'action' => 'index')); ?></li>
					<li><?php echo $this->Html->link('User', array('controller' => 'users', 'action' => 'index')); ?></li>

					<li><?php echo $this->Html->link('Logout', array('controller'=>'users', 'action'=>'logout'));  ?></li>
					<?php else: ?>
					<li><?php echo $this->Html->link('Login', array('controller'=>'users', 'action'=>'login')); ?></li>
					<?php endif; ?>
				</ul>
				</div>
			</nav>
		</div>
	</div>
</header>