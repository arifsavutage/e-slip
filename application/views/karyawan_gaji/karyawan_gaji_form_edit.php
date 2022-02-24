<div class="row justify-content-md-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h6><?php echo $button ?> <?= $title ?></h6>
            </div>
            <form action="<?php echo $action; ?>" method="post">
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="int">Karyawan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_kary" id="nama_kary" placeholder="Nama Karyawan" value="<?= set_value('nama_kary', $staff->nama_lengkap) ?>" readonly="true" />
                            <input type="hidden" name="karyawan_id" id="karyawan_id" value="<?php echo $staff->id; ?>" />
                            <?php echo form_error('karyawan_id') ?>
                            <?php echo form_error('nama_kary') ?>
                        </div>
                        <div class="form-group col-md-7">
                            <label for="int">Perusahaan <label class="text-danger"></label></label>
                            <input type="text" class="form-control" name="perusahaan" id="perusahaan" placeholder="Nama Perusahaan" value="<?= set_value('perusahaan', $staff->nama) ?>" readonly="true" />
                            <?php echo form_error('perusahaan') ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="bg-primary p-2 text-light mb-4">
                                <h6>Gaji & Tunjangan</h6>
                            </div>
                            <?php
                            foreach ($variables as $var) :
                                if ($var->posisi == 1) :
                            ?>
                                    <div class="form-group">
                                        <label for="int"><?= $var->nama_variabel ?></label>
                                        <input type="text" class="form-control" name="tunjangan_value[]" id="tunjangan_value" value="<?= $var->nominal ?>" required="required" />
                                        <input type="hidden" name="tunjangan_id[]" value="<?= $var->variabel_id ?>" />
                                    </div>
                            <?php
                                endif;
                            endforeach;
                            ?>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-warning p-2 mb-4">
                                <h6>Potongan</h6>
                            </div>
                            <?php
                            foreach ($variables as $var) :
                                if ($var->posisi == 2) :
                            ?>
                                    <div class="form-group">
                                        <label for="int"><?= $var->nama_variabel ?></label>
                                        <input type="text" class="form-control" name="pot_value[]" value="<?= $var->nominal ?>" required="required" />
                                        <input type="hidden" name="pot_id[]" value="<?= $var->variabel_id ?>" />
                                    </div>
                            <?php
                                endif;
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right"><?php echo $button ?></button>
                    <a href="<?php echo site_url('karyawan') ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>