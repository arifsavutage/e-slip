<div class="row justify-content-md-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6><?php echo $button ?> <?= $title ?></h6>
            </div>
            <form action="<?php echo $action; ?>" method="post">
                <div class="card-body">

                    <div class="form-group">
                        <label for="varchar">Nama Variabel <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama_variabel" id="nama_variabel" placeholder="Nama Variabel" value="<?php echo $nama_variabel; ?>" />
                        <?php echo form_error('nama_variabel') ?>
                    </div>

                    <div class="form-row">
                        <div class="form-group col">
                            <label for="int">Posisi Variabel <span class="text-danger">*</span></label>
                            <select class="form-control" name="posisi" id="posisi">
                                <option value="">: Pilih Posisi</option>
                                <?php
                                $pos_arr = [
                                    1 => 'Tunjangan',
                                    2 => 'Potongan'
                                ];
                                foreach ($pos_arr as $key => $label) {
                                    echo "<option value='$key'";
                                    echo $posisi == $key ? ' selected="selected"' : '';
                                    echo ">$label</option>";
                                }
                                ?>
                            </select>
                            <?php echo form_error('posisi') ?>
                        </div>
                        <div class="form-group col">
                            <label for="int">Publikasi <span class="text-danger">*</span></label>
                            <select class="form-control" name="publik" id="publik">
                                <option value="">: Pilih Publikasi</option>
                                <?php
                                $pub_arr = [
                                    0 => 'Non Aktif',
                                    1 => 'Aktif'
                                ];

                                foreach ($pub_arr as $x => $y) {
                                    echo "<option value='$x'";
                                    echo $x == $publik ? ' selected="selected"' : '';
                                    echo ">$y</option>";
                                }
                                ?>
                            </select>
                            <?php echo form_error('publik') ?>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right"><?php echo $button ?></button>
                    <a href="<?php echo site_url('variabel_gaji') ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>