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
        <h2 style="margin-top:0px">Menu_pengguna <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="tinytext">Menu <?php echo form_error('menu') ?></label>
            <input type="text" class="form-control" name="menu" id="menu" placeholder="Menu" value="<?php echo $menu; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Role Id <?php echo form_error('role_id') ?></label>
            <input type="text" class="form-control" name="role_id" id="role_id" placeholder="Role Id" value="<?php echo $role_id; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('menu_pengguna') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>