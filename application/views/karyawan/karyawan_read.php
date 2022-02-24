<div class="row justify-content-md-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h6><?= $title ?></h6>
            </div>
            <div class="card-body">
                <table class="table">

                    <tr>
                        <td>Nama Lengkap</td>
                        <td><?php echo $nama_lengkap; ?></td>
                    </tr>
                    <tr>
                        <td>Perusahaan</td>
                        <td><?php echo $kode_pt; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><a href="<?php echo site_url('karyawan') ?>" class="btn btn-secondary">Cancel</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>