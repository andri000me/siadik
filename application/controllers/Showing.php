<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Showing extends CI_Controller {
	
	function __construct()
    {
        parent::__construct();
        $this->load->library('session');
	}
	
	public function index()
	{
		$this->load->view('showing/data');
    }
    
    public function detail($id)
	{
        $data['kd_showing'] = $id;
		$this->load->view('showing/detail', $data);
	}
	
    public function add()
	{
		$this->load->view('showing/add');
	}
	
    public function edit($id)
	{
        $data['kd_showing'] = $id;
		$this->load->view('showing/edit', $data);
    }

}
