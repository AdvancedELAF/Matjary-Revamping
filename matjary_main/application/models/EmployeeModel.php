<?php

class EmployeeModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    
   
    public function chk_email_exist($email) {
        try {
            $query = $this->db->select('u.id as user_id, u.fname, u.lname, u.email, u.phone_no')
                    ->from('users as u')
                    ->where('u.email', $email)
                    ->where('u.is_active', 1)
                   // ->where_in('usr_role', array(2,4,5))
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

    public function save_usr($requestData) {
        try {
            $query = $this->db->insert('users', $requestData);
            if ($query == true) {
                $insert_id = $this->db->insert_id();
                return $insert_id;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function saveUsrPass($requestData) {
        try {
            $query = $this->db->insert('user_credentials', $requestData);
            if ($query == true) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function updateUsrPass($user_id, $pswrd) {
        try {
            $update_data = ['pswrd' => $pswrd];
            $dataInserted = $this->db->where('id', $user_id)->update('user_credentials', $update_data);
            if ($dataInserted) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function passResetFlagUpdate($user_id, $token) {
        try {
            $update_data = ['reset_flag' => 0];
            $this->db->where('user_id', $user_id);
            $this->db->where('token', $token);
            $dataInserted = $this->db->update('password_resets', $update_data);
            if ($dataInserted) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete_usr($usrId) {
        try {
            $query = $this->db->where('id', $usrId)->delete('users');
            if ($query == true) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public function update_user_data($data, $user_id) {
        try {            
            $this->db->where('id', $user_id);
            $updatedStatus = $this->db->update('users', $data);
            if ($updatedStatus) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update_usr_pro_pass_api($data, $user_id) {
        try {
            $insert_data = [
                'pswrd' => $data['new_pass']
            ];
            $this->db->where('user_id', $user_id);
            $dataInserted = $this->db->update('user_credentials', $insert_data);
            if ($dataInserted) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }    

    public function check_rst_pwd_request($user_id, $tnk = NUll) {
        try {
            /* check if record already exits */
            if (isset($tnk) && !empty($tnk)) {
                $query_check = $this->db->select('*')
                        ->from('password_resets')
                        ->where('user_id', $user_id)
                        ->where('token', $tnk)
                        ->where('reset_flag', 1)
                        ->get();
            } else {
                $query_check = $this->db->select('*')
                        ->from('password_resets')
                        ->where('user_id', $user_id)
                        ->where('reset_flag', 1)
                        ->get();
            }

            if ($query_check->num_rows() > 0) {
                $rowData = $query_check->row();
                return $rowData;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function insert_rst_pwd_request($requestData) {
        try {
            $query = $this->db->insert('password_resets', $requestData);
            if ($query == true) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function get_admin_role_list() {
        try {
            $query = $this->db->select('*')
            ->from('user_roles')
            ->where_in('role_id', array(2,4,5))
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

    public function get_user_data() {
        try {
            $query = $this->db->select('*')
            ->from('users')
            ->where_in('is_active', array(1,2))
            ->where_in('usr_role', array(2,4,5))
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

    public function get_single_user_details($id) {
        try {            
            $query = $this->db->where('id', $id)->get('users');
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update_data($user_id, $data = array()) {
        try {            
            $this->db->where('id', $user_id);
            $dataInserted = $this->db->update('users', $data);
            if ($dataInserted) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /** Customer Enquery */

    public function get_contact_data() {
        try {
            $query = $this->db->select('*')
            ->from('contact_request')            
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
    public function get_single_enquiry_details($id) {
        try {            
            $query = $this->db->where('id', $id)->get('contact_request');
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update_enquiry_data($data, $user_id) {
        try {            
            $this->db->where('id', $user_id);
            $updatedStatus = $this->db->update('contact_request', $data);
            if ($updatedStatus) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

     /** Customer Enquery End */

}

?>
