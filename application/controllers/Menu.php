<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_menu');
        $this->load->library('form_validation');

        not_login();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'menu/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'menu/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'menu/index.html';
            $config['first_url'] = base_url() . 'menu/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Model_menu->total_rows($q);
        $menu = $this->Model_menu->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'menu_data' => $menu,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'permission' => my_permissions()
        );
        $this->load->view('menu/menu_list', $data);
    }

    public function read($id)
    {
        $row = $this->Model_menu->get_by_id($id);
        if ($row) {
            $data = array(
                'icon' => $row->icon,
                'id' => $row->id,
                'link' => $row->link,
                'menu_title' => $row->menu_title,
                'parent_id' => $row->parent_id,
                'urut' => $row->urut,
            );
            $this->load->view('menu/menu_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menu'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('menu/create_action'),
            'icon' => set_value('icon'),
            'id' => set_value('id'),
            'link' => set_value('link'),
            'menu_title' => set_value('menu_title'),
            'parent_id' => set_value('parent_id'),
            'urut' => set_value('urut'),
        );
        $this->load->view('menu/menu_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'icon' => $this->input->post('icon', TRUE),
                'link' => $this->input->post('link', TRUE),
                'menu_title' => $this->input->post('menu_title', TRUE),
                'parent_id' => $this->input->post('parent_id', TRUE),
                'urut' => $this->input->post('urut', TRUE),
            );

            $this->Model_menu->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('menu'));
        }
    }

    public function update($id)
    {
        $row = $this->Model_menu->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('menu/update_action'),
                'icon' => set_value('icon', $row->icon),
                'id' => set_value('id', $row->id),
                'link' => set_value('link', $row->link),
                'menu_title' => set_value('menu_title', $row->menu_title),
                'parent_id' => set_value('parent_id', $row->parent_id),
                'urut' => set_value('urut', $row->urut),
            );
            $this->load->view('menu/menu_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menu'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'icon' => $this->input->post('icon', TRUE),
                'link' => $this->input->post('link', TRUE),
                'menu_title' => $this->input->post('menu_title', TRUE),
                'parent_id' => $this->input->post('parent_id', TRUE),
                'urut' => $this->input->post('urut', TRUE),
            );

            $this->Model_menu->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('menu'));
        }
    }

    public function delete($id)
    {
        $row = $this->Model_menu->get_by_id($id);

        if ($row) {
            $this->Model_menu->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('menu'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menu'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('icon', 'icon', 'trim|required');
        $this->form_validation->set_rules('link', 'link', 'trim|required');
        $this->form_validation->set_rules('menu_title', 'menu title', 'trim|required');
        $this->form_validation->set_rules('parent_id', 'parent id', 'trim|required');
        $this->form_validation->set_rules('urut', 'urut', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Menu.php */
/* Location: ./application/controllers/Menu.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-01-27 07:15:38 */
/* http://harviacode.com */