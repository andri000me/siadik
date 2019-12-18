<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model {

    function cekAuth($where)
    {
      return $this->db->select('*')->from('user')->where($where)->limit(1)->get();
    }

    function updateAuth($where, $data)
    {
      return $this->db->where($where)->update('user', $data);
    }
}

?>
