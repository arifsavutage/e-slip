<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Variabel_gaji extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_variabel_gaji');
        $this->load->library('form_validation');

        not_login();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'variabel_gaji/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'variabel_gaji/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'variabel_gaji/index.html';
            $config['first_url'] = base_url() . 'variabel_gaji/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Model_variabel_gaji->total_rows($q);
        $variabel_gaji = $this->Model_variabel_gaji->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'variabel_gaji_data' => $variabel_gaji,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'variabel_gaji/variabel_gaji_list',
            'title' => 'Variabel List',
            'permission' => my_permissions()
        );
        $this->load->view('dashboard', $data);
    }

    public function read($id)
    {
        $row = $this->Model_variabel_gaji->get_by_id($id);
        if ($row) {
            $data = array(
                'created' => $row->created,
                'id' => $row->id,
                'nama_variabel' => $row->nama_variabel,
                'posisi' => $row->posisi,
                'publik' => $row->publik,
                'updated' => $row->updated,
                'user' => $row->user,
                'content' => 'variabel_gaji/variabel_gaji_read',
                'title' => 'Detail Variabel Gaji'
            );
            $this->load->view('dashboard', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('variabel_gaji'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('variabel_gaji/create_action'),
            'id' => set_value('id'),
            'nama_variabel' => set_value('nama_variabel'),
            'posisi' => set_value('posisi'),
            'publik' => set_value('publik'),
            'content' => 'variabel_gaji/variabel_gaji_form',
            'title' => 'Variabel'
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
                'nama_variabel' => ucwords(strtolower($this->input->post('nama_variabel', TRUE))),
                'posisi' => $this->input->post('posisi', TRUE),
                'publik' => $this->input->post('publik', TRUE),
                'updated' => date('Y-m-d H:i:s'),
                'user' => $this->session->userdata('username') == null ? 'sadmin' : $this->session->userdata('username'),
            );

            $this->Model_variabel_gaji->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('variabel_gaji'));
        }
    }

    public function update($id)
    {
        $row = $this->Model_variabel_gaji->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('variabel_gaji/update_action'),
                'id' => set_value('id', $row->id),
                'nama_variabel' => set_value('nama_variabel', $row->nama_variabel),
                'posisi' => set_value('posisi', $row->posisi),
                'publik' => set_value('publik', $row->publik),
                'content' => 'variabel_gaji/variabel_gaji_form',
                'title' => 'Variabel'
            );
            $this->load->view('dashboard', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('variabel_gaji'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'nama_variabel' => ucwords(strtolower($this->input->post('nama_variabel', TRUE))),
                'posisi' => $this->input->post('posisi', TRUE),
                'publik' => $this->input->post('publik', TRUE),
                'updated' => date('Y-m-d H:i:s'),
                'user' => $this->session->userdata('username') == null ? 'sadmin' : $this->session->userdata('username'),
            );

            $this->Model_variabel_gaji->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('variabel_gaji'));
        }
    }

    public function delete($id)
    {
        $row = $this->Model_variabel_gaji->get_by_id($id);

        if ($row) {
            $this->Model_variabel_gaji->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('variabel_gaji'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('variabel_gaji'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_variabel', 'nama variabel', 'trim|required|is_unique[variabel_gaji.nama_variabel]');
        $this->form_validation->set_rules('posisi', 'posisi', 'trim|required');
        $this->form_validation->set_rules('publik', 'publik', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "variabel_gaji.xls";
        $judul = "variabel_gaji";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Variabel");
        xlsWriteLabel($tablehead, $kolomhead++, "Posisi");
        xlsWriteLabel($tablehead, $kolomhead++, "Publik");
        xlsWriteLabel($tablehead, $kolomhead++, "Updated");
        xlsWriteLabel($tablehead, $kolomhead++, "User");

        foreach ($this->Model_variabel_gaji->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->created);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_variabel);
            xlsWriteNumber($tablebody, $kolombody++, $data->posisi);
            xlsWriteNumber($tablebody, $kolombody++, $data->publik);
            xlsWriteLabel($tablebody, $kolombody++, $data->updated);
            xlsWriteLabel($tablebody, $kolombody++, $data->user);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}

/* End of file Variabel_gaji.php */
/* Location: ./application/controllers/Variabel_gaji.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-01-25 03:46:45 */
/* http://harviacode.com */