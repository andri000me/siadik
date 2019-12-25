<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PropertiModel extends CI_Model {

    public function __construct()
    {
        $this->load->model('UserModel');
    }

    function fetch($where = [])
    {
        $this->db->select('*')->from('properti');

        if(!empty($where)){
            foreach($where as $key => $value){
                if($value != null){
                    $this->db->where($key, $value);
                }
            }
        }

        $this->db->order_by('kd_properti', 'desc');
        return $this->db->get();
    }

    function detail($where)
    {
        $this->db->select('*')->from('properti');

        if(!empty($where)){
            $this->db->where($where);
        }

        $this->db->limit(1);
        return $this->db->get();
    }

    function add($data)
    {
        $this->db->trans_start();
        $this->db->insert('properti', $data);
        $this->db->where('kd_foto', $data['kd_foto'])->update('survei_foto', ['status' => 'Konfirmasi']);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function edit($where, $data)
    {
      return $this->db->where($where)->update('properti', $data);
    }

    function delete($where)
    {
        $this->db->trans_start();
        $this->db->where('kd_properti', $where['kd_properti'])->delete('properti');
        $this->db->where('kd_foto', $where['kd_foto'])->update('survei_foto', ['status' => 'Proses']);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function hasOne($where){

        $data = $this->detail($where);

        if($data->num_rows() === 0){
            return null;
        } else {
            $properti = $data->row();

            $json['kd_properti'] = $properti->kd_properti;
            $json['telemarketing'] = $this->UserModel->hasOne(['id_user' => $properti->telemarketing]);
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

            return $json;
        }
    }
    
}

?>
