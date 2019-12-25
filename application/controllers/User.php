<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function index()
	{
		$this->load->view('user/data');
    }
    
    public function detail($id)
	{
        $data['id_user'] = $id;
		$this->load->view('user/detail', $data);
	}

}
