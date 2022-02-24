<div class="row justify-content-md-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h6><?php echo $button ?> <?= $title ?></h6>
            </div>
            <form action="<?php echo $action; ?>" method="post">
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-7">
                            <label for="varchar">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" value="<?php echo $nama_lengkap; ?>" />
                            <?php echo form_error('nama_lengkap') ?>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="varchar">Perusahaan <span class="text-danger">*</span></label>
                            <select class="form-control" name="kode_pt" id="kode_pt">
                                <option value="">: Pilih Perusahaan</option>
                                <?php
                                foreach ($perusahaan as $row) {
                                    echo "<option value='$row->kode'";
                                    echo $row->kode == $kode_pt ? ' selected="selected"' : '';
                                    echo ">$row->nama</option>";
                                }
                                ?>
                            </select>
                            <?php echo form_error('kode_pt') ?>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right"><?php echo $button ?></button>
                    <a href="<?php echo site_url('karyawan') ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>