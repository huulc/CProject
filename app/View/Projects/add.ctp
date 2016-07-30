<div class="Users form">
    <h3>Add Project</h3>
    <?php
    echo $this->Form->create('Project');
    echo $this->Form->input('status',array('class'=>'form-control','type' => 'select', 'options' => $arrStatusP));
    echo $this->Form->input('name',array('class'=>'form-control'));
    echo $this->Form->input('description',array('class'=>'form-control ckeditor'));
    ?>
    <div class="checkbox">
        <?php echo $this->Form->input('published',array('class'=>'checkbox','type' => 'checkbox'));?>
    </div>
    <?php echo $this->Form->input('id', array('type' => 'hidden'));?>
    <br />
    <br />
    <br />
    <?php echo $this->Form->end('Save'); ?>
</div>