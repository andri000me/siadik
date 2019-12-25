<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class IklanModel extends CI_Model {

    
    public function __construct()
    {
        $this->load->model('UserModel');
    }

    function fetch($where = [])
    {
        $this->db->select('*')->from('iklan');

        if(!empty($where)){
            foreach($where as $key => $value){
                if($value != null){
                    $this->db->where($key, $value);
                }
            }
        }

        $this->db->order_by('kd_hos', 'desc');
        return $this->db->get();
    }

    function detail($where)
    {
        $this->db->select('*')->from('iklan');

        if(!empty($where)){
            $this->db->where($where);
        }

        $this->db->limit(1);
        return $this->db->get();
    }

    function add($data)
    {
        return $this->db->insert('iklan', $data);
    }

    function edit($where, $data)
    {
      return $this->db->where($where)->update('iklan', $data);
    }

    function delete($where)
    {
      return $this->db->where($where)->delete('iklan');
    }

    function hasOne($where){

        $data = $this->detail($where);

        if($data->num_rows() === 0){
            return null;
        } else {
            $iklan = $data->row();

            $json['kd_hos'] = $iklan->kd_hos;
            $json['advertising'] = $this->UserModel->hasOne(['id_user' => $iklan->advertising]);

            return $json;
        }
    }
    
}

?>
