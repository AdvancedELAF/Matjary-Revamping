<?php

class CommonModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function template_list($id = NULL) {
        try {
            $this->db->select("mt.*,tc.id as category_id,tc.theme_cat_name as category_name");
            $this->db->from('matjary_templates as mt');
            $this->db->join('template_categories as tc','tc.id=mt.category_id','left');
            $this->db->where('mt.is_active', '1');
            if (!empty($id)) {
                $this->db->where('mt.id', $id);
            }
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                if (!empty($id)) {
                    return $query->row();
                }else{
                    return $query->result();
                }
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function template_details_id($template_id = NULL, $lang_var = NULL) {
        try {
            if (isset($lang_var) && !empty($lang_var)) {
                if ($lang_var == 'en') {
                    $this->db->select("id, name, path, description, template_full_banner, template_half_banner, demo_link, is_active, created_dt");
                } else {
                    $this->db->select("id, name_ar as name, path, description_ar as description, template_full_banner, template_half_banner, demo_link, is_active, created_dt");
                }
            } else {
                $this->db->select("id, name_ar as name, path, description_ar as description, template_full_banner, template_half_banner, demo_link, is_active, created_dt");
            }

            $this->db->from('matjary_templates');
            $this->db->where('id', $template_id);
            $query = $this->db->get();
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

    public function country_list($id = NULL) {
        try {
            $this->db->select("*");
            $this->db->from('countries');
            if (!empty($id)) {
                $this->db->where('id', $id);
            }
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function state_list($id = NULL) {
        try {
            $this->db->select("*");
            $this->db->from('states');
            if (!empty($id)) {
                $this->db->where('id', $id);
            } else {
                $this->db->where('id', '191');
            }

            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function city_list($id = NULL) {
        try {
            $this->db->select("*");
            $this->db->from('cities');
            if (!empty($id)) {
                $this->db->where('id', $id);
            }
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function get_plan_info($plan_id) {
        try {
            $query = $this->db->where('id', $plan_id)->get('plans');
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function get_country_states($country_id) {
       
        $this->db->select("*");
        $this->db->from('states');
        $this->db->where('country_id', $country_id);
        $this->db->order_by('name', 'ASCI');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_state_cities($state_id) {
     
        $this->db->select("*");
        $this->db->from('cities');
        $this->db->where('state_id', $state_id);
        $this->db->order_by('name', 'ASCI');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_country_state_city_name_by_id($country_id,$state_id,$city_id){
        $this->db->select("c.name as country_name,s.name as state_name,cities.name as city_name");
        $this->db->from('countries as c');
        $this->db->join('states as s','s.country_id=c.id','inner');
        $this->db->join('cities','cities.state_id=s.id','inner');
        $this->db->where('c.id', $country_id);
        $this->db->where('s.id', $state_id);
        $this->db->where('cities.id', $city_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function submit_contact_form_api($requestData) {
        try {
            $query = $this->db->insert('support_tickets', $requestData);
            if ($query == true) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function shipping_info() {
        try {
            $query = $this->db->get('shipping_info');
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

    public function check_template_purchased($template_id = NULL, $user_id = NULL) {
        try {
            $this->db->select("*");
            $this->db->from('user_store_templates');
            $this->db->where('template_id', $template_id);
            $this->db->where('user_id', $user_id);
            $this->db->where('template_active', 1);
            $query = $this->db->get();
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

    public function get_matjary_config($slag) {
        try {
            if($slag=='paytab'){
                $this->db->select("paytab_call_url,paytab_currency,paytab_profile_id_test,paytab_test_apikey,paytab_profile_id_live,paytab_live_apikey");
            }elseif($slag=='smtp'){
                $this->db->select("smpt_host,smpt_username,smpt_password,smtp_port,smtp_email_from");
            }elseif($slag=='sendgrid'){
                $this->db->select("sendgrid_email_from,sendgrid_bearer_token");
            }elseif($slag=='aramex'){
                $this->db->select("sendgrid_bearer_token,aramex_password_test,aramex_ac_no_test,aramex_ac_pin_test");
            }
            $this->db->from('credentials');
            $query = $this->db->get();
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

}

?>
