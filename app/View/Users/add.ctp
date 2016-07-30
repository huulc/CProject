<div class="Users form">
    <div class="users form">
        <?php echo $this->Form->create('User'); ?>
            <fieldset>
                <legend><?php echo __('Add User'); ?></legend>
                <?php echo $this->Form->input('username',array('class'=>'form-control'));
                echo $this->Form->input('password',array('class'=>'form-control'));
                echo $this->Form->input('name',array('class'=>'form-control', 'label' => 'Full name'));
                echo $this->Form->input('email',array('class'=>'form-control', 'label' => 'Email'));
            ?>
            </fieldset>
            <br />
            <?php if(!$this->Session->read('Auth')) : ?>
                <?php echo $this->Html->link('Login Account', array('controller' => 'users', 'action' => 'login')); ?>
            <?php endif; ?>
            <br />
            <br />
        <?php echo $this->Form->end(__('Submit')); ?>
    </div>
</div>

