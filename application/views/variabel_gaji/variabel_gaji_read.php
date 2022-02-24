<div class="row justify-content-md-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6><?= $title ?></h6>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <td>Nama Variabel</td>
                        <td><?php echo $nama_variabel; ?></td>
                    </tr>
                    <tr>
                        <td>Posisi</td>
                        <td><?php echo $posisi == 1 ? 'Tunjangan' : 'Potongan'; ?></td>
                    </tr>
                    <tr>
                        <td>Publik</td>
                        <td><?php echo $publik == 0 ? '<span class="badge badge-danger">Non Aktif</span>' : '<span class="badge badge-success">Aktif</span>'; ?></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td><a href="<?php echo site_url('variabel_gaji') ?>" class="btn btn-secondary">Cancel</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>