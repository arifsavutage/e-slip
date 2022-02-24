<?php
function already_login()
{
    $ci = &get_instance();

    $user_session   = $ci->session->userdata('id');

    if ($user_session) {
        redirect(base_url());
    }
}

function not_login()
{
    $ci = &get_instance();

    $user_session   = $ci->session->userdata('id');

    if (!$user_session) {
        redirect(base_url() . 'auth');
    }
}

function profil_pengguna()
{
    $ci = &get_instance();
    $ci->load->model('Model_pengguna');
    $ci->load->model('Model_role');

    $id = $ci->session->userdata('id');
    $profil = $ci->Model_pengguna->get_by_id($id);

    $data = [
        'Nama Staff' => $profil->nama_staf,
        'Username'  => $profil->username,
        'Akses Terakhir' => $profil->last_login,
        'Alamat IP' => $profil->ip_address
    ];

    return $data;
}
