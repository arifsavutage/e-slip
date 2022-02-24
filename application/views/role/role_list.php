<h2 style="margin-top:0px"><?= $title ?></h2>
<div class="row" style="margin-bottom: 10px">
    <div class="col-md-4">
        <?php echo $permission[0]['C'] == 'yes' ? anchor(site_url('role/create'), 'Create', 'class="btn btn-primary"') : ''; ?>
    </div>
    <div class="col-md-4 text-center">
        <div style="margin-top: 8px" id="message">
            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
        </div>
    </div>
    <div class="col-md-1 text-right">
    </div>
    <div class="col-md-3 text-right">
        <form action="<?php echo site_url('role/index'); ?>" class="form-inline" method="get">
            <div class="input-group">
                <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                <span class="input-group-btn">
                    <?php
                    if ($q <> '') {
                    ?>
                        <a href="<?php echo site_url('role'); ?>" class="btn btn-danger">Reset</a>
                    <?php
                    }
                    ?>
                    <button class="btn btn-dark" type="submit">Search</button>
                </span>
            </div>
        </form>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-bordered" style="margin-bottom: 10px">
        <thead>
            <tr>
                <th>No</th>
                <th>Role Name</th>
                <th>Hak Akses</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($role_data as $role) {
            ?>
                <tr>
                    <td width="80px"><?php echo ++$start ?></td>
                    <td><?php echo $role->name ?></td>
                    <td>
                        <?php
                        $arr_crud = [1 => 'Create', 2 => 'Read', 3 => 'Update', 4 => 'Delete'];
                        $unser = unserialize($role->crud);
                        $i = 0;
                        foreach ($arr_crud as $key => $label) :

                            if (($role->crud != null) || !empty($role->crud)) {
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
                    <td style="text-align:center" width="300px">
                        <?php
                        echo $permission[1]['R'] == 'yes' ? anchor(site_url('role/read/' . $role->id), '<i class="fas fa-eye mr-1"></i>Detail', ['class' => 'btn btn-sm btn-info mr-1']) : '';
                        echo $permission[2]['U'] == 'yes' ? anchor(site_url('role/update/' . $role->id), '<i class="fas fa-edit mr-1"></i>Edit', ['class' => 'btn btn-sm btn-warning mr-1']) : '';
                        echo $permission[3]['D'] == 'yes' ? anchor(site_url('role/delete/' . $role->id), '<i class="fas fa-trash mr-1"></i>Hapus', ['class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are You Sure ?')"]) : '';
                        ?>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-md-6">
        <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
    </div>
    <div class="col-md-6 text-right">
        <?php echo $pagination ?>
    </div>
</div>