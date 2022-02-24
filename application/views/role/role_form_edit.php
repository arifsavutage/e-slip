<div class="row justify-content-md-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h6><?php echo $button ?> <?= $title ?></h6>
            </div>
            <form action="<?php echo $action; ?>" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="varchar">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" readonly="true" />
                        <?php echo form_error('name') ?>
                    </div>
                    <div class="form-group">
                        <label>Kewenangan :</label>
                        <br />
                        <?php
                        $arr_crud = [1 => 'Create', 2 => 'Read', 3 => 'Update', 4 => 'Delete'];
                        $unserialize = unserialize($crud);
                        //print_r(var_dump($unserialize));

                        $i = 0;
                        foreach ($arr_crud as $key => $label) :

                            if (($crud != null) || !empty($crud)) {
                                $checked = in_array($key, $unserialize) ? "checked" : "";
                            } else {
                                $checked = '';
                            }

                        ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="crud[]" value="<?= $key ?>" <?= $checked ?> />
                                <label class="form-check-label"><?= $label ?></label>
                            </div>
                        <?php
                            $i++;
                        endforeach;
                        ?>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right"><?php echo $button ?></button>
                    <a href="<?php echo site_url('role') ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>