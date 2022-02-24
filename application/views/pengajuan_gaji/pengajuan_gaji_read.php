<h2 style="margin-top:0px"><?= $title ?> <?= date('d M Y', strtotime($period)) ?></h2>
<div class="row" style="margin-bottom: 10px">
    <div class="col-md-12">
        <a href="<?php echo site_url('pengajuan_gaji') ?>" class="btn btn-secondary float-right">Cancel</a>
        <?php //echo anchor(site_url('pengajuan_gaji/excel'), 'Excel', 'class="btn btn-success"'); 
        ?>
    </div>
</div>


<div class="table-responsive mt-1 mb-2">
    <table class="table table-bordered ex-data-tables">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Lengkap</th>
                <th>Periode Gaji</th>
                <th>Gaji Pokok</th>
                <th>Pot. 30%</th>
                <th>Tnj. Jabatan</th>
                <th>Tnj. Masa Kerja</th>
                <th>Tnj. Lain - lain</th>
                <th>Tnj. Tidak Tetap</th>
                <th>Hari Kerja</th>
                <th>Uang Makan</th>
                <th>Lembur</th>
                <th>Uang Lembur</th>
                <th>Jml. Cuti</th>
                <th>Pot. Cuti</th>
                <th>Pot. Koperasi</th>
                <th>Pot. BPJS</th>
                <th>Gaji Diterima</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($details as $row) :
                $gp = $row->gaji_pokok - $row->pot_persen;
            ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= "<a href='" . base_url('pengajuan_gaji/cetak/' . $row->id) . "' target='_blank'>$row->nama_lengkap</a>"; ?></td>
                    <td><?= date('d/m/Y', strtotime($row->periode)) ?></td>
                    <td><?= number_format($row->gaji_pokok, 0, '.', ',') ?></td>
                    <td><?= number_format($row->pot_persen, 0, '.', ',') ?></td>
                    <td><?= number_format($row->tnj_jabatan, 0, '.', ',') ?></td>
                    <td><?= number_format($row->tnj_ms_krj, 0, '.', ',') ?></td>
                    <td><?= number_format($row->tnj_lain, 0, '.', ',') ?></td>
                    <td><?= number_format($row->tnj_td_tetap, 0, '.', ',') ?></td>
                    <td><?= $row->hari_kerja ?></td>
                    <td>
                        <?php
                        $um = $row->hari_kerja * $row->uang_makan;
                        echo number_format($um, 0, '.', ',');
                        ?>
                    </td>
                    <td><?= $row->jam_lembur; ?></td>
                    <td>
                        <?php
                        $ul = (($gp / 173) * $row->jam_lembur) * 1.1;

                        $tul = ceil($ul);
                        $tuly = substr($tul, -2);

                        if ($tuly >= 50) {
                            $tulx = abs(100 - $tuly);
                            $tulhh = $tul + $tulx;
                        } else {
                            $tulx = abs(substr($tul, -2) - $tuly);
                            $tulhh = round($tul, -2) - $tulx;
                        }
                        echo number_format($tulhh, 0, ',', '.');
                        ?>
                    </td>
                    <td><?= $row->jml_cuti ?></td>
                    <td>
                        <?php
                        $pcuti = ($gp / 30) * $row->jml_cuti;

                        $t = ceil($pcuti);
                        $xxy = substr($t, -2);

                        if ($xxy >= 50) {
                            $yxx = abs(100 - $xxy);
                            $uhh = $t + $yxx;
                        } else {
                            $yxx = abs(substr($t, -2) - $xxy);
                            $uhh = round($t, -2) - $yxx;
                        }
                        echo number_format($uhh, 0, ',', '.');
                        ?>
                    </td>
                    <td><?= number_format($row->pot_koperasi, 0, '.', ',') ?></td>
                    <td><?= number_format($row->pot_bpjs, 0, '.', ',') ?></td>
                    <td>
                        <?php
                        $total_in = ($gp + $row->tnj_jabatan + $row->tnj_ms_krj + $row->tnj_lain + $row->tnj_td_tetap + $um + $tulhh);
                        $total_out = ($uhh + $row->pot_koperasi + $row->pot_bpjs);
                        $terima = $total_in - $total_out;
                        echo number_format($terima, 0, '.', ',')
                        ?>
                    </td>
                </tr>
            <?php
                $no++;
            endforeach;
            ?>
        </tbody>
    </table>
</div>