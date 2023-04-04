<?php

class WebModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->check_db = $this->load->database('check_db', TRUE);
    }

    public function plan_list() {
        try {
            $query = $this->db->select('*')
                        ->from('plans')
                        ->where_in('is_active', array(1))
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

    public function check_subdomain_availability($sub_domain_name) {
        try {
            $query = $this->check_db->where('username', $sub_domain_name)->get('ftp_creds');
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