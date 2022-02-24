<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengajuan_gaji extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_pengajuan_gaji');
        $this->load->model('Model_perusahaan');
        $this->load->model('Model_karyawan');
        $this->load->library('form_validation');
        $this->load->library('Qrgenerators');

        not_login();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'pengajuan_gaji/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pengajuan_gaji/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pengajuan_gaji/index.html';
            $config['first_url'] = base_url() . 'pengajuan_gaji/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Model_pengajuan_gaji->total_rows($q);
        $pengajuan_gaji = $this->Model_pengajuan_gaji->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->form_validation->set_rules('namapt', 'Perusahaan', 'trim|required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');

        if ($this->form_validation->run()) {
            //proses
            $pt = $this->input->post('namapt', TRUE);
            $tgl = $this->input->post('tanggal', TRUE);
        }

        $data = array(
            'pengajuan_gaji_data' => $pengajuan_gaji,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'title' => 'Daftar Pengajuan Gaji',
            'content' => 'pengajuan_gaji/pengajuan_gaji_list',
            'companys' => $this->Model_perusahaan->get_all(),
            'permission' => my_permissions()
        );
        $this->load->view('dashboard', $data);
    }

    public function cetak($id)
    {
        //generate QR
        $str = $this->encryption->encrypt($id);
        $this->generate_qr($id, $str);

        //ob_start();
        $data_gaji['detail'] = $this->Model_pengajuan_gaji->get_rincian(null, $id)->row();
        $template = $this->load->view('pdf_payroll', $data_gaji, true);
        //$template = ob_get_contents();
        //ob_end_clean();

        $this->load->view('pdf_payroll', $data_gaji);
        //samplepdf($template);
    }

    public function read($periode)
    {
        $row = $this->Model_pengajuan_gaji->get_rincian($periode, null);
        if ($row) {
            $data = array(
                'period' => $periode,
                'details' => $row->result(),
                'title' => 'Laporan Gaji Periode',
                'content' => 'pengajuan_gaji/pengajuan_gaji_read'
            );
            $this->load->view('dashboard', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengajuan_gaji'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pengajuan_gaji/create_action'),
            'created' => set_value('created'),
            'gaji_id' => set_value('gaji_id'),
            'id' => set_value('id'),
            'periode' => set_value('periode'),
            'user' => set_value('user'),
            'title' => 'Pengajuan Gaji ',
            'content' => 'pengajuan_gaji/pengajuan_gaji_form',
            //'data_gaji' => $this->Model_pengajuan_gaji->get_pengajuan_data(),
            'data_gaji' => $this->Model_karyawan->relation_gaji()
        );
        $this->load->view('dashboard', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $tanggal = $this->input->post('tanggal', TRUE);
            $hari_kerja = $this->input->post('hari_kerja', TRUE);
            $jml_lembur = $this->input->post('jml_lembur', TRUE);
            $id_kry = $this->input->post('id_kry', TRUE);
            $jml_cuti = $this->input->post('jml_cuti', TRUE);

            $data_gabung = [];

            $jml_data = count($id_kry); //jml diambil dari jumlah data karyawan

            //transf to array multidimensional
            for ($i = 0; $i < $jml_data; $i++) {
                $x = [
                    'id_kry' => $id_kry[$i],
                    'hari_kerja' => $hari_kerja[$i],
                    'jml_lembur' => $jml_lembur[$i],
                    'jml_cuti' => $jml_cuti[$i],
                ];

                array_push($data_gabung, $x);
            }

            //print_r(var_dump($data_gabung));

            foreach ($data_gabung as $hh) {
                $data = array(
                    'created' => date('Y-m-d'),
                    'gaji_id' => $hh['id_kry'],
                    'hari_kerja' => $hh['hari_kerja'],
                    'jam_lembur' => $hh['jml_lembur'],
                    'jml_cuti' => $hh['jml_cuti'],
                    'periode' => date('Y-m-d', strtotime($tanggal)),
                    'user' => $this->session->userdata('username') == null ? 'sadmin' : $this->session->userdata('username'),
                );

                $this->Model_pengajuan_gaji->insert($data);
            }

            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pengajuan_gaji'));
        }
    }

    public function update($id)
    {
        $row = $this->Model_pengajuan_gaji->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pengajuan_gaji/update_action'),
                'created' => set_value('created', $row->created),
                'gaji_id' => set_value('gaji_id', $row->gaji_id),
                'id' => set_value('id', $row->id),
                'periode' => set_value('periode', $row->periode),
                'user' => set_value('user', $row->user),
                'title' => 'Pengajuan Gaji ',
                'content' => 'pengajuan_gaji/pengajuan_gaji_form'
            );
            $this->load->view('dashboard', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengajuan_gaji'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'created' => $this->input->post('created', TRUE),
                'gaji_id' => $this->input->post('gaji_id', TRUE),
                'periode' => $this->input->post('periode', TRUE),
                'user' => $this->input->post('user', TRUE),
            );

            $this->Model_pengajuan_gaji->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pengajuan_gaji'));
        }
    }

    public function delete($id)
    {
        $row = $this->Model_pengajuan_gaji->get_by_id($id);

        if ($row) {
            $this->Model_pengajuan_gaji->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pengajuan_gaji'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengajuan_gaji'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function generate_qr($id, $str_encrypt)
    {
        $tempdir = 'assets/img/qr/';

        // $this->db->where('id', $id);
        // $data_qr = $this->db->get('tb_qrcode')->row();

        //isi QRCode saat discan
        //$isi_teks = base_url('payroll/info/' . $str_encrypt);
        $isi_teks = 'http://192.168.88.19:8080/e-slip/payroll/info/' . $str_encrypt;

        //namafile setelah jadi qrcode
        $namafile = "img_qr_$id.png";
        //kualitas dan ukuran qrcode
        $quality = 'H';
        $ukuran = 9;
        $padding = 0;

        QRCode::png($isi_teks, $tempdir . $namafile, QR_ECLEVEL_H, $ukuran, $padding);
        $filepath = $tempdir . $namafile;
        $QR = imagecreatefrompng($filepath);
        $QR_width = imagesx($QR);
        $QR_height = imagesy($QR);

        // if (!empty($data_qr->logo)) :
        //     //direktori dan nama logo
        //     $logopath = base_url() . "assets/img/" . $data_qr->logo;
        //     $logo = imagecreatefromstring(file_get_contents($logopath));
        //     $logo_width = imagesx($logo);
        //     $logo_height = imagesy($logo);

        //     //besar logo
        //     $logo_qr_width = $QR_width / 3;
        //     $scale = $logo_width / $logo_qr_width;
        //     $logo_qr_height = $logo_height / $scale;

        //     //posisi logo
        //     imagecopyresampled($QR, $logo, $QR_width / 3.3, $QR_height / 2.5, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
        // endif;

        imagepng($QR, $filepath);

        //echo "<img src='" . base_url() . "assets/img/qr/$namafile'>";
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "pengajuan_gaji.xls";
        $judul = "pengajuan_gaji";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Created");
        xlsWriteLabel($tablehead, $kolomhead++, "Gaji Id");
        xlsWriteLabel($tablehead, $kolomhead++, "Periode");
        xlsWriteLabel($tablehead, $kolomhead++, "User");

        foreach ($this->Model_pengajuan_gaji->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->created);
            xlsWriteNumber($tablebody, $kolombody++, $data->gaji_id);
            xlsWriteLabel($tablebody, $kolombody++, $data->periode);
            xlsWriteLabel($tablebody, $kolombody++, $data->user);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}

/* End of file Pengajuan_gaji.php */
/* Location: ./application/controllers/Pengajuan_gaji.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-01-25 03:46:08 */
/* http://harviacode.com */