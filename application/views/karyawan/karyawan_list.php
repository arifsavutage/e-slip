<h2 style="margin-top:0px"><?= $title ?></h2>
<div class="row" style="margin-bottom: 10px">
    <div class="col-md-4">
        <?php echo $permission[0]['C'] == 'yes' ? anchor(site_url('karyawan/create'), 'Create', 'class="btn btn-primary mr-1"') : ''; ?>
        <?php echo $permission[1]['R'] == 'yes' ? anchor(site_url('karyawan/excel'), 'Export Excel', 'class="btn btn-success"') : ''; ?>
    </div>
    <div class="col-md-4 text-center">
        <div style="margin-top: 8px" id="message">
            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
        </div>
    </div>
    <div class="col-md-1 text-right">
    </div>
    <div class="col-md-3 text-right">
        <form action="<?php echo site_url('karyawan/index'); ?>" class="form-inline" method="get">
            <div class="input-group">
                <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                <span class="input-group-btn">
                    <?php
                    if ($q <> '') {
                    ?>
                        <a href="<?php echo site_url('karyawan'); ?>" class="btn btn-secondary">Reset</a>
                    <?php
                    }
                    ?>
                    <button class="btn btn-dark" type="submit">Search</button>
                </span>
            </div>
        </form>
    </div>
</div>
<table class="table table-bordered" style="margin-bottom: 10px;font-size: 12px;">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Karyawan</th>
            <th>Perusahaan</th>
            <th>Set Gaji</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($karyawan_data as $karyawan) {
        ?>
            <tr>
                <td width="80px"><?php echo ++$start ?></td>
                <td><?php echo $karyawan->nama_lengkap ?></td>
                <td><?php echo $karyawan->nama ?></td>
                <td><?php echo $karyawan->variabel_id == null ? '<span class="badge badge-danger">Belum</span>' : '<span class="badge badge-success">Sudah</span>'; ?></td>
                <td style="text-align:center" width="350px">
                    <?php
                    if ($karyawan->variabel_id == null) {
                        echo $permission[0]['C'] == 'yes' ? anchor(site_url('karyawan_gaji/create/' . $karyawan->id), '<i class="fas fa-money-bill-alt mr-1"></i>Set Gaji', ['class' => 'btn btn-sm btn-secondary mr-1']) : '';
                    } else {
                        echo $permission[0]['C'] == 'yes' ? anchor(site_url('karyawan_gaji/update/' . $karyawan->id), '<i class="fas fa-money-bill-alt mr-1"></i>Ubah Gaji', ['class' => 'btn btn-sm btn-secondary mr-1']) : '';
                    }

                    echo $permission[1]['R'] == 'yes' ? anchor(site_url('karyawan/read/' . $karyawan->id), '<i class="fas fa-eye mr-1"></i>Detail', ['class' => 'btn btn-sm btn-info mr-1']) : '';
                    echo $permission[2]['U'] == 'yes' ? anchor(site_url('karyawan/update/' . $karyawan->id), '<i class="fas fa-edit mr-1"></i>Edit', ['class' => 'btn btn-sm btn-warning mr-1']) : '';
                    echo $permission[3]['D'] == 'yes' ? anchor(site_url('karyawan/delete/' . $karyawan->id), '<i class="fas fa-trash mr-1"></i>Hapus', ['class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are You Sure ?')"]) : '';
                    ?>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<div class="row">
    <div class="col-md-6">
        <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
    </div>
    <div class="col-md-6 text-right">
        <?php echo $pagination ?>
    </div>
</div>