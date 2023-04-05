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
                'upi.*,
                us.plan_id,
                us.plan_month,
                us.plan_start_dt,
                us.plan_expiry_dt,
                us.store_link,
                us.store_admin_link,
                us.subscription_type,
                us.is_active,
                us.site_status,
                us.created_at,
                u.id,
				u.fname,
				u.lname,
				u.email,
				u.phone_no,
                u.address,
                u.country_id,
                u.state_id,
                u.city_id,
                u.zipcode,
                u.is_active,
                u.is_free_trail_store_used,
				u.fax_no,
                p.plan_name,
                p.plan_desc,
                p.price,
                p.validity_in_months,
                mt.name as template_name
                '
            )
            ->from('user_payment_info as upi')
            ->join('user_subscriptions as us', 'us.id=upi.user_subscriptions_id', 'left')
            ->join('users as u', 'u.id=upi.customer_id', 'left')
            ->join('plans as p', 'p.id=us.plan_id', 'left')
            ->join('matjary_templates as mt', 'mt.id=upi.template_id', 'left')           
            ->where('u.is_active', 1)
            ->where('us.is_active', 1)
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

    public function get_user_store_payment_info($id) {
        try {
            $query = $this->db->select(
                '
                upi.*,
                us.plan_id,
                us.plan_month,
                us.plan_start_dt,
                us.plan_expiry_dt,
                us.store_link,
                us.store_admin_link,
                us.subscription_type,
                us.is_active,
                us.site_status,
                us.created_at,
                u.fname,
				u.lname,
                p.plan_name,
                p.plan_desc,
                p.price,
                p.validity_in_months,
                mt.name as template_name
                '
            )
            ->from('user_payment_info as upi')
            ->join('user_subscriptions as us', 'us.id=upi.user_subscriptions_id', 'left')
            ->join('plans as p', 'p.id=us.plan_id', 'left')
            ->join('matjary_templates as mt', 'mt.id=upi.template_id', 'left')
            ->join('users as u', 'u.id=upi.customer_id', 'left')
            ->where('upi.customer_id', $id)
            ->where('us.subscription_type', 2)
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