<div class="row justify-content-md-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h6><?= $title ?></h6>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <td>Role Name</td>
                        <td><?php echo $name; ?></td>
                    </tr>
                    <tr>
                        <td>Crud</td>
                        <td>
                            <?php
                            $arr_crud = [1 => 'Create', 2 => 'Read', 3 => 'Update', 4 => 'Delete'];
                            $unser = unserialize($crud);
                            $i = 0;
                            foreach ($arr_crud as $key => $label) :

                                if (($crud != null) || !empty($crud)) {
                                    $badge_color = in_array($key, $unser) ? 'badge-info' : 'badge-danger';
                                    $icon = in_array($key, $unser) ? 'fas fa-check fa-fw' : 'fas fa-ban fa-fw';
                                } else {
                                    $badge_color = '';
                                    $icon = '';
                                }

                            ?>
                                <span class="badge <?= $badge_color ?> mr-1"><?= $label ?> <i class="<?= $icon ?> ml-1"></i></span>
                            <?php
                                $i++;
                            endforeach;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><a href="<?php echo site_url('role') ?>" class="btn btn-secondary">Cancel</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>