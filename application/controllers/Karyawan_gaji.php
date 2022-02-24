<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Karyawan_gaji extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_karyawan_gaji');
        $this->load->model('Model_variabel_gaji');
        $this->load->model('Model_karyawan');
        $this->load->library('form_validation');

        not_login();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'karyawan_gaji/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'karyawan_gaji/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'karyawan_gaji/index.html';
            $config['first_url'] = base_url() . 'karyawan_gaji/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Model_karyawan_gaji->total_rows($q);
        $karyawan_gaji = $this->Model_karyawan_gaji->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'karyawan_gaji_data' => $karyawan_gaji,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'karyawan_gaji/karyawan_gaji_list',
            'title' => 'Gaji Karyawan',
            'permission' => my_permissions()
        );
        $this->load->view('dashboard', $data);
    }

    public function read($id)
    {
        $row = $this->Model_karyawan_gaji->get_by_id($id);
        if ($row) {
            $data = array(
                'created' => $row->created,
                'id' => $row->id,
                'karyawan_id' => $row->karyawan_id,
                'updated' => $row->updated,
                'user' => $row->user,
                'variabel_id' => $row->variabel_id,
                'content' => 'karyawan_gaji/karyawan_gaji_read',
                'title' => 'Detail Gaji'
            );
            $this->load->view('dashboard', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('karyawan_gaji'));
        }
    }

    public function create($id_kry = null)
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('karyawan_gaji/create_action'),
            'id' => set_value('id'),
            'karyawan_id' => set_value('karyawan_id'),
            'user' => set_value('user'),
            'variabel_id' => set_value('variabel_id'),
            'content' => 'karyawan_gaji/karyawan_gaji_form',
            'title' => 'Gaji Karyawan',
            'variables' => $this->Model_variabel_gaji->get_active_var(),
            'staff' => $this->Model_karyawan->get_by_id($id_kry)
        );
        $this->load->view('dashboard', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

            $tunjangan_val = $this->input->post('tunjangan_value', true);
            $tunjangan_id  = $this->input->post('tunjangan_id', true);

            $pot_value = $this->input->post('pot_value', true);
            $pot_id    = $this->input->post('pot_id', true);

            // print_r(var_dump($tunjangan_val));
            // echo "<br />";
            // print_r(var_dump($tunjangan_id));
            // echo "<br/>";
            // print_r(var_dump($pot_value));
            // echo "<br/>";
            // print_r(var_dump($pot_id));
            // echo "<br/>";

            $kary_var = [];
            for ($i = 0; $i < count($tunjangan_id); $i++) {
                //echo "tnj_$tunjangan_id[$i] = $tunjangan_val[$i] <br />";
                $ix = ['id' => $tunjangan_id[$i], 'nominal' => $tunjangan_val[$i]];

                array_push($kary_var, $ix);
            }
            //echo "<br />";
            for ($j = 0; $j < count($pot_id); $j++) {
                //echo "tnj_$pot_id[$j] = $pot_value[$j] <br />";
                $jy = ['id' => $pot_id[$j], 'nominal' => $pot_value[$j]];
                array_push($kary_var, $jy);
            }

            // print_r(var_dump($kary_var));

            // echo "<br/>";

            foreach ($kary_var as $su) {
                //echo "id = $su[id] , nominal = $su[nominal] <br />";

                $data = array(
                    'created' => date('Y-m-d'),
                    'karyawan_id' => $this->input->post('karyawan_id', TRUE),
                    'updated' => date('Y-m-d H:i:s'),
                    'user' => $this->session->userdata('username') == null ? 'sadmin' : $this->session->userdata('username'),
                    'variabel_id' => $su['id'],
                    'nominal' => $su['nominal']

                );
                $this->Model_karyawan_gaji->insert($data);
            }

            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('karyawan'));
        }
    }

    public function update($id_kry = null)
    {
        //$row = $this->Model_karyawan_gaji->get_by_id($id);
        $row = $this->Model_karyawan->get_by_id($id_kry);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('karyawan_gaji/update_action'),
                'id' => set_value('id', $row->id),
                'karyawan_id' => set_value('karyawan_id', $row->id),
                'updated' => set_value('updated', $row->updated),
                'user' => set_value('user', $row->user),
                'content' => 'karyawan_gaji/karyawan_gaji_form_edit',
                'title' => 'Gaji Karyawan',
                'variables' => $this->Model_karyawan_gaji->get_by_karyawan_id($id_kry),
                'staff' => $this->Model_karyawan->get_by_id($id_kry)
            );
            $this->load->view('dashboard', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('karyawan_gaji'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run()) {
            $tunjangan_val = $this->input->post('tunjangan_value', true);
            $tunjangan_id  = $this->input->post('tunjangan_id', true);

            $pot_value = $this->input->post('pot_value', true);
            $pot_id    = $this->input->post('pot_id', true);

            $kary_var = [];
            for ($i = 0; $i < count($tunjangan_id); $i++) {
                $ix = ['id' => $tunjangan_id[$i], 'nominal' => $tunjangan_val[$i]];

                array_push($kary_var, $ix);
            }

            for ($j = 0; $j < count($pot_id); $j++) {
                $jy = ['id' => $pot_id[$j], 'nominal' => $pot_value[$j]];
                array_push($kary_var, $jy);
            }

            print_r(var_dump($kary_var));
            $karyawan_id = $this->input->post('karyawan_id', TRUE);
            foreach ($kary_var as $su) {

                $data = array(
                    'updated' => date('Y-m-d H:i:s'),
                    'user' => $this->session->userdata('username') == null ? 'sadmin' : $this->session->userdata('username'),
                    'nominal' => $su['nominal']

                );
                $this->Model_karyawan_gaji->update($karyawan_id, $su['id'], $data);
            }

            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('karyawan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Model_karyawan_gaji->get_by_id($id);

        if ($row) {
            $this->Model_karyawan_gaji->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('karyawan_gaji'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('karyawan_gaji'));
        }
    }

    public function _rules()
    {

        $this->form_validation->set_rules('karyawan_id', 'karyawan id', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "karyawan_gaji.xls";
        $judul = "karyawan_gaji";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Karyawan Id");
        xlsWriteLabel($tablehead, $kolomhead++, "Updated");
        xlsWriteLabel($tablehead, $kolomhead++, "User");
        xlsWriteLabel($tablehead, $kolomhead++, "Variabel Id");

        foreach ($this->Model_karyawan_gaji->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->created);
            xlsWriteNumber($tablebody, $kolombody++, $data->karyawan_id);
            xlsWriteLabel($tablebody, $kolombody++, $data->updated);
            xlsWriteLabel($tablebody, $kolombody++, $data->user);
            xlsWriteNumber($tablebody, $kolombody++, $data->variabel_id);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}

/* End of file Karyawan_gaji.php */
/* Location: ./application/controllers/Karyawan_gaji.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-01-25 03:45:53 */
/* http://harviacode.com */