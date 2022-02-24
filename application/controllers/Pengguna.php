<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengguna extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_pengguna');
        $this->load->model('Model_role');
        $this->load->library('form_validation');
        not_login();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'pengguna/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pengguna/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pengguna/index.html';
            $config['first_url'] = base_url() . 'pengguna/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Model_pengguna->total_rows($q);
        $pengguna = $this->Model_pengguna->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pengguna_data' => $pengguna,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'pengguna/pengguna_list',
            'title' => 'Daftar Pengguna',
            'permission' => my_permissions()
        );
        $this->load->view('dashboard', $data);
    }

    public function read($id)
    {
        $row = $this->Model_pengguna->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'ip_address' => $row->ip_address,
                'is_active' => $row->is_active,
                'last_login' => $row->last_login,
                'nama_staf' => $row->nama_staf,
                'role_id' => $this->Model_role->get_by_id($row->role_id)->name,
                'username' => $row->username,
                'content' => 'pengguna/pengguna_read',
                'title' => 'Detail Pengguna'
            );
            $this->load->view('dashboard', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengguna'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pengguna/create_action'),
            'id' => set_value('id'),
            'is_active' => set_value('is_active'),
            'nama_staf' => set_value('nama_staf'),
            'password' => set_value('password'),
            'role_id' => set_value('role_id'),
            'username' => set_value('username'),
            'content' => 'pengguna/pengguna_form',
            'title' => 'Pengguna',
            'roles' => $this->Model_role->get_all()
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
                'is_active' => $this->input->post('is_active', TRUE),
                'nama_staf' => ucwords(strtolower($this->input->post('nama_staf', TRUE))),
                'password' => password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT),
                'role_id' => $this->input->post('role_id', TRUE),
                'username' => $this->input->post('username', TRUE),
            );

            $this->Model_pengguna->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pengguna'));
        }
    }

    public function update($id)
    {
        $row = $this->Model_pengguna->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pengguna/update_action'),
                'id' => set_value('id', $row->id),
                'is_active' => set_value('is_active', $row->is_active),
                'nama_staf' => set_value('nama_staf', $row->nama_staf),
                'role_id' => set_value('role_id', $row->role_id),
                'username' => set_value('username', $row->username),
                'content' => 'pengguna/pengguna_form_edit',
                'title' => 'Pengguna',
                'roles' => $this->Model_role->get_all()
            );
            $this->load->view('dashboard', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengguna'));
        }
    }

    public function update_action()
    {
        $this->_rules_update();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'is_active' => $this->input->post('is_active', TRUE),
                'nama_staf' => ucwords(strtolower($this->input->post('nama_staf', TRUE))),
                'role_id' => $this->input->post('role_id', TRUE),
                'username' => $this->input->post('username', TRUE),
            );

            $this->Model_pengguna->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pengguna'));
        }
    }

    public function ubah_sandi()
    {
        // id pengguna
        $id_pengguna = $this->session->userdata('id');

        $this->form_validation->set_rules('oldpass', 'Password Lama', 'trim|required');
        $this->form_validation->set_rules('newpass', 'Password Baru', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('repeatpass', 'Ulangi Password Baru', 'trim|required|matches[newpass]');

        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        $this->form_validation->set_message('required', 'tidak boleh kosong');
        $this->form_validation->set_message('min_length', 'minimal 6 karakter');
        $this->form_validation->set_message('matches', 'kombinasi password tidak sama');

        if ($this->form_validation->run()) {

            $oldpass = $this->input->post('oldpass', true);
            $newpass = $this->input->post('newpass', true);

            //cek keberadaan pengguna
            $cek = $this->Model_pengguna->get_by_id($id_pengguna);

            if ($cek) {
                if (password_verify($oldpass, $cek->password)) {
                    $data_up = [
                        'password' => password_hash($newpass, PASSWORD_DEFAULT)
                    ];

                    $this->Model_pengguna->update($id_pengguna, $data_up);

                    $this->session->set_flashdata('message', '<div class="mt-2 mb-2 alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success, </strong> merubah sandi baru berhasil.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect(base_url('pengguna/ubah_sandi'));
                } else {
                    $this->session->set_flashdata('message', '<div class="mt-2 mb-2 alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning, </strong> sandi lama Anda tidak cocok.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect(base_url('pengguna/ubah_sandi'));
                }
            } else {
                $this->session->set_flashdata('message', '<div class="mt-2 mb-2 alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning, </strong> gagal merubah sandi baru.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                redirect(base_url('pengguna/ubah_sandi'));
            }
        }

        $data = array(
            'content' => 'pengguna/pengguna_ubah_sandi',
            'title' => 'Pengguna',
        );
        $this->load->view('dashboard', $data);
    }

    public function change_pass($id)
    {
        $row = $this->Model_pengguna->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pengguna/update_action'),
                'id' => set_value('id', $row->id),
                'nama_staf' => set_value('nama_staf', $row->nama_staf),
                'username' => set_value('username', $row->username),
                'password' => set_value('password'),
                'content' => 'pengguna/pengguna_change_pass',
                'title' => 'Pengguna',
                'roles' => $this->Model_role->get_all()
            );
            $this->load->view('dashboard', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengguna'));
        }
    }

    public function delete($id)
    {
        $row = $this->Model_pengguna->get_by_id($id);

        if ($row) {
            $this->Model_pengguna->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pengguna'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengguna'));
        }
    }

    public function _rules_update()
    {
        $this->form_validation->set_rules('is_active', 'is active', 'trim|required');
        $this->form_validation->set_rules('nama_staf', 'nama staf', 'trim|required');
        $this->form_validation->set_rules('role_id', 'role id', 'trim|required');
        $this->form_validation->set_rules('username', 'username', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function _rules()
    {
        $this->form_validation->set_rules('is_active', 'is active', 'trim|required');
        $this->form_validation->set_rules('nama_staf', 'nama staf', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        $this->form_validation->set_rules('role_id', 'role id', 'trim|required');
        $this->form_validation->set_rules('username', 'username', 'trim|required|is_unique[pengguna.username]');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Pengguna.php */
/* Location: ./application/controllers/Pengguna.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-01-27 07:15:24 */
/* http://harviacode.com */