<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Survei_foto extends CI_Controller {

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
            $survei   = $this->SurveiFotoModel->fetch();
            $data   = array();

            if($survei->num_rows() === 0){
                $this->response(['status' => false, 'message' => 'Survei foto tidak ditemukan', 'data' => []], 200);
            } else {
                foreach($survei->result() as $key){
                    $json = array();

                    $json['kd_foto'] = $key->kd_foto;
                    $json['agen'] = $this->UserModel->hasOne(['id_user' => $key->agen]);
                    $json['alamat'] = $key->alamat;
                    $json['status'] = $key->status;
                    $json['foto_1'] = base_url().'doc/survei_foto/foto_1/'.$key->foto_1;
                    $json['foto_2'] = base_url().'doc/survei_foto/foto_2/'.$key->foto_2;
                    $json['foto_3'] = base_url().'doc/survei_foto/foto_3/'.$key->foto_3;
                    $json['foto_4'] = base_url().'doc/survei_foto/foto_4/'.$key->foto_4;
                    $json['foto_5'] = base_url().'doc/survei_foto/foto_5/'.$key->foto_5;
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
            $survei   = $this->SurveiFotoModel->detail($where)->row();

            if(!$survei){
                $this->response(['status' => false, 'error' => 'Survei foto tidak ditemukan'], 404);
            } else {
                $json = array();

                $json['kd_foto'] = $survei->kd_foto;
                $json['agen'] = $this->UserModel->hasOne(['id_user' => $survei->agen]);
                $json['properti'] = $this->PropertiModel->hasOne(['kd_foto' => $survei->kd_foto]);
                $json['alamat'] = $survei->alamat;
                $json['status'] = $survei->status;
                $json['foto_1'] = base_url().'doc/survei_foto/foto_1/'.$survei->foto_1;
                $json['foto_2'] = base_url().'doc/survei_foto/foto_2/'.$survei->foto_2;
                $json['foto_3'] = base_url().'doc/survei_foto/foto_3/'.$survei->foto_3;
                $json['foto_4'] = base_url().'doc/survei_foto/foto_4/'.$survei->foto_4;
                $json['foto_5'] = base_url().'doc/survei_foto/foto_5/'.$survei->foto_5;
                $json['keterangan'] = $survei->keterangan;
                $json['timestamps'] = array(
                    'created_at' => $survei->created_at,
                    'updated_at' => $survei->updated_at,
                );

                $data = $json;

                $this->response(['status' => true, 'message' => 'Berhasil menampilkan survei', 'data' => $data], 200);
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
                    'field' => 'alamat',
                    'label' => 'Alamat',
                    'rules' => 'required|trim'
                )
            );

            $this->form_validation->set_data($this->post());
            $this->form_validation->set_rules($config);

            if(!$this->form_validation->run()){
                $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 400);
            } else {
                $kd_foto = $this->KodeModel->buat_kode('survei_foto', 'FT-'.date('mY').'-', 'kd_foto', 3);

                $data = array(
                    'kd_foto' => $kd_foto,
                    'agen' => $otorisasi->id_user,
                    'alamat' => $this->post('alamat'),
                    'status' => 'Proses',
                    'keterangan' => $this->post('keterangan'),
                    'foto_1' => $this->upload_foto('foto_1', $kd_foto),
                    'foto_2' => $this->upload_foto('foto_2', $kd_foto),
                    'foto_3' => $this->upload_foto('foto_3', $kd_foto),
                    'foto_4' => $this->upload_foto('foto_4', $kd_foto),
                    'foto_5' => $this->upload_foto('foto_5', $kd_foto),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );

                $add = $this->SurveiFotoModel->add($data);

                if(!$add){
                    $this->response(['status' => false, 'message' => 'Gagal menambahkan survei foto'], 500);
                } else {
                    $this->response(['status' => true, 'message' => 'Berhasil menambahkan survei foto', 'input_id' => $kd_foto], 200);
                }
            }
        } 
    }

    public function edit_post($id)
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 400);
        } else {
            $otorisasi  = $this->auth;

            $config = array(
                array(
                    'field' => 'alamat',
                    'label' => 'Alamat',
                    'rules' => 'required|trim'
                )
            );

            $this->form_validation->set_data($this->put());
            $this->form_validation->set_rules($config);

            if(!$this->form_validation->run()){
                $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 400);
            } else {
                $survei = $this->SurveiFotoModel->detail(['kd_foto' => $id])->row();

                if(!$survei){
                    $this->response(['status' => false, 'error' => 'Survei foto tidak ditemukan'], 404);
                } else {
                    $where  = array(
                        'kd_foto'   => $survei->kd_foto 
                    );

                    $data = array(
                        'alamat' => $this->post('alamat'),
                        'keterangan' => $this->post('keterangan'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );

                    for($i = 1; $i <= 5; $i++){
                        $foto = $this->upload_foto('foto_'.$i, $survei->kd_foto);

                        if($foto !== null){
                            $data['foto_'.$i] = $foto;
                        }
                    }
                    
                    $edit = $this->SurveiFotoModel->edit($where, $data);

                    if(!$edit){
                        $this->response(['status' => false, 'message' => 'Gagal mengedit survei foto'], 500);
                    } else {
                        $this->response(['status' => true, 'message' => 'Berhasil mengedit survei foto', 'update_id' => $survei->kd_foto], 200);
                    }
                }
            }
        } 
    }

    public function delete_delete($id)
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 400);
        } else {

            $survei = $this->SurveiFotoModel->detail(['kd_foto' => $id])->row();

            if(!$survei){
                 $this->response(['status' => false, 'error' => 'Survei foto tidak ditemukan'], 404);
            } else {
                $where  = array(
                    'kd_foto'   => $survei->kd_foto 
                );

                $delete = $this->SurveiFotoModel->delete($where);

                if(!$delete){
                    $this->response(['status' => false, 'message' => 'Gagal menghapus survei foto'], 500);
                } else {
                    $this->upload_foto('foto_1', $id);
                    $this->upload_foto('foto_2', $id);
                    $this->upload_foto('foto_3', $id);
                    $this->upload_foto('foto_4', $id);
                    $this->upload_foto('foto_5', $id);
                    $this->response(['status' => true, 'message' => 'Berhasil menghapus survei foto'], 200);
                }
            }
        } 
    }

    public function update_status_put($id)
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 400);
        } else {

            $survei = $this->SurveiFotoModel->detail(['kd_foto' => $id])->row();

            if(!$survei){
                 $this->response(['status' => false, 'error' => 'Survei foto tidak ditemukan'], 404);
            } else {
                
                $config = array(
                    array(
                        'field' => 'status',
                        'label' => 'Status',
                        'rules' => 'required|trim'
                    )
                );

                $this->form_validation->set_data($this->put());
                $this->form_validation->set_rules($config);

                if(!$this->form_validation->run()){
                    $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 400);
                } else {
                    $where  = array(
                        'kd_foto'   => $survei->kd_foto 
                    );

                    $data = array(
                        'status' => $this->put('status')
                    );

                    $update = $this->SurveiFotoModel->edit($where, $data);

                    if(!$update){
                        $this->response(['status' => false, 'message' => 'Gagal update survei foto'], 500);
                    } else {
                        $this->response(['status' => true, 'message' => 'Berhasil update survei foto'], 200);
                    }
                }
            }
        } 
    }

    public function delete_foto($name, $id){
        $files = glob('doc/survei_foto/'.$name.'/'.$id.'.*');
        foreach ($files as $key) {
            unlink($key);
        }
    }

    public function upload_foto($name, $id){
        $config['upload_path']   = './doc/survei_foto/'.$name.'/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx';
        $config['overwrite']     = TRUE;
        $config['max_size']      = '3048';
        $config['remove_space']  = TRUE;
        $config['file_name']     = $id;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if(!$this->upload->do_upload($name)){
            return null;
        } else {
            $file = $this->upload->data();
            return $file['file_name'];
        }
    }

}
