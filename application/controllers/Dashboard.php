<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
    {
		parent::__construct();
        $this->load->library('session');
        
		if(!$this->session->has_userdata('logged_in') ){
			redirect('errors/session_expired');
		}
	}

	public function index()
	{
		$level = strtolower($this->session->userdata('level'));
		$this->load->view('dashboard/'.$level);
    }
	
}
