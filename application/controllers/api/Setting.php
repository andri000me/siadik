<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Setting extends CI_Controller {

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    function __construct()
    {
        parent::__construct();
        $this->__resTraitConstruct();

        $this->token    = $this->input->get_request_header('X-API-KEY', TRUE);
        $this->auth     = AUTHORIZATION::validateToken($this->token);

        $this->load->model('AuthModel');
    }

    public function change_password_put()
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 400);
        } else {
            $otorisasi = $this->auth;

            $config = array(
                array(
                    'field' => 'old_password',
                    'label' => 'Password Lama',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'new_password',
                    'label' => 'Password Baru',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'retype_password',
                    'label' => 'Ulangi Password',
                    'rules' => 'required|trim'
                )
            );
        
            $this->form_validation->set_data($this->put());
            $this->form_validation->set_rules($config);

            if(!$this->form_validation->run()){
                $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 400);
            }else{
                $where  = array('id_user' => $otorisasi->id_user);
                $fetch  = $this->AuthModel->cekAuth($where);

                if($fetch->num_rows() == 0){
                    $this->response(['status' => false, 'error' => 'User tidak ditemukan'], 400);
                } else {
                    $user = $fetch->row();

                    if(hash_equals($this->put('old_password'), $user->password)){
                        $data   = array(
                            'password' => $this->put('new_password')
                        );

                        $update = $this->AuthModel->updateAuth($where, $data);

                        if(!$update){
                            $this->response(array('status' => false, 'error' => 'Gagal mengganti password'), 500);
                        } else {
                            $this->response(array('status' => true, 'message' => 'Berhasil mengganti password'), 200);
                        }
                    } else {
                        $this->response(['status' => false, 'error' => 'Password salah'], 400);
                    }
                }
            }
        }
    }

    public function profile_get()
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 400);
        } else {
            $otorisasi = $this->auth;
        
            $where  = array('id_user' => $otorisasi->id_user);
            $profile  = $this->UserModel->detail($where)->row();

            if(!$profile){
                $this->response(['status' => false, 'error' => 'User tidak ditemukan'], 400);
            } else {
                $json = array();

                $json['id_user'] = $profile->id_user;
                $json['nama_lengkap'] = $profile->nama_lengkap;
                $json['telepon'] = $profile->telepon;
                $json['aktif'] = $profile->aktif;
                $json['level'] = $profile->level;
                $json['timestamps'] = array(
                    'created_at' => $profile->created_at,
                    'updated_at' => $profile->updated_at,
                );

                $data = $json;

                $this->response(['status' => true, 'message' => 'Berhasil menampilkan profile', 'data' => $data], 200);
            }
        }
    }
}
