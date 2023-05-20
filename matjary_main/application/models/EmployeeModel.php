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
            ->from('support_tickets')            
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
    public function get_single_contact_data($ticketId) {
        try {
            $query = $this->db->select('*')
            ->from('support_tickets')
            ->where('ticket_id',$ticketId)            
            ->order_by('id','DESC')
            ->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    
    public function get_single_enquiry_details($id) {
        try {          
            
            $query = $this->db->select(
                '
                    st.id,
                    st.ticket_id,
                    st.cont_name,
                    st.cont_email,
                    st.con_phone_no,
                    st.cont_subject,       
                    tm.id as tm_id,
                    tm.ticket_id as ticketno,
                    tm.message	 
                '
            )
            ->from('support_tickets as st')
            ->join('ticket_messages as tm', 'tm.ticket_id=st.ticket_id', 'left')
            ->where('st.ticket_id',$id)
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

    public function get_single_admin_enquiry_details($ticketId) {
        try {
            
            $query = $this->db->select(
                '                             
                    tm.id ,
                    tm.ticket_id as ticketno,
                    tm.message,
                    tm.created_by,
                    u.id as user_id,
                    u.fname,
                    u.usr_role,
                    ur.role_id,
                    ur.role_name,
                    st.user_id,
                    st.ticket_id,
                    st.cont_subject
                    	 
                '
            )
            ->from('ticket_messages as tm')
            ->join('users as u', 'u.id = tm.created_by', 'left')
            ->join('user_roles as ur', 'ur.role_id = u.usr_role', 'left')
            ->join('support_tickets as st', 'st.ticket_id = tm.ticket_id', 'left')
            ->where('tm.ticket_id',$ticketId)
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

    public function update_enquiry_data($data, $user_id) {
        try {            
            $this->db->where('id', $user_id);
            $updatedStatus = $this->db->update('support_tickets', $data);
            if ($updatedStatus) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function submit_contact_measage_data($requestData) {
        try {
            $query = $this->db->insert('ticket_messages', $requestData);
            if ($query == true) {
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
