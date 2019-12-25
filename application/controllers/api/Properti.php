<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Properti extends CI_Controller {

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
            $properti   = $this->PropertiModel->fetch();
            $data   = array();

            if($properti->num_rows() === 0){
                $this->response(['status' => false, 'message' => 'Properti tidak ditemukan', 'data' => []], 200);
            } else {
                foreach($properti->result() as $key){
                    $json = array();

                    $json['kd_properti'] = $key->kd_properti;
                    $json['telemarketing'] = $this->UserModel->hasOne(['id_user' => $key->telemarketing]);
                    $json['survei_foto'] = $this->SurveiFotoModel->hasOne(['kd_foto' => $key->kd_foto]);
                    $json['iklan'] = $this->IklanModel->hasOne(['kd_properti' => $key->kd_properti]);
                    $json['nama_pemilik'] = $key->nama_pemilik;
                    $json['alamat_properti'] = $key->alamat_properti;
                    $json['terjual'] = $key->terjual;
                    $json['keterangan'] = $key->keterangan;
                    $json['timestamps'] = array(
                        'created_at' => $key->created_at,
                        'updated_at' => $key->updated_at,
                    );

                    $data[] = $json;
                }

                $this->response(['status' => true, 'message' => 'Berhasil menampilkan properti', 'data' => $data], 200);
            } 
        }
    }

    public function detail_get($id)
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 400);
        } else {
            $otorisasi  = $this->auth;
            $where = ['kd_properti' => $id];
            $properti   = $this->PropertiModel->detail($where)->row();

            if(!$properti){
                $this->response(['status' => false, 'error' => 'Properti tidak ditemukan'], 404);
            } else {
                $json = array();

                $json['kd_properti'] = $properti->kd_properti;
                $json['telemarketing'] = $this->UserModel->hasOne(['id_user' => $properti->telemarketing]);
                $json['survei_foto'] = $this->SurveiFotoModel->hasOne(['kd_foto' => $properti->kd_foto]);
                $json['iklan'] = $this->IklanModel->hasOne(['kd_properti' => $properti->kd_properti]);
                $json['nama_pemilik'] = $properti->nama_pemilik;
                $json['alamat_pemilik'] = $properti->alamat_pemilik;
                $json['telp'] = $properti->telp;
                $json['fax'] = $properti->fax;
                $json['email'] = $properti->email;
                $json['pic'] = $properti->pic;
                $json['status'] = $properti->status;
                $json['kondisi'] = $properti->kondisi;
                $json['jenis'] = $properti->jenis;
                $json['alamat_properti'] = $properti->alamat_properti;
                $json['luas_tanah'] = $properti->luas_tanah;
                $json['luas_bangunan'] = $properti->luas_bangunan;
                $json['panjang'] = $properti->panjang;
                $json['lebar'] = $properti->lebar;
                $json['sertifikat'] = $properti->sertifikat;
                $json['imb'] = $properti->imb;
                $json['orientasi'] = $properti->orientasi;
                $json['kamar'] = $properti->kamar;
                $json['listrik'] = $properti->listrik;
                $json['lantai'] = $properti->lantai;
                $json['kamar_mandi'] = $properti->kamar_mandi;
                $json['air'] = $properti->air;
                $json['jenis_lantai'] = $properti->jenis_lantai;
                $json['garasi'] = $properti->garasi;
                $json['line_tlp'] = $properti->line_tlp;
                $json['tahun'] = $properti->tahun;
                $json['fully_furnish'] = $properti->fully_furnish;
                $json['semi_furnish'] = $properti->semi_furnish;
                $json['harga_penawaran'] = $properti->harga_penawaran;
                $json['komisi'] = $properti->komisi;
                $json['terjual'] = $properti->terjual;
                $json['keterangan'] = $properti->keterangan;
                $json['timestamps'] = array(
                    'created_at' => $properti->created_at,
                    'updated_at' => $properti->updated_at,
                );

                $data = $json;

                $this->response(['status' => true, 'message' => 'Berhasil menampilkan properti', 'data' => $data], 200);
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
                    'field' => 'kd_foto',
                    'label' => 'Kode foto',
                    'rules' => 'required|trim|callback_cek_foto'
                ),
                array(
                    'field' => 'nama_pemilik',
                    'label' => 'Nama pemilik',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'alamat_pemilik',
                    'label' => 'Alamat pemilik',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'telp',
                    'label' => 'Telepon',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'pic',
                    'label' => 'PIC',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'status',
                    'label' => 'Status',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'kondisi',
                    'label' => 'Kondisi',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'jenis',
                    'label' => 'Jenis',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'alamat_properti',
                    'label' => 'Alamat properti',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'harga_penawaran',
                    'label' => 'Harga penawaran',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'komisi',
                    'label' => 'Komisi',
                    'rules' => 'required|trim'
                ),
            );

            $this->form_validation->set_data($this->post());
            $this->form_validation->set_rules($config);

            if(!$this->form_validation->run()){
                $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 400);
            } else {
                $kd_properti = $this->KodeModel->buat_kode('properti', 'PRT-'.date('mY').'-', 'kd_properti', 3);

                $data = array(
                    'kd_properti' => $kd_properti,
                    'telemarketing' => $otorisasi->id_user,
                    'kd_foto' => $this->post('kd_foto'),
                    'nama_pemilik' => $this->post('nama_pemilik'),
                    'alamat_pemilik' => $this->post('alamat_pemilik'),
                    'telp' => $this->post('telp'),
                    'fax' => $this->post('fax'),
                    'email' => $this->post('email'),
                    'pic' => $this->post('pic'),

                    'status' => $this->post('status'),
                    'kondisi' => $this->post('kondisi'),
                    'jenis' => $this->post('jenis'),
                    'alamat_properti' => $this->post('alamat_properti'),
                    'luas_tanah' => $this->post('luas_tanah'),
                    'luas_bangunan' => $this->post('luas_bangunan'),
                    'panjang' => $this->post('panjang'),
                    'lebar' => $this->post('lebar'),
                    'sertifikat' => $this->post('sertifikat'),
                    'imb' => $this->post('imb'),
                    'orientasi' => $this->post('orientasi'),
                    'kamar' => $this->post('kamar'),
                    'listrik' => $this->post('listrik'),
                    'lantai' => $this->post('lantai'),
                    'kamar_mandi' => $this->post('kamar_mandi'),
                    'air' => $this->post('air'),
                    'jenis_lantai' => $this->post('jenis_lantai'),
                    'garasi' => $this->post('garasi'),
                    'line_tlp' => $this->post('line_tlp'),
                    'tahun' => $this->post('tahun'),
                    'fully_furnish' => $this->post('fully_furnish'),
                    'semi_furnish' => $this->post('semi_furnish'),

                    'harga_penawaran' => $this->post('harga_penawaran'),
                    'komisi' => $this->post('komisi'),
                    'keterangan' => $this->post('keterangan'),
                    'terjual' => 'T',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );

                $add = $this->PropertiModel->add($data);

                if(!$add){
                    $this->response(['status' => false, 'message' => 'Gagal menambahkan properti'], 500);
                } else {
                    $this->response(['status' => true, 'message' => 'Berhasil menambahkan properti', 'input_id' => $kd_properti], 200);
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

            $properti = $this->PropertiModel->detail(['kd_properti' => $id])->row();

            if(!$properti){
                 $this->response(['status' => false, 'error' => 'Properti tidak ditemukan'], 404);
            } else {
                $where  = array(
                    'kd_properti'   => $properti->kd_properti,
                    'kd_foto'   => $properti->kd_foto
                );

                $delete = $this->PropertiModel->delete($where);

                if(!$delete){
                    $this->response(['status' => false, 'message' => 'Gagal menghapus properti'], 500);
                } else {
                    $this->response(['status' => true, 'message' => 'Berhasil menghapus properti'], 200);
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

    public function cek_foto($id){
        $where = array(
            'kd_foto' => $id
        );

        $cek   = $this->SurveiFotoModel->fetch($where)->num_rows();

        if ($cek == 0){
            $this->form_validation->set_message('cek_foto', 'Kode Foto tidak valid');
            return FALSE;
        } else {
            return TRUE;
        }
    }


}
