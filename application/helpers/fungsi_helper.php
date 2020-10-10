<?php

function check_already_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('userid');
    if ($user_session) {
        redirect('admin/dashboard_admin');
    }
}

function check_not_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('userid');
    // $user_level = $ci->session->userdata('level');
    // if (!$user_session && $user_level != '3') {
    //     redirect('auth/login');
    // } elseif (!$user_session && $user_level == '3') {
    //     redirect('auth/login_website');
    // }
    if (!$user_session) {
        redirect('auth/login');
    }
}
function check_not_login_pengunjung()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('userid');
    // $user_level = $ci->session->userdata('level');
    // if (!$user_session && $user_level != '3') {
    //     redirect('auth/login');
    // } elseif (!$user_session && $user_level == '3') {
    //     redirect('auth/login_website');
    // }
    if (!$user_session) {
        redirect('home/login');
    }
}

function cek_admin()
{
    $ci = &get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_login()->level != 1) {
        redirect('admin/dashboard_admin');
    }
}

function cek_pengunjung()
{
    $ci = &get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_login()->level == 3) {
        redirect('home');
    }
}
