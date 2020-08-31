<?php

class Fungsi
{
    protected $ci;

    function __construct()
    {
        $this->ci = &get_instance();
    }

    function user_login()
    {
        $this->ci->load->model('auth_model');
        $user_id = $this->ci->session->userdata('userid');
        $user_data = $this->ci->auth_model->get($user_id)->row();
        return $user_data;
    }
    // function kalkulasi()
    // {
    //     $this->ci->load->model(['kalkulasi_model', 'jenis_model']);
    //     $user_id = $this->ci->session->userdata('userid');
    //     $user_data = $this->ci->auth_model->get($user_id)->row();
    //     return $user_data;
    // }

    // function form_bahan()
    // {
    //     $this->ci->load->model(['kalkulasi_model', 'jenis_model']);
    //     $form_id = $this->ci->session->userdata('formid');
    //     $form_data = $this->ci->kalkulasi_model->get($form_id)->row();
    //     return $form_data;
    // }
}
