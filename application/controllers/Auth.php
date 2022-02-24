<?php
defined('BASEPATH') or exit('No direct access script allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Model_pengguna');
        $this->load->model('Model_role');
        $this->load->library('form_validation');
    }

    public function index()
    {
        already_login();

        $captcha = $this->_buat_captcha();
        $data['captcha_img']    = $captcha['image'];
        $this->session->set_userdata('captcha', $captcha['word']);

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        $this->form_validation->set_rules('captchaku', 'captcha', 'trim|callback_captchacheck');

        if ($this->form_validation->run()) {
            $uname = $this->input->post('username', true);
            $pass  = $this->input->post('password', true);

            $user_account = $this->Model_pengguna->get_by_username($uname);

            if ($user_account != null) {
                // cek account aktif
                if ($user_account->is_active == 0) {
                    $this->session->set_flashdata('message', '
                    <div class="alert alert-warning mt-2 mb-2" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        Akun Anda tidak aktif
                    </div>');
                    //echo $this->db->last_query();
                    redirect(base_url('auth'));
                } else {
                    // cek kebenaran password
                    if (password_verify($pass, $user_account->password)) {

                        //buat session
                        //get role permission
                        $get_role = $this->Model_role->get_by_id($user_account->role_id);
                        $arr_per = unserialize($get_role->crud);

                        $crud = [1 => 'C', 2 => 'R', 3 => 'U', 4 => 'D'];

                        $perr_array = [];
                        $i = 0;
                        foreach ($crud as $idx => $val) {
                            if (in_array($idx, $arr_per)) {
                                $perr_array[$i] = ["$val" => 'yes'];
                            } else {
                                $perr_array[$i] = ["$val" => 'no'];
                            }
                            $i++;
                        }

                        //print_r(var_dump($perr_array));

                        // get priviledge menu
                        // $get_menu_access = $this->Model_menu_priviledge->get_by_priviledge_id($get_role->ID);
                        // $un_serialize_menu = unserialize($get_menu_access->MENU_ID);

                        $exname = explode(" ", $user_account->nama_staf);
                        //$nama = $exname[0] . " " . $exname[1];

                        if (count($exname) > 1) {
                            $nama   = $exname[0];
                        } else {
                            $nama   = $user_account->nama_staf;
                        }

                        // $get_foto = $this->Model_warga->get_by_id($user_account->warga_id);
                        // $foto = $get_foto->foto == null ? "noimage.jpeg" : $get_foto->foto;

                        $data = [
                            'id'    => $user_account->id,
                            'nama'  => ucfirst(strtolower($nama)),
                            'role'  => $get_role->name,
                            'permission' => $perr_array,
                            //'menus' => $get_menu_access->MENU_ID
                            //'foto' => $foto
                            //'foto'  => $foto,
                        ];

                        $this->session->set_userdata($data);

                        //print_r(var_dump($perr_array));
                        // update IP & last login
                        $up_data = [
                            'ip_address' => $this->input->ip_address(),
                            'last_login' => date('Y-m-d H:i:s')
                        ];

                        $this->Model_pengguna->update($user_account->id, $up_data);
                        //echo "yess";
                        redirect(base_url());
                    } else {
                        $this->session->set_flashdata('message', '
                        <div class="alert alert-warning mt-2 mb-2" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            Password Salah
                        </div>');

                        redirect(base_url('auth'));
                    }
                }
            } else {
                $this->session->set_flashdata('message', '
                        <div class="alert alert-warning mt-2 mb-2" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            Akun tidak ditemukan
                        </div>');

                redirect(base_url('auth'));
            }
        } else {
            $this->load->view('login', $data);
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }


    function captchacheck()
    {
        $captchaku      = $this->input->post('captchaku');
        $code_captcha   = $this->input->post('code_captcha');

        if ($captchaku != $code_captcha) {
            $this->form_validation->set_message('captchacheck', 'Kode %s salah');
            return FALSE;
        }
    }

    private function _buat_captcha()
    {
        $vals = array(
            //'word'          => 'Random word',
            'img_path'      => './captcha/',
            'img_url'       => base_url() . 'captcha/',
            'font_path'     => FCPATH . 'captcha/font/HVD_Peace.ttf',
            'img_width'     => '350',
            'img_height'    => 85,
            'expiration'    => 7200,
            'word_length'   => 5,
            'font_size'     => 48,
            'img_id'        => 'Imageid',
            'pool'          => '1234567890',

            // White background and border, black text and red grid
            'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
            )
        );

        $cap = create_captcha($vals);

        return $cap;
    }
}
