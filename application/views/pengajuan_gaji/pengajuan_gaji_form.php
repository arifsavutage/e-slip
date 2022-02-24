<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h6><?php echo $button ?> <?= $title ?></h6>
            </div>
            <form name="pengajuan" method="post" action="<?php echo $action; ?>">
                <div class="card-body">

                    <div class="alert alert-info alert-dismissible fade show mt-4 mb-4" role="alert">
                        <strong>Info : </strong><br /> Data karyawan yang tampil, merupakan karyawan yang sudah disetting gajinya.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="sr-only" for="tanggal">Periode Tanggal</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-calendar"></i></div>
                                </div>
                                <input type="text" class="form-control datepicker" id="tanggal" name="tanggal" value="<?= set_value('tanggal') ?>" placeholder="periode gaji" readonly="true">
                            </div>
                            <?php echo form_error('tanggal') ?>
                        </div>
                    </div>

                    <div class="responsive-table">
                        <table class="table table-bordered" style="font-size: 13px;">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Karyawan</th>
                                    <th>Perusahaan</th>
                                    <th>Hari Kerja</th>
                                    <th>Jml. Lembur</th>
                                    <th>Jml. Cuti</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($data_gaji as $row) {
                                    if ($row->nominal != null) :
                                ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $row->nama_lengkap ?></td>
                                            <td><?= $row->nama ?></td>
                                            <td><input type="number" name='hari_kerja[]' max="31" value="0" /></td>
                                            <td>
                                                <input type="text" name='jml_lembur[]' maxlength="4" value="0" />
                                                <input type="hidden" name="id_kry[]" value="<?= $row->id ?>" />
                                            </td>
                                            <td>
                                                <input type="number" name='jml_cuti[]' max="2" value="0" />
                                            </td>
                                        </tr>
                                <?php
                                    endif;
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right"><?php echo $button ?></button>
                    <a href="<?php echo site_url('pengajuan_gaji') ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>