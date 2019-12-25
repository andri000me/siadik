<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class User extends CI_Controller {

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

            $user   = $this->UserModel->fetch();
            $data   = array();

            if($user->num_rows() === 0){
                $this->response(['status' => false, 'message' => 'User tidak ditemukan', 'data' => []], 200);
            } else {
                foreach($user->result() as $key){
                    $json = array();

                    $json['id_user'] = $key->id_user;
                    $json['username'] = $key->username;
                    $json['nama_lengkap'] = $key->nama_lengkap;
                    $json['telepon'] = $key->telepon;
                    $json['aktif'] = $key->aktif;
                    $json['level'] = $key->level;
                    $json['timestamps'] = array(
                        'created_at' => $key->created_at,
                        'updated_at' => $key->updated_at,
                    );

                    $data[] = $json;
                }

                $this->response(['status' => true, 'message' => 'Berhasil menampilkan user', 'data' => $data], 200);
            }
        }
    }

    public function detail_get($id)
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 400);
        } else {
            $otorisasi  = $this->auth;

            $user   = $this->UserModel->detail(['id_user' => $id])->row();

            if(!$user){
                $this->response(['status' => false, 'error' => 'User tidak ditemukan'], 404);
            } else {
                $json = array();

                $json['id_user'] = $user->id_user;
                $json['username'] = $user->username;
                $json['nama_lengkap'] = $user->nama_lengkap;
                $json['telepon'] = $user->telepon;
                $json['aktif'] = $user->aktif;
                $json['level'] = $user->level;
                $json['timestamps'] = array(
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                );

                $data = $json;

                $this->response(['status' => true, 'message' => 'Berhasil menampilkan detail user', 'data' => $data], 200);
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
                    'field' => 'nama_lengkap',
                    'label' => 'Nama Lengkap',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'telepon',
                    'label' => 'Telepon',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'aktif',
                    'label' => 'Status',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'level',
                    'label' => 'Level',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'username',
                    'label' => 'Username',
                    'rules' => 'required|trim|is_unique[user.username]'
                ),
            );

            $this->form_validation->set_data($this->post());
            $this->form_validation->set_rules($config);

            if(!$this->form_validation->run()){
                $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 400);
            } else {
                $data = array(
                    'nama_lengkap' => $this->post('nama_lengkap'),
                    'username' => $this->post('username'),
                    'telepon' => $this->post('telepon'),
                    'aktif' => $this->post('aktif'),
                    'level' => $this->post('level'),
                    'password' => $this->post('username'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );

                $add = $this->UserModel->add($data);

                if(!$add){
                    $this->response(['status' => false, 'message' => 'Gagal menambahkan user'], 500);
                } else {
                    $this->response(['status' => true, 'message' => 'Berhasil menambahkan user', 'input_id' => $this->db->insert_id()], 200);
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

            $config = array(
                array(
                    'field' => 'nama_lengkap',
                    'label' => 'Nama Lengkap',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'telepon',
                    'label' => 'Telepon',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'aktif',
                    'label' => 'Status',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'level',
                    'label' => 'Level',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'username',
                    'label' => 'Username',
                    'rules' => 'required|trim'
                ),
            );

            $this->form_validation->set_data($this->put());
            $this->form_validation->set_rules($config);

            if(!$this->form_validation->run()){
                $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 400);
            } else {
                $user = $this->UserModel->detail(['id_user' => $id])->row();

                if(!$user){
                    $this->response(['status' => false, 'error' => 'User tidak ditemukan'], 404);
                } else {
                    $where  = array(
                        'id_user'   => $user->id_user 
                    );

                    $data = array(
                        'nama_lengkap' => $this->put('nama_lengkap'),
                        'username' => $this->put('username'),
                        'telepon' => $this->put('telepon'),
                        'aktif' => $this->put('aktif'),
                        'level' => $this->put('level'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    );

                    $edit = $this->UserModel->edit($where, $data);

                    if(!$edit){
                        $this->response(['status' => false, 'message' => 'Gagal mengedit user'], 500);
                    } else {
                        $this->response(['status' => true, 'message' => 'Berhasil mengedit user'], 200);
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

            $user = $this->UserModel->detail(['id_user' => $id])->row();

            if(!$user){
                 $this->response(['status' => false, 'error' => 'User tidak ditemukan'], 404);
            } else {
                $where  = array(
                    'id_user'   => $user->id_user 
                );

                $delete = $this->UserModel->delete($where);

                if(!$delete){
                    $this->response(['status' => false, 'message' => 'Gagal menghapus user'], 500);
                } else {
                    $this->response(['status' => true, 'message' => 'Berhasil menghapus user'], 200);
                }
            }
        } 
    }

}
