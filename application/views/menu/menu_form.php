<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Menu <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Icon <?php echo form_error('icon') ?></label>
            <input type="text" class="form-control" name="icon" id="icon" placeholder="Icon" value="<?php echo $icon; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Link <?php echo form_error('link') ?></label>
            <input type="text" class="form-control" name="link" id="link" placeholder="Link" value="<?php echo $link; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Menu Title <?php echo form_error('menu_title') ?></label>
            <input type="text" class="form-control" name="menu_title" id="menu_title" placeholder="Menu Title" value="<?php echo $menu_title; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Parent Id <?php echo form_error('parent_id') ?></label>
            <input type="text" class="form-control" name="parent_id" id="parent_id" placeholder="Parent Id" value="<?php echo $parent_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Urut <?php echo form_error('urut') ?></label>
            <input type="text" class="form-control" name="urut" id="urut" placeholder="Urut" value="<?php echo $urut; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('menu') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>