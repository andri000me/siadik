<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DealModel extends CI_Model {

    
    public function __construct()
    {
        $this->load->model('UserModel');
    }

    function fetch($where = [])
    {
        $this->db->select('*')->from('deal');

        if(!empty($where)){
            foreach($where as $key => $value){
                if($value != null){
                    $this->db->where($key, $value);
                }
            }
        }

        $this->db->order_by('kd_booking', 'desc');
        return $this->db->get();
    }

    function detail($where)
    {
        $this->db->select('*')->from('deal');

        if(!empty($where)){
            $this->db->where($where);
        }

        $this->db->limit(1);
        return $this->db->get();
    }

    function add($data)
    {
        $this->db->trans_start();
        $this->db->insert('deal', $data);
        $this->db->where('kd_properti', $data['kd_properti'])->update('properti', ['terjual' => 'Y']);
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
      return $this->db->where($where)->update('deal', $data);
    }

    function delete($where)
    {
      return $this->db->where($where)->delete('deal');
    }

    function hasOne($where){

        $data = $this->detail($where);

        if($data->num_rows() === 0){
            return null;
        } else {
            $deal = $data->row();

            $json['kd_booking'] = $deal->kd_booking;
            $json['tgl_deal'] = $deal->tgl_deal;
            $json['pembayaran_klien'] = base_url().'doc/deal/pembayaran_klien/'.$deal->pembayaran_klien;
            $json['pembayaran_pemilik'] = base_url().'doc/deal/pembayaran_pemilik/'.$deal->pembayaran_pemilik;
            $json['form_komisi'] = base_url().'doc/deal/form_komisi/'.$deal->form_komisi;
            $json['form_perjanjian'] = base_url().'doc/deal/form_perjanjian/'.$deal->form_perjanjian;
            $json['form_listing'] = base_url().'doc/deal/form_listing/'.$deal->form_listing;
            $json['keterangan'] = $deal->keterangan;

            return $json;
        }
    }
    
}

?>
