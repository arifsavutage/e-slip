<h2 style="margin-top:0px"><?= $title ?></h2>
<div class="row" style="margin-bottom: 10px">
    <div class="col-md-4">
        <?php echo $permission[0]['C'] == 'yes' ? anchor(site_url('pengajuan_gaji/create'), 'Create', 'class="btn btn-primary mr-1"') : ''; ?>
        <?php echo $permission[1]['R'] == 'yes' ? anchor(site_url('pengajuan_gaji/excel'), 'Excel', 'class="btn btn-success"') : ''; ?>
    </div>
    <div class="col-md-4 text-center">
        <div style="margin-top: 8px" id="message">
            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
        </div>
    </div>
    <div class="col-md-1 text-right">
    </div>
    <div class="col-md-3 text-right">
        <form action="<?php echo site_url('pengajuan_gaji/index'); ?>" class="form-inline" method="get">
            <div class="input-group">
                <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                <span class="input-group-btn">
                    <?php
                    if ($q <> '') {
                    ?>
                        <a href="<?php echo site_url('pengajuan_gaji'); ?>" class="btn btn-danger">Reset</a>
                    <?php
                    }
                    ?>
                    <button class="btn btn-dark" type="submit">Search</button>
                </span>
            </div>
        </form>
    </div>
</div>
<table class="table table-bordered" style="margin-bottom: 10px">
    <tr>
        <th>No</th>
        <th>Periode Gaji</th>
        <th>Action</th>
    </tr><?php
            foreach ($pengajuan_gaji_data as $pengajuan_gaji) {
            ?>
        <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td><?php echo date('d/m/Y', strtotime($pengajuan_gaji->periode)) ?></td>
            <td style="text-align:center" width="250px">
                <?php
                echo $permission[1]['R'] == 'yes' ? anchor(site_url('pengajuan_gaji/read/' . $pengajuan_gaji->periode), '<i class="fas fa-eye mr-1"></i>Detail', ['class' => 'btn btn-sm btn-info mr-1']) : '';
                echo $permission[2]['U'] == 'yes' ? anchor(site_url('pengajuan_gaji/update/' . $pengajuan_gaji->periode), '<i class="fas fa-edit mr-1"></i>Edit', ['class' => 'btn btn-sm btn-warning mr-1']) : '';
                echo $permission[3]['D'] == 'yes' ? anchor(site_url('pengajuan_gaji/delete/' . $pengajuan_gaji->periode), '<i class="fas fa-trash mr-1"></i>Hapus', ['class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are You Sure ?')"]) : '';
                ?>
            </td>
        </tr>
    <?php
            }
    ?>
</table>
<div class="row">
    <div class="col-md-6">
        <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
    </div>
    <div class="col-md-6 text-right">
        <?php echo $pagination ?>
    </div>
</div>