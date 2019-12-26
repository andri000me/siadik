<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Showing extends CI_Controller {

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

            if($otorisasi->level === 'agen'){
                $where = ['agen' => $otorisasi->id_user];
            } else {
                $where = [];
            }

            $showing   = $this->ShowingModel->fetch($where);
            $data   = array();

            if($showing->num_rows() === 0){
                $this->response(['status' => false, 'message' => 'Showing tidak ditemukan', 'data' => []], 200);
            } else {
                foreach($showing->result() as $key){
                    $json = array();

                    $json['kd_showing'] = $key->kd_showing;
                    $json['properti'] = $this->PropertiModel->hasOne(['kd_properti' => $key->kd_properti]);
                    $json['cs'] = $this->UserModel->hasOne(['id_user' => $key->cs]);
                    $json['agen'] = $this->UserModel->hasOne(['id_user' => $key->agen]);
                    $json['nama_klien'] = $key->nama_klien;
                    $json['tlp_klien'] = $key->tlp_klien;
                    $json['tgl_showing'] = $key->tgl_showing;
                    $json['jam_showing'] = $key->jam_showing;
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
            $where = ['kd_showing' => $id];
            $showing   = $this->ShowingModel->detail($where)->row();

            if(!$showing){
                $this->response(['status' => false, 'error' => 'Showing tidak ditemukan'], 404);
            } else {
                $json = array();

                $json['kd_showing'] = $showing->kd_showing;
                $json['properti'] = $this->PropertiModel->hasOne(['kd_properti' => $showing->kd_properti]);
                $json['cs'] = $this->UserModel->hasOne(['id_user' => $showing->cs]);
                $json['agen'] = $this->UserModel->hasOne(['id_user' => $showing->agen]);
                $json['nama_klien'] = $showing->nama_klien;
                $json['tlp_klien'] = $showing->tlp_klien;
                $json['tgl_showing'] = $showing->tgl_showing;
                $json['jam_showing'] = $showing->jam_showing;
                $json['keterangan'] = $showing->keterangan;
                $json['timestamps'] = array(
                    'created_at' => $showing->created_at,
                    'updated_at' => $showing->updated_at,
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
                ),
                array(
                    'field' => 'agen',
                    'label' => 'Agen',
                    'rules' => 'required|trim|callback_cek_agen'
                ),
                array(
                    'field' => 'nama_klien',
                    'label' => 'Nama Klien',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'tlp_klien',
                    'label' => 'Telepon',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'tgl_showing',
                    'label' => 'Tgl Showing',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'jam_showing',
                    'label' => 'Jam Showing',
                    'rules' => 'required|trim'
                ),
            );

            $this->form_validation->set_data($this->post());
            $this->form_validation->set_rules($config);

            if(!$this->form_validation->run()){
                $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 400);
            } else {
                $kd_showing = $this->KodeModel->buat_kode('showing', 'SW-', 'kd_showing', 8);

                $data = array(
                    'kd_showing' => $kd_showing,
                    'kd_properti' => $this->post('kd_properti'),
                    'cs' => $otorisasi->id_user,
                    'agen' => $this->post('agen'),
                    'nama_klien' => $this->post('nama_klien'),
                    'tlp_klien' => $this->post('tlp_klien'),
                    'tgl_showing' => date("Y-m-d", strtotime($this->post('tgl_showing'))),
                    'jam_showing' => $this->post('jam_showing'),
                    'keterangan' => $this->post('keterangan'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );

                $add = $this->ShowingModel->add($data);

                if(!$add){
                    $this->response(['status' => false, 'message' => 'Gagal menambahkan showing'], 500);
                } else {
                    $this->response(['status' => true, 'message' => 'Berhasil menambahkan showing', 'input_id' => $kd_showing], 200);
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

            $showing = $this->ShowingModel->detail(['kd_showing' => $id])->row();

            if(!$showing){
                 $this->response(['status' => false, 'error' => 'Showing tidak ditemukan'], 404);
            } else {
                $where  = array(
                    'kd_showing'   => $showing->kd_showing 
                );

                $delete = $this->ShowingModel->delete($where);

                if(!$delete){
                    $this->response(['status' => false, 'message' => 'Gagal menghapus showing'], 500);
                } else {
                    $this->response(['status' => true, 'message' => 'Berhasil menghapus showing'], 200);
                }
            }
        } 
    }

    public function cek_properti($id){
        $where = array(
            'kd_properti' => $id,
            'terjual' => 'T'
        );

        $cek   = $this->PropertiModel->fetch($where)->num_rows();

        if ($cek == 0){
            $this->form_validation->set_message('cek_properti', 'Properti tidak valid');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function cek_agen($id){
        $where = array(
            'id_user' => $id
        );

        $cek   = $this->UserModel->fetch($where)->num_rows();

        if ($cek == 0){
            $this->form_validation->set_message('cek_agen', 'Agen tidak valid');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
