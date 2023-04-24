<?php

class CatModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        //$this->check_db = $this->load->database('check_db', TRUE);
    }

    public function category_list() {
        try {
            $query = $this->db->select('*')
                        ->from('template_categories')
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

    public function insert_data($requestData) {
        try {
            $query = $this->db->insert('template_categories', $requestData);
            if ($query == true) {
                return true;
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
            $updatedStatus = $this->db->update('template_categories', $data);
            if ($updatedStatus) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function get_single_cat_details($id) {
        try {            
            $query = $this->db->where('id', $id)->get('template_categories');
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    
    public function subscribers_list() {
        try {
            $query = $this->db->select('*')->from('newsletter_email_list')->where_in('is_active', array(1,2))->order_by('id','DESC')->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update_data_subscribers($data, $id) {
        try {            
            $this->db->where('id', $id);
            $updatedStatus = $this->db->update('newsletter_email_list', $data);
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