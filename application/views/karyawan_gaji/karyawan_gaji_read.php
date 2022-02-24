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
        <h2 style="margin-top:0px">Karyawan_gaji Read</h2>
        <table class="table">
	    <tr><td>Created</td><td><?php echo $created; ?></td></tr>
	    <tr><td>Karyawan Id</td><td><?php echo $karyawan_id; ?></td></tr>
	    <tr><td>Updated</td><td><?php echo $updated; ?></td></tr>
	    <tr><td>User</td><td><?php echo $user; ?></td></tr>
	    <tr><td>Variabel Id</td><td><?php echo $variabel_id; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('karyawan_gaji') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>