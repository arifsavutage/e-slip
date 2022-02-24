<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Perusahaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_perusahaan');
        $this->load->library('form_validation');
        not_login();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'perusahaan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'perusahaan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'perusahaan/index.html';
            $config['first_url'] = base_url() . 'perusahaan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Model_perusahaan->total_rows($q);
        $perusahaan = $this->Model_perusahaan->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'perusahaan_data' => $perusahaan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'perusahaan/perusahaan_list',
            'title' => 'Daftar Perusahaan',
            'permission' => my_permissions()
        );
        $this->load->view('dashboard', $data);
    }

    public function read($id)
    {
        $row = $this->Model_perusahaan->get_by_id($id);
        if ($row) {
            $data = array(
                'created' => $row->created,
                'kode' => $row->kode,
                'nama' => $row->nama,
                'updated' => $row->updated,
                'user' => $row->user,
                'content' => 'perusahaan/perusahaan_read',
                'title' => 'Detail Perusahaan'
            );
            $this->load->view('dashboard', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('perusahaan'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('perusahaan/create_action'),
            'read_only' => '',
            'kode' => set_value('kode'),
            'nama' => set_value('nama'),
            'content' => 'perusahaan/perusahaan_form',
            'title' => 'Perusahaan'
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
                'kode' => strtoupper(strtolower($this->input->post('kode', TRUE))),
                'created' => date('Y-m-d'),
                'nama' => strtoupper(strtolower($this->input->post('nama', TRUE))),
                'updated' => date('Y-m-d H:i:s'),
                'user' => $this->session->userdata('username') == null ? 'sadmin' : $this->session->userdata('username'),
            );

            $this->Model_perusahaan->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('perusahaan'));
        }
    }

    public function update($id)
    {
        $row = $this->Model_perusahaan->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('perusahaan/update_action'),
                'read_only' => ' readonly="true"',
                'kode' => set_value('kode', $row->kode),
                'nama' => set_value('nama', $row->nama),
                'content' => 'perusahaan/perusahaan_form',
                'title' => 'Perusahaan'
            );
            $this->load->view('dashboard', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('perusahaan'));
        }
    }

    public function update_action()
    {
        $this->_rules_update();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kode', TRUE));
        } else {
            $data = array(
                'nama' => strtoupper(strtolower($this->input->post('nama', TRUE))),
                'updated' => date('Y-m-d H:i:s'),
                'user' => $this->session->userdata('username') == null ? 'sadmin' : $this->session->userdata('username'),
            );

            $this->Model_perusahaan->update($this->input->post('kode', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('perusahaan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Model_perusahaan->get_by_id($id);

        if ($row) {
            $this->Model_perusahaan->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('perusahaan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('perusahaan'));
        }
    }

    public function _rules()
    {
        //$this->form_validation->set_rules('created', 'created', 'trim|required');
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        // $this->form_validation->set_rules('updated', 'updated', 'trim|required');
        // $this->form_validation->set_rules('user', 'user', 'trim|required');

        $this->form_validation->set_rules('kode', 'kode', 'trim|required|is_unique[perusahaan.kode]');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function _rules_update()
    {
        //$this->form_validation->set_rules('created', 'created', 'trim|required');
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        // $this->form_validation->set_rules('updated', 'updated', 'trim|required');
        // $this->form_validation->set_rules('user', 'user', 'trim|required');

        $this->form_validation->set_rules('kode', 'kode', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "perusahaan.xls";
        $judul = "perusahaan";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Nama");
        xlsWriteLabel($tablehead, $kolomhead++, "Updated");
        xlsWriteLabel($tablehead, $kolomhead++, "User");

        foreach ($this->Model_perusahaan->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->created);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama);
            xlsWriteLabel($tablebody, $kolombody++, $data->updated);
            xlsWriteLabel($tablebody, $kolombody++, $data->user);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}

/* End of file Perusahaan.php */
/* Location: ./application/controllers/Perusahaan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-01-25 03:46:25 */
/* http://harviacode.com */