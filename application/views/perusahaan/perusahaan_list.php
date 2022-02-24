<h2 style="margin-top:0px"><?= $title ?></h2>
<div class="row" style="margin-bottom: 10px">
    <div class="col-md-4">
        <?php echo $permission[0]['C'] == 'yes' ? anchor(site_url('perusahaan/create'), 'Create', 'class="btn btn-primary mr-1"') : ''; ?>
        <?php echo $permission[1]['R'] == 'yes' ? anchor(site_url('perusahaan/excel'), 'Export Excel', 'class="btn btn-success"') : ''; ?>
    </div>
    <div class="col-md-4 text-center">
        <div style="margin-top: 8px" id="message">
            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
        </div>
    </div>
    <div class="col-md-1 text-right">
    </div>
    <div class="col-md-3 text-right">
        <form action="<?php echo site_url('perusahaan/index'); ?>" class="form-inline" method="get">
            <div class="input-group">
                <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                <span class="input-group-btn">
                    <?php
                    if ($q <> '') {
                    ?>
                        <a href="<?php echo site_url('perusahaan'); ?>" class="btn btn-secondary">Reset</a>
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
                <th>Nama Perusahaan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($perusahaan_data as $perusahaan) {
            ?>
                <tr>
                    <td width="80px"><?php echo ++$start ?></td>
                    <td><?php echo $perusahaan->nama ?></td>
                    <td style="text-align:center" width="300px">
                        <?php
                        echo $permission[1]['R'] == 'yes' ? anchor(site_url('perusahaan/read/' . $perusahaan->kode), '<i class="fas fa-eye mr-1"></i>Detail', ['class' => 'btn btn-sm btn-info mr-1']) : '';
                        echo $permission[2]['U'] == 'yes' ? anchor(site_url('perusahaan/update/' . $perusahaan->kode), '<i class="fas fa-edit mr-1"></i>Edit', ['class' => 'btn btn-sm btn-warning text-white mr-1']) : '';
                        echo $permission[3]['D'] == 'yes' ? anchor(site_url('perusahaan/delete/' . $perusahaan->kode), '<i class="fas fa-trash mr-1"></i>Hapus', ['class' => 'btn btn-sm btn-danger mr-1', 'onclick' => "return confirm('Are You Sure ?')"]) : '';
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