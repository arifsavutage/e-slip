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
        <h2 style="margin-top:0px">Pengguna Read</h2>
        <table class="table">
	    <tr><td>Ip Address</td><td><?php echo $ip_address; ?></td></tr>
	    <tr><td>Is Active</td><td><?php echo $is_active; ?></td></tr>
	    <tr><td>Last Login</td><td><?php echo $last_login; ?></td></tr>
	    <tr><td>Nama Staf</td><td><?php echo $nama_staf; ?></td></tr>
	    <tr><td>Password</td><td><?php echo $password; ?></td></tr>
	    <tr><td>Role Id</td><td><?php echo $role_id; ?></td></tr>
	    <tr><td>Username</td><td><?php echo $username; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('pengguna') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>