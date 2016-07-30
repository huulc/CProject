<header>
	<div class="top-header">
		<div class="row">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
					<a class="navbar-brand" href="#"></a>
				</div>
				<ul class="nav navbar-nav">
					<li><?php echo $this->Html->link('Project', array('controller' => 'projects', 'action' => 'index')); ?></li>
					<li><?php echo $this->Html->link('Task', array('controller' => 'tasks', 'action' => 'index')); ?></li>
				</ul>
				</div>
			</nav>
		</div>
	</div>
</header>