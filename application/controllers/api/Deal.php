<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Deal extends CI_Controller {

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

            $deal   = $this->DealModel->fetch($where);
            $data   = array();

            if($deal->num_rows() === 0){
                $this->response(['status' => false, 'message' => 'Deal tidak ditemukan', 'data' => []], 200);
            } else {
                foreach($deal->result() as $key){
                    $json = array();

                    $json['kd_booking'] = $key->kd_booking;
                    $json['properti'] = $this->PropertiModel->hasOne(['kd_properti' => $key->kd_properti]);
                    $json['agen'] = $this->UserModel->hasOne(['id_user' => $key->agen]);
                    $json['tgl_deal'] = $key->tgl_deal;
                    $json['pembayaran_klien'] = base_url().'doc/deal/pembayaran_klien/'.$key->pembayaran_klien;
                    $json['pembayaran_pemilik'] = base_url().'doc/deal/pembayaran_pemilik/'.$key->pembayaran_pemilik;
                    $json['form_komisi'] = base_url().'doc/deal/form_komisi/'.$key->form_komisi;
                    $json['form_perjanjian'] = base_url().'doc/deal/form_perjanjian/'.$key->form_perjanjian;
                    $json['form_listing'] = base_url().'doc/deal/form_listing/'.$key->form_listing;
                    $json['keterangan'] = $key->keterangan;
                    $json['timestamps'] = array(
                        'created_at' => $key->created_at,
                        'updated_at' => $key->updated_at,
                    );

                    $data[] = $json;
                }

                $this->response(['status' => true, 'message' => 'Berhasil menampilkan deal', 'data' => $data], 200);
            } 
        }
    }

    public function detail_get($id)
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 400);
        } else {
            $otorisasi  = $this->auth;
            $where = ['kd_booking' => $id];
            $deal   = $this->DealModel->detail($where)->row();

            if(!$deal){
                $this->response(['status' => false, 'error' => 'Deal foto tidak ditemukan'], 404);
            } else {
                $json = array();

                $json['kd_booking'] = $deal->kd_booking;
                $json['properti'] = $this->PropertiModel->hasOne(['kd_properti' => $deal->kd_properti]);
                $json['agen'] = $this->UserModel->hasOne(['id_user' => $deal->agen]);
                $json['tgl_deal'] = $deal->tgl_deal;
                $json['pembayaran_klien'] = base_url().'doc/deal/pembayaran_klien/'.$deal->pembayaran_klien;
                $json['pembayaran_pemilik'] = base_url().'doc/deal/pembayaran_pemilik/'.$deal->pembayaran_pemilik;
                $json['form_komisi'] = base_url().'doc/deal/form_komisi/'.$deal->form_komisi;
                $json['form_perjanjian'] = base_url().'doc/deal/form_perjanjian/'.$deal->form_perjanjian;
                $json['form_listing'] = base_url().'doc/deal/form_listing/'.$deal->form_listing;
                $json['keterangan'] = $deal->keterangan;
                $json['timestamps'] = array(
                    'created_at' => $deal->created_at,
                    'updated_at' => $deal->updated_at,
                );

                $data = $json;

                $this->response(['status' => true, 'message' => 'Berhasil menampilkan deal', 'data' => $data], 200);
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
                    'field' => 'tgl_deal',
                    'label' => 'Tanggal Deal',
                    'rules' => 'required|trim'
                ),
            );

            $this->form_validation->set_data($this->post());
            $this->form_validation->set_rules($config);

            if(!$this->form_validation->run()){
                $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 400);
            } else {
                $kd_booking = $this->KodeModel->buat_kode('deal', 'BK-'.date('mY').'-', 'kd_booking', 3);

                $data = array(
                    'kd_booking' => $kd_booking,
                    'kd_properti' => $this->post('kd_properti'),
                    'agen' => $otorisasi->id_user,
                    'tgl_deal' => date('Y-m-d', strtotime($this->post('tgl_deal'))),
                    'form_listing' => $this->upload_foto('form_listing', $kd_booking),
                    'form_komisi' => $this->upload_foto('form_komisi', $kd_booking),
                    'form_perjanjian' => $this->upload_foto('form_perjanjian', $kd_booking),
                    'pembayaran_klien' => $this->upload_foto('pembayaran_klien', $kd_booking),
                    'pembayaran_pemilik' => $this->upload_foto('pembayaran_pemilik', $kd_booking),
                    'keterangan' => $this->post('keterangan'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );

                $add = $this->DealModel->add($data);

                if(!$add){
                    $this->response(['status' => false, 'message' => 'Gagal menambahkan deal'], 500);
                } else {
                    $this->response(['status' => true, 'message' => 'Berhasil menambahkan deal', 'input_id' => $kd_booking], 200);
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

            $deal = $this->DealModel->detail(['kd_booking' => $id])->row();

            if(!$deal){
                 $this->response(['status' => false, 'error' => 'Deal tidak ditemukan'], 404);
            } else {
                $where  = array(
                    'kd_booking'   => $deal->kd_booking 
                );

                $delete = $this->DealModel->delete($where);

                if(!$delete){
                    $this->response(['status' => false, 'message' => 'Gagal menghapus deal'], 500);
                } else {
                    $this->upload_foto('form_listing', $id);
                    $this->upload_foto('form_komisi', $id);
                    $this->upload_foto('form_perjanjian', $id);
                    $this->upload_foto('pembayaran_klien', $id);
                    $this->upload_foto('pembayaran_pemilik', $id);
                    $this->response(['status' => true, 'message' => 'Berhasil menghapus deal'], 200);
                }
            }
        } 
    }

    public function report_post()
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 400);
        } else {
           $otorisasi  = $this->auth;

            $config = array(
                array(
                    'field' => 'bulan',
                    'label' => 'Bulan',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'tahun',
                    'label' => 'Tahun',
                    'rules' => 'required|trim'
                ),
            );

            $this->form_validation->set_data($this->post());
            $this->form_validation->set_rules($config);

            if(!$this->form_validation->run()){
                $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 400);
            } else {

                $where = array(
                    'MONTH(tgl_deal)'  => $this->post('bulan'),
                    'YEAR(tgl_deal)'   => $this->post('tahun')
                );

                $deal   = $this->DealModel->fetch($where);
                $data   = array();

                if($deal->num_rows() === 0){
                    $this->response(['status' => false, 'message' => 'Report tidak ditemukan', 'data' => []], 200);
                } else {
                    foreach($deal->result() as $key){
                        $json = array();

                        $json['kd_booking'] = $key->kd_booking;
                        $json['properti'] = $this->PropertiModel->hasOne(['kd_properti' => $key->kd_properti]);
                        $json['agen'] = $this->UserModel->hasOne(['id_user' => $key->agen]);
                        $json['tgl_deal'] = $key->tgl_deal;
                        $json['keterangan'] = $key->keterangan;
                        $json['timestamps'] = array(
                            'created_at' => $key->created_at,
                            'updated_at' => $key->updated_at,
                        );

                        $data[] = $json;
                    }

                    $this->response(['status' => true, 'message' => 'Berhasil menampilkan report', 'data' => $data, 'periode' => ['bulan' =>  $this->post('bulan'), 'tahun' => $this->post('tahun')]], 200);
                } 
            }
            
        }
    }

    public function delete_foto($name, $id){
        $files = glob('doc/deal/'.$name.'/'.$id.'.*');
        foreach ($files as $key) {
            unlink($key);
        }
    }

    public function upload_foto($name, $id){
        $config['upload_path']   = './doc/deal/'.$name.'/';
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

}
