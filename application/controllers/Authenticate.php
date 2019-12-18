<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Authenticate extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

	public function login()
    {
        $payload = array(
            'id_user' => $this->input->post('id_user'),
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'level' => $this->input->post('level'),
            'key' => $this->input->post('key'),
            'logged_in' => true
        );

        $this->session->set_userdata($payload);
        echo json_encode(array('status' => true, 'data' => $payload));
    }

    public function logout()
    {
        $this->session->sess_destroy();
        echo json_encode(array('status' => true, 'message' => 'Berhasil melakukan logout'));
    }
	
}
