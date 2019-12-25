<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SurveiFotoModel extends CI_Model {
    
    public function __construct()
    {
        $this->load->model('UserModel');
    }

    function fetch($where = [])
    {
        $this->db->select('*')->from('survei_foto');

        if(!empty($where)){
            $this->db->where($where);
        }

        $this->db->order_by('kd_foto', 'desc');
        return $this->db->get();
    }

    function detail($where)
    {
        $this->db->select('*')->from('survei_foto');

        if(!empty($where)){
            $this->db->where($where);
        }

        $this->db->limit(1);
        return $this->db->get();
    }

    function add($data)
    {
      return $this->db->insert('survei_foto', $data);
    }

    function edit($where, $data)
    {
      return $this->db->where($where)->update('survei_foto', $data);
    }

    function delete($where)
    {
      return $this->db->where($where)->delete('survei_foto');
    }

    function hasOne($where){

        $data = $this->detail($where);

        if($data->num_rows() === 0){
            return null;
        } else {
            $survei = $data->row();

            $json['kd_foto'] = $survei->kd_foto;
            $json['agen'] = $this->UserModel->hasOne(['id_user' => $survei->agen]);
            $json['alamat'] = $survei->alamat;
            $json['status'] = $survei->status;
            $json['foto_1'] = base_url().'doc/survei_foto/foto_1/'.$survei->foto_1;
            $json['foto_2'] = base_url().'doc/survei_foto/foto_2/'.$survei->foto_2;
            $json['foto_3'] = base_url().'doc/survei_foto/foto_3/'.$survei->foto_3;
            $json['foto_4'] = base_url().'doc/survei_foto/foto_4/'.$survei->foto_4;
            $json['foto_5'] = base_url().'doc/survei_foto/foto_5/'.$survei->foto_5;

            return $json;
        }
    }
    
}

?>
