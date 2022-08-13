<?php
function is_logAdmin()
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        $ci->session->set_flashdata(
            'message',
            '<div class="alert alert-danger" role="alert">
        Oops! Maaf akses ditolak.
        </div>'
        );
        redirect('auth');
    }
}

function is_logStaff()
{
    $ci = get_instance();
    if ($ci->session->userdata('username')) {
        if ($ci->session->userdata('role') == 'staff') {
            $ci->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">
            Oops! Maaf akses ditolak.
            </div>'
            );
            redirect('admin');
        }
    }
}
