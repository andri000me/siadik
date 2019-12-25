<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Deal extends CI_Controller {
	
	function __construct()
    {
        parent::__construct();
        $this->load->library('session');
	}
	
	public function index()
	{
		$this->load->view('deal/data');
    }
    
    public function detail($id)
	{
        $data['kd_booking'] = $id;
		$this->load->view('deal/detail', $data);
	}
	
    public function add()
	{
		$this->load->view('deal/add');
	}
	
    public function edit($id)
	{
        $data['kd_booking'] = $id;
		$this->load->view('deal/edit', $data);
    }

}
