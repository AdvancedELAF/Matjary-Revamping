<?php

class PlanModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_data($requestData) {
        try {
            $query = $this->db->insert('plans', $requestData);
            if ($query == true) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    
    public function plans_list() {
        try {            
            $query = $this->db->select('*')
                        ->from('plans')
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
    
    public function insert_data_plans($requestData) {
        try {
            $query = $this->db->insert('plans_features', $requestData);
            if ($query == true) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }  

    public function get_single_plan_details($id) {
        try {            
            $query = $this->db->where('id', $id)->get('plans');
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    
    public function plan_fetaure_list($planId) {
        try {            
            $query = $this->db->where('plan_id', $planId)->get('plans_features');
            if ($query->num_rows() > 0) {
                return $query->result();
            }else{
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update_data_plan($data, $id) {
        try {            
            $this->db->where('id', $id);
            $updatedStatus = $this->db->update('plans', $data);
            if ($updatedStatus) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function remove_plan_features($plan_id){
        try {            
            $removeStatus = $this->db->where('plan_id', $plan_id)->delete('plans_features');
            if ($removeStatus) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /* Store list Module Start */
    
    public function stores_list() { 
        try {   
            
            $query = $this->db->select(
                '
                us.id,
                us.plan_id,
                us.plan_start_dt,
                us.plan_expiry_dt,
                us.store_link,
                us.is_active, 
                us.store_sub_domain,         
                u.id as user_id,
				u.fname,
				u.lname,	             
                p.plan_name

                '
            )
            ->from('user_subscriptions as us')
            ->join('users as u', 'u.id=us.user_id', 'left')
            ->join('plans as p', 'p.id=us.plan_id', 'left') 
            ->where('us.is_active', 1)
            ->order_by('us.id','DESC')
            ->get();
                       
            if ($query->num_rows() > 0) {
                $rowData = $query->result();
                return $rowData;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function get_store_info($id) {
        try {
            $query = $this->db->select(
                '
                us.id,              
                us.plan_id,
                us.user_id,
                us.plan_month,
                us.plan_start_dt,
                us.plan_expiry_dt,
                us.store_link,
                us.store_admin_link,
                us.subscription_type,
                us.store_sub_domain,
                us.is_active,
                us.created_at,
                u.fname,
				u.lname,
                p.plan_name,
                p.plan_desc,
                p.price,
                p.validity_in_months,
                upi.customer_id,
                upi.plan_cost,
                upi.template_cost,
                upi.total_price,
                upi.order_status,
                upi.payment_status,
                upi.payment_type,
                upi.coupon_id,
                upi.coupon_amount,
                upi.plan_cost,                
                upi.is_coupon_applied,
                mt.name as template_name,
                c.discount_in_percent             
                '
            )
            ->from('user_subscriptions as us')
            ->join('user_payment_info as upi', 'upi.user_subscriptions_id=us.id', 'left')
            ->join('plans as p', 'p.id=us.plan_id', 'left')
            ->join('matjary_templates as mt', 'mt.id=us.template_id', 'left')
            ->join('users as u', 'u.id=us.user_id', 'left')
            ->join('coupons as c', 'c.id=upi.coupon_id', 'left')
            ->where('us.id', $id)
            ->where('us.is_active', 1)
            ->get();

            if ($query->num_rows() > 0) {
                $rowData = $query->row();
                return $rowData;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /* Store list Module End */

    
}

?>