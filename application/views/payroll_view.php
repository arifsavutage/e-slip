<!DOCTYPE html>
<html>

<head>
    <style>
        * {
            margin-left: auto;
            margin-right: auto;
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            width: 800px;
        }

        .company-name {
            float: left;
            width: 400px;
            height: 80px;
            /*background-color: aquamarine;*/
            border-bottom: 0.1em solid #ccc;
        }

        .company-name>h1 {
            font-size: 18px;
            padding: 10px;
            margin: 0px;
        }

        .company-name>small {
            padding: 0px;
            margin-left: 10px;
        }

        .employee-name {
            float: left;
            width: 400px;
            height: 80px;
            /*background-color: #ccc;*/
            border-bottom: 0.1em solid #ccc;
        }

        ul {
            list-style: none;
            padding: 15px;
            margin: 0px;
        }

        li>span {
            float: right;
        }

        .revenue {
            float: left;
            width: 400px;
            min-height: 300px;
        }

        .salary-cuts {
            float: left;
            width: 400px;
            min-height: 300px;
        }

        .header {
            padding: 30px 10px 0px 10px;
            margin: 0px;
        }

        .border-line {
            /*border: 0.1em solid #CCCCCC;*/
            padding: 0px;
            margin: 0;
        }

        .total {
            float: left;
            width: 800px;
            height: 40px;
            margin: 0px;
            padding: 15px 10px;
            background-color: aliceblue;
        }

        .total h4 {
            font-size: 14px;
        }

        .total span {
            float: right;
        }

        .sign {
            float: left;
            width: 400px;
            margin-top: 30px;
        }

        .sign h4 {
            margin: 0px;
            font-size: 14px;
        }

        .sign small {
            margin: 0px;
            padding: 0px;
        }

        .keterangan {
            float: left;
            width: 400px;
            margin-top: 30px;
        }

        .keterangan p {
            font-size: 14px;
            color: #ff0000;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="company-name">
            <h1>
                <?= $detail->nama ?>
            </h1>
            <small>E-Slip Gaji</small>
        </div>
        <div class="employee-name">
            <ul>
                <li>Nama Pegawai<span><?= $detail->nama_lengkap ?></span></li>
                <li>Periode<span><?= date('F Y', strtotime($detail->periode)) ?></span></li>
            </ul>
        </div>
        <div class="revenue">
            <h4 class="header">PENGHASILAN</h4>
            <div class="border-line" style="min-height: 250px;">
                <?php
                $gp = $detail->gaji_pokok - $detail->pot_persen;

                $um = $detail->uang_makan * $detail->hari_kerja;
                $ul = (($gp / 173) * $detail->jam_lembur) * 1.1;

                $tul = ceil($ul);
                $tuly = substr($tul, -2);

                if ($tuly >= 50) {
                    $tulx = abs(100 - $tuly);
                    $tulhh = $tul + $tulx;
                } else {
                    $tulx = abs(substr($tul, -2) - $tuly);
                    $tulhh = round($tul, -2) - $tulx;
                }
                ?>
                <ul>
                    <!--<li>Gaji Pokok<span class="float-right"><?= number_format($detail->gaji_pokok, 0, ',', '.') ?></span></li>-->
                    <li>Gaji Pokok<span><?= number_format($gp, 0, ',', '.') ?></span></li>
                    <li>Tnj. jabatan<span><?= number_format($detail->tnj_jabatan, 0, ',', '.') ?></span></li>
                    <li>Tnj. Masa Kerja<span><?= number_format($detail->tnj_ms_krj, 0, ',', '.') ?></span></li>
                    <li>Tnj. Lain - lain<span><?= number_format($detail->tnj_lain, 0, ',', '.') ?></span></li>
                    <li>Tnj. Tidak Tetap<span><?= number_format($detail->tnj_td_tetap, 0, ',', '.') ?></span></li>
                    <li>Uang Lembur<span><?= number_format($tulhh, 0, ',', '.') ?></span></li>
                    <li>Uang Makan<span><?= number_format($um, 0, ',', '.') ?></span></li>
                </ul>
                <ul>
                    <?php
                    $total_in = ($detail->gaji_pokok + $detail->tnj_jabatan + $detail->tnj_ms_krj + $detail->tnj_lain + $detail->tnj_td_tetap + $um + $tulhh);
                    ?>
                    <li><strong>Total (A)</strong><span><strong class="float-right"><?= number_format($total_in, 0, ',', '.') ?></strong></span></li>
                </ul>
            </div>
        </div>
        <div class="salary-cuts">
            <h4 class="header">POTONGAN</h4>
            <div class="border-line" style="min-height: 250px;">
                <ul>
                    <!--<li>Ptongan 30%<span class="float-right"><?= number_format($detail->pot_persen, 0, ',', '.') ?></span></li>-->
                    <li>Potongan Koperasi<span><?= number_format($detail->pot_koperasi, 0, ',', '.') ?></span></li>
                    <li>Potongan BPJS<span><?= number_format($detail->pot_bpjs, 0, ',', '.') ?></span></li>
                    <?php
                    $pcuti = ($gp / 30) * $detail->jml_cuti;

                    $t = ceil($pcuti);
                    $xxy = substr($t, -2);

                    if ($xxy >= 50) {
                        $yxx = abs(100 - $xxy);
                        $uhh = $t + $yxx;
                    } else {
                        $yxx = abs(substr($t, -2) - $xxy);
                        $uhh = round($t, -2) - $yxx;
                    }
                    ?>
                    <li>Potongan Cuti<span><?= number_format($uhh, 0, ',', '.') ?></span></li>
                </ul>
                <ul>
                    <?php
                    $total_out = ($uhh + $detail->pot_koperasi + $detail->pot_bpjs);
                    ?>
                    <li><strong>Total (B)</strong><span><strong><?= number_format($total_out, 0, ',', '.') ?></strong></span></li>
                </ul>
            </div>
        </div>
        <div class="total">
            <?php
            $bersih = $total_in - $total_out;
            ?>
            <h4>Penerimaan Bersih (A-B):<span><?= number_format($bersih, 0, ',', '.') ?></span></h4>
        </div>
        <div class="sign">
            <!--
            <?= "<h4>Semarang, " . date('d-m-Y', strtotime($detail->periode)) . "</h4>" ?>
            <br />
            <br />
            <br />
            <h4>
                <span style="border-bottom: 0.1em solid #000;">Adhi Gunawan</span>
            </h4>
            <small>Human Resources Departement</small>
            <br />
                -->
        </div>
        <div class="keterangan">
            <p>
                E-slip Gaji ini merupakan produk yang resmi dari perusahaan.
            </p>
        </div>
    </div>
</body>

</html>