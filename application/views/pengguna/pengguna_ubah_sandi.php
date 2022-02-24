<div class="row justify-content-md-center">
    <div class="col-md-8">
        <div class="card">
            <form name="ubahpass" method="post" action="">
                <div class="card-body">
                    <?php
                    if ($this->session->flashdata('message')) {
                        echo $this->session->flashdata('message');
                    }
                    ?>
                    <div class="form-group">
                        <label for="oldpass">Sandi Lama <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="oldpass" id="oldpass" value="" placeholder="Sandi Lama">
                        <?= form_error('oldpass'); ?>
                    </div>
                    <div class="form-group">
                        <label for="newpass">Sandi Baru <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="newpass" name="newpass" placeholder="Sandi Baru">
                        <?= form_error('newpass'); ?>
                    </div>
                    <div class="form-group">
                        <label for="repeatpass">Ulangi Sandi Baru <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="repeatpass" name="repeatpass" placeholder="Ulangi Sandi Baru">
                        <?= form_error('repeatpass'); ?>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?= base_url() ?>" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary float-right">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>