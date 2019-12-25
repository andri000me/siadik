<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

    function fetch($where = [])
    {
      $this->db->select('*')->from('user');

      if(!empty($where)){
          $this->db->where($where);
      }

      $this->db->order_by('id_user', 'desc');
      return $this->db->get();

      
    }

    function detail($where)
    {
        $this->db->select('*')->from('user');

        if(!empty($where)){
            $this->db->where($where);
        }

        $this->db->limit(1);
        return $this->db->get();
    }

    function add($data)
    {
      return $this->db->insert('user', $data);
    }

    function edit($where, $data)
    {
      return $this->db->where($where)->update('user', $data);
    }

    function delete($where)
    {
      return $this->db->where($where)->delete('user');
    }

    function hasOne($where){

        $data = $this->detail($where);

        if($data->num_rows() === 0){
            return null;
        } else {
            $user = $data->row();

            $json['id_user'] = $user->id_user;
            $json['nama_lengkap'] = $user->nama_lengkap;
            $json['telepon'] = $user->telepon;

            return $json;
        }
    }
    
}

?>
