<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_pengajuan_gaji');
        $this->load->model('Model_perusahaan');
        $this->load->model('Model_karyawan');
    }

    public function index()
    {
        not_login();
        $this->load->view('dashboard');
    }

    public function payroll($str)
    {
        $id = $this->encryption->decrypt($str);
        $rows = $this->Model_pengajuan_gaji->get_rincian(null, $id)->row();

        if ($rows) {
            //ob_start();
            $data_gaji['detail'] = $rows;
            $template = $this->load->view('payroll_view', $data_gaji, true);
            //$template = ob_get_contents();
            //ob_end_clean();

            $this->load->view('payroll_view', $data_gaji);
            //samplepdf($template);
        } else {
            echo "<h1>404 NOT FOUND..</h1>";
        }
    }
}
