<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct()
    {
		parent::__construct();
        $this->load->library('session');
        
		if(!$this->session->has_userdata('logged_in') ){
			redirect('login');
		}
	}

	public function index()
	{
		$level = strtolower($this->session->userdata('level'));
		$this->load->view('main/'.$level);
    }
	
}
