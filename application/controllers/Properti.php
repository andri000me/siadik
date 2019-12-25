<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Properti extends CI_Controller {
	
	function __construct()
    {
        parent::__construct();
        $this->load->library('session');
	}
	
	public function index()
	{
		$this->load->view('properti/data');
    }
    
    public function detail($id)
	{
        $data['kd_properti'] = $id;
		$this->load->view('properti/detail', $data);
	}
	
    public function add()
	{
		$this->load->view('properti/add');
	}
	
    public function edit($id)
	{
        $data['kd_properti'] = $id;
		$this->load->view('properti/edit', $data);
    }

}
