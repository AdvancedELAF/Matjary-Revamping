<?php

class TemplateModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        //$this->check_db = $this->load->database('check_db', TRUE);
    }

    public function template_list() {
        try {
            $query = $this->db->select('*')
                        ->from('matjary_templates')
                        ->where_in('is_active', array(1,2))
                        ->order_by('name','DESC')
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
            $query = $this->db->insert('matjary_templates', $requestData);
            if ($query == true) {
				$lat_insert_id = $this->db->insert_id();
                return $lat_insert_id;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update_data($data, $id) {
        try {            
            $updatedStatus = $this->db->where('id', $id)->update('matjary_templates', $data);
            if ($updatedStatus==true) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function get_single_template_details($id) {
        try {            
            $query = $this->db->where('id', $id)->get('matjary_templates');
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
            $query = $this->db->get('newsletter_email_list');
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update_data_template($data, $id) {
        try {            
            $this->db->where('id', $id);
            $updatedStatus = $this->db->update('matjary_templates', $data);
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
