<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="<?= base_url() ?>">E-Slip</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?= base_url() ?>">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Master Data
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?= base_url('perusahaan') ?>">Perusahaan</a>
                        <a class="dropdown-item" href="<?= base_url('karyawan') ?>">Karyawan</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('variabel_gaji') ?>">Variabel Gaji</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="transaksiGaji" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Transaksi
                    </a>
                    <div class="dropdown-menu" aria-labelledby="transaksiGaji">
                        <!--<a class="dropdown-item" href="<?= base_url('karyawan_gaji') ?>">Gaji Karyawan</a>
                        <div class="dropdown-divider"></div>-->
                        <a class="dropdown-item" href="<?= base_url('pengajuan_gaji') ?>">Pengajuan Gaji</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropOpsi" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Opsi
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropOpsi">
                        <a class="dropdown-item" href="<?= base_url('role') ?>">Hak Akses</a>
                        <a class="dropdown-item" href="<?= base_url('pengguna') ?>">Pengguna</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('menu') ?>">Master Menu</a>
                    </div>
                </li>
            </ul>
            <span class="navbar-text mr-5">
                <div class="dropdown show">
                    <a class="btn btn-sm dropdown-toggle" href="#" role="button" id="dropAkun" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user fa-fw mr-1"></i>Hi, <?php echo $this->session->userdata('nama'); ?>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropAkun">
                        <a href="#" class="dropdown-item text-dark" data-toggle="modal" data-target="#profilModal">Profil</a>
                        <a href="<?= base_url('pengguna/ubah_sandi') ?>" class="dropdown-item text-dark">Ganti Password</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-dark" href="<?= base_url('auth/logout') ?>">Logout</a>
                    </div>
                </div>
            </span>
        </div>
    </nav>
    <div class="container mt-4">

        <?php
        if (isset($content)) {
            $this->load->view($content);
        }
        ?>
    </div>

    <!-- Modal Profil -->
    <div class="modal fade" id="profilModal" tabindex="-1" role="dialog" aria-labelledby="profilModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profilModalLabel">Profil Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    $profil = profil_pengguna();
                    ?>
                    <table class="table">
                        <?php
                        foreach ($profil as $label => $value) :
                        ?>
                            <tr>
                                <td><strong><?= $label ?></strong></td>
                                <td><?= $value ?></td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script>
        $(function() {
            $(".datepicker").datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.data-tables').DataTable();
        });

        $(document).ready(function() {
            $('.ex-data-tables').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    title: 'Laporan Gaji',
                    extend: 'excel',
                    text: 'Export Excel',
                }]
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#table-kary').on('click', '.select-kary', function() {
                var currentRow = $(this).closest('tr');

                var col0 = currentRow.find("td:eq(0)").text();
                var col1 = currentRow.find("td:eq(1)").text();
                var col2 = currentRow.find("td:eq(2)").text();

                $('#karyawan_id').val(col0);
                $('#nama_kary').val(col1);
                $('#perusahaan').val(col2);

                /*alert("Data sudah dipilih");*/
            });
        });
    </script>
</body>

</html>