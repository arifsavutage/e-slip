<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_karyawan');
        $this->load->model('Model_perusahaan');
        $this->load->library('form_validation');

        not_login();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'karyawan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'karyawan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'karyawan/index.html';
            $config['first_url'] = base_url() . 'karyawan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Model_karyawan->total_rows($q);
        $karyawan = $this->Model_karyawan->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'karyawan_data' => $karyawan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'title' => 'Daftar Karyawan',
            'content' => 'karyawan/karyawan_list',
            'permission' => my_permissions()
        );
        $this->load->view('dashboard', $data);
    }

    public function read($id)
    {
        $row = $this->Model_karyawan->get_by_id($id);
        if ($row) {
            $data = array(
                'created' => $row->created,
                'id' => $row->id,
                'kode_pt' => $this->Model_perusahaan->get_by_id($row->kode_pt)->nama,
                'nama_lengkap' => $row->nama_lengkap,
                'updated' => $row->updated,
                'user' => $row->user,
                'title' => 'Detail Karyawan',
                'content' => 'karyawan/karyawan_read'
            );
            $this->load->view('dashboard', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('karyawan'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('karyawan/create_action'),
            'id' => set_value('id'),
            'kode_pt' => set_value('kode_pt'),
            'nama_lengkap' => set_value('nama_lengkap'),
            'title' => 'Karyawan',
            'content' => 'karyawan/karyawan_form',
            'perusahaan' => $this->Model_perusahaan->get_all(),
        );
        $this->load->view('dashboard', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'created' => date('Y-m-d'),
                'kode_pt' => $this->input->post('kode_pt', TRUE),
                'nama_lengkap' => strtoupper(strtolower($this->input->post('nama_lengkap', TRUE))),
                'updated' => date('Y-m-d H:i:s'),
                'user' => $this->session->userdata('username') == null ? 'sadmin' : $this->session->userdata('username'),
            );

            $this->Model_karyawan->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('karyawan'));
        }
    }

    public function update($id)
    {
        $row = $this->Model_karyawan->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('karyawan/update_action'),
                'id' => set_value('id', $row->id),
                'kode_pt' => set_value('kode_pt', $row->kode_pt),
                'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
                'title' => 'Karyawan',
                'content' => 'karyawan/karyawan_form',
                'perusahaan' => $this->Model_perusahaan->get_all(),
            );
            $this->load->view('dashboard', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('karyawan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'kode_pt' => $this->input->post('kode_pt', TRUE),
                'nama_lengkap' => strtoupper(strtolower($this->input->post('nama_lengkap', TRUE))),
                'updated' => date('Y-m-d H:i:s'),
                'user' => $this->session->userdata('username') == null ? 'sadmin' : $this->session->userdata('username'),
            );

            $this->Model_karyawan->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('karyawan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Model_karyawan->get_by_id($id);

        if ($row) {
            $this->Model_karyawan->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('karyawan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('karyawan'));
        }
    }

    public function _rules()
    {

        $this->form_validation->set_rules('kode_pt', 'kode pt', 'trim|required');
        $this->form_validation->set_rules('nama_lengkap', 'nama lengkap', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "karyawan.xls";
        $judul = "karyawan";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Kode Pt");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Lengkap");
        xlsWriteLabel($tablehead, $kolomhead++, "Updated");
        xlsWriteLabel($tablehead, $kolomhead++, "User");

        foreach ($this->Model_karyawan->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->created);
            xlsWriteLabel($tablebody, $kolombody++, $data->kode_pt);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_lengkap);
            xlsWriteLabel($tablebody, $kolombody++, $data->updated);
            xlsWriteLabel($tablebody, $kolombody++, $data->user);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}

/* End of file Karyawan.php */
/* Location: ./application/controllers/Karyawan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-01-25 03:45:32 */
/* http://harviacode.com */