<?php
$cakeDescription = 'Project';
?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $cakeDescription ?>
        <?php echo $this->fetch('title') ?>
    </title>
    <?php echo $this->Html->meta('icon') ?>
    <?php echo $this->fetch('meta') ?>
    <?php echo $this->fetch('css') ?>
    <?php echo $this->fetch('script') ?>
    <?php echo $this->Html->css('bootstrap/css/bootstrap.min.css') ?>
    <?php echo $this->Html->css('bootstrap/css/bootstrap-datetimepicker.min.css') ?>
    <?php echo $this->Html->css('style.css') ?>
    <?php echo $this->Html->css('bootstrap/css/bootstrap-datetimepicker.min.css') ?>

    <?php echo $this->Html->script('jquery-2.2.4.min.js') ?>
    <?php echo $this->Html->script('jquery-ui.js') ?>
    <?php echo $this->Html->script('bootstrap/js/bootstrap.min.js') ?>
    <?php echo $this->Html->script('bootstrap/js/bootstrap-datetimepicker.min.js') ?>
    <?php echo $this->Html->script('ckeditor/ckeditor.js') ?>
    <?php echo $this->Html->script('script.js') ?>
    <script type="text/javascript">
        var home = "<?php echo Router::url('/', true); ?>";
        console.log(home);
    </script>
    
</head>
<body>   
    <div class="main">
        <div class="col-md-12">
            <?php echo $this->element('header') ?>
            
            <?php echo $this->fetch('content') ?>
            
            <?php echo $this->element('footer') ?>
        </div>
    </div>
</body>
</html>