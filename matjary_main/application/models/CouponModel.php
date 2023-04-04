<?php

class CouponModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_data($requestData) {
        try {
            $query = $this->db->insert('coupons', $requestData);
            if ($query == true) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    
    public function coupons_list() {
        try {            
            $query = $this->db->select('*')
                        ->from('coupons')
                        ->where_in('is_active', array(1,2))
                        ->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }    
    
    public function get_single_coupon_details($id) {
        try {            
            $query = $this->db->where('id', $id)->get('coupons');
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public function update_data($data, $id) {
        try {            
            $this->db->where('id', $id);
            $updatedStatus = $this->db->update('coupons', $data);
            if ($updatedStatus) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}

?>