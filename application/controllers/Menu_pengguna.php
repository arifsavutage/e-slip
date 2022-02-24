<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu_pengguna extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_menu_pengguna');
        $this->load->library('form_validation');

        not_login();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'menu_pengguna/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'menu_pengguna/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'menu_pengguna/index.html';
            $config['first_url'] = base_url() . 'menu_pengguna/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Model_menu_pengguna->total_rows($q);
        $menu_pengguna = $this->Model_menu_pengguna->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'menu_pengguna_data' => $menu_pengguna,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'permission' => my_permissions()
        );
        $this->load->view('menu_pengguna/menu_pengguna_list', $data);
    }

    public function read($id)
    {
        $row = $this->Model_menu_pengguna->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'menu' => $row->menu,
                'role_id' => $row->role_id,
            );
            $this->load->view('menu_pengguna/menu_pengguna_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menu_pengguna'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('menu_pengguna/create_action'),
            'id' => set_value('id'),
            'menu' => set_value('menu'),
            'role_id' => set_value('role_id'),
        );
        $this->load->view('menu_pengguna/menu_pengguna_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'menu' => $this->input->post('menu', TRUE),
                'role_id' => $this->input->post('role_id', TRUE),
            );

            $this->Model_menu_pengguna->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('menu_pengguna'));
        }
    }

    public function update($id)
    {
        $row = $this->Model_menu_pengguna->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('menu_pengguna/update_action'),
                'id' => set_value('id', $row->id),
                'menu' => set_value('menu', $row->menu),
                'role_id' => set_value('role_id', $row->role_id),
            );
            $this->load->view('menu_pengguna/menu_pengguna_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menu_pengguna'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'menu' => $this->input->post('menu', TRUE),
                'role_id' => $this->input->post('role_id', TRUE),
            );

            $this->Model_menu_pengguna->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('menu_pengguna'));
        }
    }

    public function delete($id)
    {
        $row = $this->Model_menu_pengguna->get_by_id($id);

        if ($row) {
            $this->Model_menu_pengguna->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('menu_pengguna'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menu_pengguna'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('menu', 'menu', 'trim|required');
        $this->form_validation->set_rules('role_id', 'role id', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Menu_pengguna.php */
/* Location: ./application/controllers/Menu_pengguna.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-01-27 07:16:08 */
/* http://harviacode.com */