<div class="row justify-content-md-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6><?= $title ?></h6>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <td>Nama Perusahaan</td>
                        <td><?php echo $nama; ?></td>
                    </tr>
                    <tr>
                        <td>Created</td>
                        <td><?php echo $created; ?></td>
                    </tr>
                    <tr>
                        <td>Updated</td>
                        <td><?php echo $updated; ?></td>
                    </tr>
                    <tr>
                        <td>User</td>
                        <td><?php echo $user; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><a href="<?php echo site_url('perusahaan') ?>" class="btn btn-secondary">Cancel</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>