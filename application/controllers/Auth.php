<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
    {
		parent::__construct();
        $this->load->library('session');
        
		if($this->session->has_userdata('logged_in') ){
			redirect('');
		}
	}
	
	public function index()
	{
		$this->load->view('auth/login');
    }
	
}
