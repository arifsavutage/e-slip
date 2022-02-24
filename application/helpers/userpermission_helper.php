<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function my_permissions()
{
    $ci = &get_instance();
    return $ci->session->userdata('permission');
}
