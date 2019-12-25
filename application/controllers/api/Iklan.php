<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Iklan extends CI_Controller {

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    } 

    function __construct()
    {
        parent::__construct();
        $this->__resTraitConstruct();

        $this->token    = $this->input->get_request_header('X-API-KEY', TRUE);
        $this->auth     = AUTHORIZATION::validateToken($this->token);
    }

    
    public function index_get()
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 400);
        } else {
            $otorisasi  = $this->auth;
            $iklan   = $this->IklanModel->fetch();
            $data   = array();

            if($iklan->num_rows() === 0){
                $this->response(['status' => false, 'message' => 'Iklan foto tidak ditemukan', 'data' => []], 200);
            } else {
                foreach($iklan->result() as $key){
                    $json = array();

                    $json['kd_hos'] = $key->kd_hos;
                    $json['advertising'] = $this->UserModel->hasOne(['id_user' => $key->advertising]);
                    $json['properti'] = $this->PropertiModel->hasOne(['kd_properti' => $key->kd_properti]);
                    $json['keterangan'] = $key->keterangan;
                    $json['timestamps'] = array(
                        'created_at' => $key->created_at,
                        'updated_at' => $key->updated_at,
                    );

                    $data[] = $json;
                }

                $this->response(['status' => true, 'message' => 'Berhasil menampilkan survei', 'data' => $data], 200);
            } 
        }
    }

    public function detail_get($id)
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 400);
        } else {
            $otorisasi  = $this->auth;
            $where = ['kd_foto' => $id];
            $iklan   = $this->IklanModel->detail($where)->row();

            if(!$iklan){
                $this->response(['status' => false, 'error' => 'Iklan tidak ditemukan'], 404);
            } else {
                $json = array();

                $json['kd_hos'] = $iklan->kd_hos;
                $json['telemarketing'] = $this->UserModel->hasOne(['id_user' => $iklan->telemarketing]);
                $json['properti'] = $this->PropertiModel->hasOne(['kd_properti' => $iklan->kd_properti]);
                $json['keterangan'] = $iklan->keterangan;
                $json['timestamps'] = array(
                    'created_at' => $iklan->created_at,
                    'updated_at' => $iklan->updated_at,
                );

                $data = $json;

                $this->response(['status' => true, 'message' => 'Berhasil menampilkan iklan', 'data' => $data], 200);
            }
        }
    }

    public function add_post()
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 400);
        } else {
            $otorisasi  = $this->auth;

            $config = array(
                array(
                    'field' => 'kd_properti',
                    'label' => 'Kode Properti',
                    'rules' => 'required|trim|callback_cek_properti'
                )
            );

            $this->form_validation->set_data($this->post());
            $this->form_validation->set_rules($config);

            if(!$this->form_validation->run()){
                $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 400);
            } else {
                $kd_hos = $this->KodeModel->buat_kode('iklan', 'HOS-'.date('mY').'-', 'kd_hos', 3);

                $data = array(
                    'kd_hos' => $kd_hos,
                    'kd_properti' => $this->post('kd_properti'),
                    'advertising' => $otorisasi->id_user,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );

                $add = $this->IklanModel->add($data);

                if(!$add){
                    $this->response(['status' => false, 'message' => 'Gagal menambahkan iklan'], 500);
                } else {
                    $this->response(['status' => true, 'message' => 'Berhasil menambahkan iklan', 'input_id' => $kd_hos], 200);
                }
            }
        } 
    }

    public function edit_put($id)
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 400);
        } else {
            $otorisasi  = $this->auth;

            $iklan = $this->IklanModel->detail(['kd_hos' => $id])->row();

            if(!$iklan){
                $this->response(['status' => false, 'error' => 'Iklan tidak ditemukan'], 404);
            } else {
                $where  = array(
                    'kd_hos'   => $iklan->kd_hos 
                );

                $data = array(
                    'keterangan' => $this->put('keterangan'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                
                $edit = $this->IklanModel->edit($where, $data);

                if(!$edit){
                    $this->response(['status' => false, 'message' => 'Gagal mengedit iklan'], 500);
                } else {
                    $this->response(['status' => true, 'message' => 'Berhasil mengedit iklan', 'update_id' => $iklan->kd_hos], 200);
                }
            }
        } 
    }
    
    public function delete_delete($id)
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 400);
        } else {

            $iklan = $this->IklanModel->detail(['kd_hos' => $id])->row();

            if(!$iklan){
                 $this->response(['status' => false, 'error' => 'Iklan tidak ditemukan'], 404);
            } else {
                $where  = array(
                    'kd_hos'   => $iklan->kd_hos 
                );

                $delete = $this->IklanModel->delete($where);

                if(!$delete){
                    $this->response(['status' => false, 'message' => 'Gagal menghapus iklan'], 500);
                } else {
                    $this->response(['status' => true, 'message' => 'Berhasil menghapus iklan'], 200);
                }
            }
        } 
    }

    public function cek_properti($id){
        $where = array(
            'kd_properti' => $id,
        );

        $cek   = $this->PropertiModel->fetch($where)->num_rows();

        if ($cek == 0){
            $this->form_validation->set_message('cek_properti', 'Properti tidak valid');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
