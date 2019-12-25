<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Survei_foto extends CI_Controller {
	
	function __construct()
    {
        parent::__construct();
        $this->load->library('session');
	}
	
	public function index()
	{
		$this->load->view('survei_foto/data');
    }
    
    public function detail($id)
	{
        $data['kd_foto'] = $id;
		$this->load->view('survei_foto/detail', $data);
	}
	
    public function add()
	{
		$this->load->view('survei_foto/add');
	}
	
    public function edit($id)
	{
        $data['kd_foto'] = $id;
		$this->load->view('survei_foto/edit', $data);
	}
	
	public function confirm($id)
	{
		$data['kd_foto'] = $id;
		$this->load->view('properti/add', $data);
	}

}
