<div class="row justify-content-md-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h6><?php echo $button ?> <?= $title ?></h6>
            </div>
            <form action="<?php echo $action; ?>" method="post">
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="varchar">Nama Staff <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_staf" id="nama_staf" placeholder="Nama Staff" value="<?php echo $nama_staf; ?>" />
                            <?php echo form_error('nama_staf') ?>
                        </div>
                        <div class="form-group col">
                            <label for="int">Role <span class="text-danger">*</span></label>
                            <select class="form-control" name="role_id" id="role_id">
                                <option value="">: Pilih Role</option>
                                <?php
                                foreach ($roles as $role) {
                                    echo "<option value='$role->id'";
                                    echo $role_id == $role->id ? ' selected="selected"' : '';
                                    echo ">$role->name</option>";
                                }
                                ?>
                            </select>
                            <?php echo form_error('role_id') ?>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col">
                            <label for="varchar">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
                            <?php echo form_error('username') ?>
                        </div>
                        <div class="form-group col">
                            <label for="varchar">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
                            <?php echo form_error('password') ?>
                        </div>

                        <div class="form-group col">
                            <label for="int">Status <span class="text-danger">*</span></label>
                            <select class="form-control" name="is_active" id="is_active">
                                <option value="">: Pilih Status</option>
                                <?php
                                $arr_active = [
                                    0 => 'Not Active',
                                    1 => 'Active'
                                ];

                                foreach ($arr_active as $key => $item) {
                                    echo "<option value='$key'";
                                    echo $is_active == $key ? ' selected="selected"' : '';
                                    echo ">$item</option>";
                                }
                                ?>
                            </select>
                            <?php echo form_error('is_active') ?>
                        </div>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right"><?php echo $button ?></button>
                    <a href="<?php echo site_url('pengguna') ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>