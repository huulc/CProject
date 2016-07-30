<div class="users form">
<?php echo $this->Flash->render('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend>
            <?php echo __('Please enter your username and password'); ?>
        </legend>
        <?php echo $this->Form->input('username',array('class'=>'form-control'));
        echo $this->Form->input('password',array('class'=>'form-control'));
    ?>
    </fieldset>
    <br />
    <?php echo $this->Html->link('Create Account', array('controller' => 'users', 'action' => 'add')); ?>
    <br />
    <br />
<?php echo $this->Form->end(__('Login')); ?>
</div>