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
                        ->order_by('id','DESC')
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

    public function check_coupon_exist($coupon_code){
        try {            
            $query = $this->db->where('code', $coupon_code)->get('coupons');
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function coupon_already_used($coupon_id,$user_id){
        try {            
            $query = $this->db->where('customer_id', $user_id)->where('coupon_id', $coupon_id)->get('user_payment_info');
            if ($query->num_rows() > 0) {
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