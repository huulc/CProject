<div class="Users form">
    <h3>Add Task</h3>
    <?php 
    echo $this->Form->create('Task');
    echo $this->Form->input('project_id',array('class'=>'form-control','label'=> 'Project id', 'options' => $lisProject));
    echo $this->Form->input('user_id',array('class'=>'form-control','type' => 'number','label'=> 'User id'));
    echo $this->Form->input('name',array('class'=>'form-control'));
    echo $this->Form->input('content',array('class'=>'form-control'));
    echo $this->Form->input('des_task',array('class'=>'form-control'));
    echo $this->Form->input('status',array('class'=>'form-control', 'options' => $arrStatusT));
    echo $this->Form->input('position',array('class'=>'form-control', 'options' => $arrPositionT));
    ?>
    <div class="form-group">
        <div class="input-append date controls" id="dp_start">
            <?php echo $this->Form->input('start_time',array('type'=>'text','class'=>'form-control'));?>
            <span class="add-on"><i class="icon-calendar"></i></span>
        </div>
    </div>

    <div class="form-group">
        <div class="input-append date controls" id="dp_end">
            <?php echo $this->Form->input('end_time',array('type'=>'text','class'=>'form-control'));?>
            <span class="add-on"><i class="icon-calendar"></i></span>
        </div>
    </div>
    <?php

    echo $this->Form->input('id', array('type' => 'hidden'));
    
    echo $this->Form->end('Save');
    ?>
</div>