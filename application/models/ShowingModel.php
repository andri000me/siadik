<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ShowingModel extends CI_Model {

    
    public function __construct()
    {
        $this->load->model('UserModel');
    }

    function fetch($where = [])
    {
        $this->db->select('*')->from('showing');

        if(!empty($where)){
            foreach($where as $key => $value){
                if($value != null){
                    $this->db->where($key, $value);
                }
            }
        }

        $this->db->order_by('kd_showing', 'desc');
        return $this->db->get();
    }

    function detail($where)
    {
        $this->db->select('*')->from('showing');

        if(!empty($where)){
            $this->db->where($where);
        }

        $this->db->limit(1);
        return $this->db->get();
    }

    function add($data)
    {
        return $this->db->insert('showing', $data);
    }

    function edit($where, $data)
    {
      return $this->db->where($where)->update('showing', $data);
    }

    function delete($where)
    {
      return $this->db->where($where)->delete('showing');
    }

    function hasMany($where){

        $data = $this->detail($where);

        if($data->num_rows() === 0){
            return null;
        } else {
            $showing = $data->row();
            $data = array();

            foreach($showing->results() as $key){
                $json = array();

                $json['kd_showing'] = $key->kd_showing;
                $json['cs'] = $this->UserModel->hasOne(['id_user' => $key->cs]);
                $json['nama_klien'] = $key->nama_klien;
                $json['tlp_klien'] = $key->tlp_klien;
                $json['tgl_showing'] = $key->tgl_showing;
                $json['jam_showing'] = $key->jam_showing;
                $json['keterangan'] = $key->keterangan;

                $data[] = $json;
            }

            return $data;
        }
    }
    
}

?>
