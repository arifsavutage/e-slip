<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Role extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_role');
        $this->load->library('form_validation');
        not_login();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'role/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'role/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'role/index.html';
            $config['first_url'] = base_url() . 'role/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Model_role->total_rows($q);
        $role = $this->Model_role->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'role_data' => $role,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'role/role_list',
            'title' => 'Daftar Hak Akses',
            'permission' => my_permissions()
        );
        $this->load->view('dashboard', $data);
    }

    public function read($id)
    {
        $row = $this->Model_role->get_by_id($id);
        if ($row) {
            $data = array(
                'crud' => $row->crud,
                'id' => $row->id,
                'name' => $row->name,
                'content' => 'role/role_read',
                'title' => 'Detail Hak Akses'
            );
            $this->load->view('dashboard', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('role'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('role/create_action'),
            'id' => set_value('id'),
            'name' => set_value('name'),
            'content' => 'role/role_form_add',
            'title' => 'Hak Akses'
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
                'crud' => serialize($this->input->post('crud', TRUE)),
                'name' => $this->input->post('name', TRUE),
            );

            $this->Model_role->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('role'));
        }
    }

    public function update($id)
    {
        $row = $this->Model_role->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('role/update_action'),
                'id' => set_value('id', $row->id),
                'name' => set_value('name', $row->name),
                'crud' => $row->crud,
                'content' => 'role/role_form_edit',
                'title' => 'Hak Akses'
            );
            $this->load->view('dashboard', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('role'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'crud' => $this->input->post('crud', TRUE),
                'name' => $this->input->post('name', TRUE),
            );

            $this->Model_role->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('role'));
        }
    }

    public function delete($id)
    {
        $row = $this->Model_role->get_by_id($id);

        if ($row) {
            $this->Model_role->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('role'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('role'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('name', 'name', 'trim|required|is_unique[role.name]');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function _rules_update()
    {
        $this->form_validation->set_rules('name', 'name', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Role.php */
/* Location: ./application/controllers/Role.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-01-27 07:15:03 */
/* http://harviacode.com */