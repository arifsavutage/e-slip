<div class="row justify-content-md-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6><?php echo $button ?> <?= $title ?></h6>
            </div>
            <form action="<?php echo $action; ?>" method="post">
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="varchar">Kode Perusahaan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="kode" id="kode" placeholder="kode perusahaan" value="<?php echo $kode; ?>" <?= $read_only ?> />
                            <?php echo form_error('kode') ?>
                        </div>

                        <div class="form-group col-md-8">
                            <label for="varchar">Nama Perusahaan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
                            <?php echo form_error('nama') ?>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right"><?php echo $button ?></button>
                    <a href="<?php echo site_url('perusahaan') ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>