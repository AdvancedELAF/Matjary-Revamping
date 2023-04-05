<?php

class UsrModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function chk_store_link_exist($storeUrl) {
        try {
            $query = $this->db->where('store_link', $storeUrl)->get('user_subscriptions');
            if ($query->num_rows() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function get_store_info($store_link, $store_token) {
        try {
            $result = [];
            $linkQry = $this->db->where('store_link', $store_link)->get('user_subscriptions');
            if ($linkQry->num_rows() > 0) {
                $tknQry = $this->db->where('store_link', $store_link)->where('store_tkn', $store_token)->get('user_subscriptions');
                if ($tknQry->num_rows() > 0) {
                    $rowData = $tknQry->row();
                    $result['responseCode'] = 200;
                    $result['responseMessage'] = 'Store Information Retrived Successfully.';
                    $result['responseData'] = $rowData;
                } else {
                    $result['responseCode'] = 404;
                    $result['responseMessage'] = 'store token not exist.';
                }
            } else {
                $result['responseCode'] = 404;
                $result['responseMessage'] = 'store not exist.';
            }
            return $result;
        } catch (Exception $e) {
            return $e->getMessage();
        }
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

    public function chk_usr_crdntls($email, $pass) {
        try {
            $query = $this->db->select('
				u.id,
				u.fname,
				u.lname,
				u.email,
				u.phone_no,
				u.usr_role,
				u.is_active
				')
                ->from('users as u')
                ->join('user_credentials as uc', 'uc.user_id=u.id', 'inner')
                ->where('u.email', $email)
                ->where('uc.pswrd', $pass)
                ->where('u.usr_role', 3)
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

    public function chk_admin_crdntls($email, $pass) {
        try {
            $query = $this->db->select('u.*')
            ->from('users as u')
            ->join('user_credentials as uc', 'uc.user_id=u.id', 'inner')
            ->where('u.email', $email)
            ->where('uc.pswrd', $pass)
            ->where('u.usr_role', 1)
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

    public function save_usr_subscription($requestData) {
        try {
            $query = $this->db->insert('user_subscriptions', $requestData);
            if ($query == true) {
                return $this->db->insert_id();
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function save_user_tempalte_details($requestData) {
        try {

            /* check if record already exits */
            $query_check = $this->db->select('*')
                    ->from('user_store_templates as ust')
                    ->where('ust.user_id', $requestData['user_id'])
                    ->where('ust.template_id', $requestData['template_id'])
                    ->get();
            if ($query_check->num_rows() > 0) {
                return true;
            } else {
                $query = $this->db->insert('user_store_templates', $requestData);
                if ($query == true) {
                    return true;
                } else {
                    return false;
                }
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function save_subscription_billing_info($requestData) {
        try {
            $query = $this->db->insert('user_payment_info', $requestData);
            if ($query == true) {

                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function user_domains($user_id, $email) {
        try {
            $query = $this->db->select('
                us.user_id,
                us.plan_id,
                us.plan_month,
                us.plan_start_dt,
                us.plan_expiry_dt,
                us.store_link')
                ->from('user_subscriptions as us')
                ->where('us.user_id', $user_id)
                ->where('us.is_active', 1) 
                ->order_by("plan_expiry_dt", "asc")
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

    public function user_profile_details($user_id) {
        try {
            $query = $this->db->select('
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
                uc.pswrd')
                    ->from('users as u')
                    ->join('user_credentials as uc', 'uc.user_id=u.id', 'inner')
                    ->where('u.id', $user_id)
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

    public function user_order_details($user_id) {
        try {
            $result = array();
            $result['user_stores_purchased_history'] = '';
            $result['user_templates_purchased_history'] = '';

            $usrPurchasedStoreQry = $this->db->select(
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
            ->where('upi.customer_id', $user_id)
            ->where('us.subscription_type', 2)
            ->where('us.is_active', 1)
            ->group_by('us.id')
            ->order_by("upi.created_at", "desc")
            ->get();
            if ($usrPurchasedStoreQry->num_rows() > 0) {
                $result['user_stores_purchased_history'] = $usrPurchasedStoreQry->result();
            } else {
                $result['user_stores_purchased_history'] = false;
            }

            $usrPurchasedTmplQry = $this->db->select(
                '
                upi.*,
                mt.name as template_name 
                '
            )
            ->from('user_store_templates as ust')
            ->join('user_payment_info as upi', 'upi.template_id=ust.template_id', 'left')
            ->join('matjary_templates as mt', 'mt.id=ust.template_id', 'left')
            ->where('ust.user_id', $user_id)
            ->where('ust.template_active', 1)
            ->group_by('upi.template_id')
            ->order_by("ust.created_at", "desc")
            ->get();
            if ($usrPurchasedTmplQry->num_rows() > 0) {
                $result['user_templates_purchased_history'] = $usrPurchasedTmplQry->result();
            } else {
                $result['user_templates_purchased_history'] = false;
            }
            
            return $result;
            
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function user_purchased_templates($user_id){
        try {
            $query = $this->db->select('mt.*')
                ->from('user_store_templates as ust')
                ->join('matjary_templates as mt', 'mt.id=ust.template_id', 'left')
                ->join('user_payment_info as upi', 'upi.id=ust.template_id', 'left')
                ->where('ust.template_active', 1)
                ->where('ust.user_id', $user_id)
                ->where('mt.is_active', 1)
                ->order_by("ust.created_at", "desc")
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

    public function user_store_paid_template_details($user_id) {
        try {
            $query = $this->db->select('mt.*')
                ->from('user_store_templates as ust')
                ->join('matjary_templates as mt', 'mt.id=ust.template_id', 'left')
                ->where('ust.template_active', 1)
                ->where('ust.user_id', $user_id)
                ->where('mt.is_active', 1)
                ->order_by("ust.created_at", "desc")
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

    public function user_store_free_template_details() {
        try {
            $query = $this->db->select('*')
                    ->from('matjary_templates')
                    ->where('is_active', 1)
                    ->where('free_paid_flag', 1)
                    ->order_by("created_dt", "desc")
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

    public function update_user_free_trail_flag($usr_id, $usr_email) {
        try {
            $insert_data = ['is_free_trail_store_used' => 1];
            $this->db->where('id', $usr_id);
            $this->db->where('email', $usr_email);
            $this->db->where('is_free_trail_store_used',0);
            $dataInserted = $this->db->update('users', $insert_data);
            if ($dataInserted) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update_user_profile_api($data, $user_id) {
        try {
            $insert_data = [
                'address' => $data['address'],
                'country_id' => $data['country'],
                'state_id' => $data['state'],
                'city_id' => $data['city'],
                'zipcode' => $data['zipcode'],
                'phone_no' => $data['phone_no'],
                'fax_no' => $data['fax_no']
            ];
            $this->db->where('id', $user_id);
            $dataInserted = $this->db->update('users', $insert_data);
            if ($dataInserted) {
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

    public function get_user_payment_info($cartId, $tranRef){
        try {
            $query = $this->db->select('*')->from('user_payment_info')->where('cartId', $cartId)->where('tranRef', $tranRef)->get();
            if ($query->num_rows() > 0) {
                $rowData = $query->row();
                if($rowData->plan_tmpl_buy_status <> 3){
                    $query1 = $this->db->select(
                        'upi.*, 
                        us.plan_id,
                        us.plan_month,
                        us.plan_start_dt,
                        us.plan_expiry_dt,
                        us.store_domain,
                        us.store_sub_domain,
                        us.store_link,
                        us.store_admin_link,
                        us.user_email,
                        us.store_tkn,
                        us.site_status,
                        us.subscription_type
                        '
                    )
                    ->from('user_payment_info as upi')
                    ->join('user_subscriptions as us','us.id=upi.user_subscriptions_id','left')
                    ->where('upi.cartId', $cartId)
                    ->where('upi.tranRef', $tranRef)
                    ->get();
                    if ($query1->num_rows() > 0) {
                        $rowData1 = $query1->row();
                        return $rowData1;
                    }else{
                        return false;
                    }
                }else{
                    return $rowData;
                }
            }else{
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update_pg_res_api($requestData, $cartId, $tranRef) {
        try {
            $userPaymentInfo = [
                'pg_res' => $requestData['pg_res'],
                'payment_status' => $requestData['payment_status'],
                'is_active' => $requestData['is_active']
            ];
            $this->db->where('cartId', $cartId);
            $this->db->where('tranRef', $tranRef);
            $updateStatus = $this->db->update('user_payment_info', $userPaymentInfo);
            if ($updateStatus==true) {
                
                $query = $this->db->select('*')->from('user_payment_info')->where('cartId', $cartId)->where('tranRef', $tranRef)->get();
                if ($query->num_rows() > 0) {
                    $rowData = $query->row();
                    if($rowData->plan_tmpl_buy_status==3){
                        
                        $userTemplateInfo = [
                            'template_active' => $requestData['is_active']
                        ];
                        $this->db->where('user_id', $rowData->customer_id);
                        $this->db->where('template_id', $rowData->template_id);
                        $updateUserTemplateStatus = $this->db->update('user_store_templates', $userTemplateInfo);
                        if($updateUserTemplateStatus==true){
                            return true;
                        }else{
                            return false;
                        }

                    }else{
                        $userSubscriptionInfo = [
                            'is_active' => $requestData['is_active']
                        ];
                        $user_subscriptions_id = $rowData->user_subscriptions_id;
                        $this->db->where('id', $user_subscriptions_id);
                        $updateSubscriptionStatus = $this->db->update('user_subscriptions', $userSubscriptionInfo);
                        if($updateSubscriptionStatus==true){

                            if($rowData->plan_tmpl_buy_status==2){
                                $userTemplateInfo = [
                                    'template_active' => $requestData['is_active']
                                ];
                                $this->db->where('user_id', $rowData->customer_id);
                                $this->db->where('template_id', $rowData->template_id);
                                $updateUserTemplateStatus = $this->db->update('user_store_templates', $userTemplateInfo);
                                if($updateUserTemplateStatus==true){
                                    return true;
                                }else{
                                    return false;
                                }
                            }else{
                                return true;
                            }

                        }else{
                            return false;
                        }
                    }
                    
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function get_last_purchased_template_data($cartId, $tranRef){
        try {
            
                $query = $this->db->select(
                    '
                    upi.*,
                    mt.name as template_name')
                    ->from('user_payment_info as upi')
                    ->join('user_store_templates as ust', 'ust.template_id=upi.template_id', 'left')
                    ->join('matjary_templates as mt', 'mt.id = upi.template_id', 'left')
                    ->where('upi.cartId', $cartId)
                    ->where('upi.tranRef', $tranRef)
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

    public function get_store_creation_data($cartId, $tranRef) {
        try {
            
                $query = $this->db->select(
                    'us.user_id, 
                    us.plan_id, 
                    us.user_email, 
                    us.store_domain,
                    us.store_sub_domain, 
                    us.template_id,
                    us.store_link,
                    us.store_admin_link,
                    us.store_tkn,
                    us.subscription_type,
                    upi.id as order_id,
                    upi.user_subscriptions_id, 
                    upi.bill_info_address,
                    upi.plan_cost,
                    upi.template_cost,
                    upi.plan_tmpl_buy_status,  
                    upi.total_price,
                    upi.order_status,
                    upi.pg_req,
                    upi.payment_type,
                    upi.cartId,
                    upi.tranRef,
                    upi.payment_status,
                    mt.name as template_name,
                    p.plan_name,
                    p.validity_in_months')
                    ->from('user_payment_info as upi')
                    ->join('user_subscriptions as us', 'upi.user_subscriptions_id=us.id', 'left')
                    ->join('matjary_templates as mt', 'mt.id = upi.template_id', 'left')
                    ->join('plans as p', 'p.id = us.plan_id', 'left')
                    ->where('upi.cartId', $cartId)
                    ->where('upi.tranRef', $tranRef)
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

    public function check_site_status($store_sub_domain, $store_tkn) {
        try {
            /* check if record already exits */
            $query_check = $this->db->select('*')
                    ->from('user_subscriptions as us')
                    ->where('us.store_sub_domain', $store_sub_domain)
                    ->where('us.store_tkn', $store_tkn)
                    ->get();
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

    public function get_user_purchased_store_payment_info_api($invoiceId) {
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
                p.plan_name,
                p.plan_desc,
                p.price,
                p.validity_in_months,
                mt.name as template_name,
                c.code as coupon_code,
                c.discount_in_percent as coupon_discount_percent 
                '
            )
            ->from('user_payment_info as upi')
            ->join('user_subscriptions as us', 'us.id=upi.user_subscriptions_id', 'left')
            ->join('plans as p', 'p.id=us.plan_id', 'left')
            ->join('matjary_templates as mt', 'mt.id=upi.template_id', 'left')
            ->join('coupons as c', 'c.id=upi.coupon_id', 'left')
            ->where('upi.id', $invoiceId)
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

    public function get_user_purchased_template_payment_info_api($invoiceId) {
        try {
            $query = $this->db->select(
                '
                upi.id, 
                upi.bill_info_address,
                upi.total_price,
                upi.order_status,
                upi.payment_type,
                upi.cartId,
                upi.tranRef,
                upi.payment_status,
                upi.template_cost,
                upi.created_at,
                mt.name as template_name,
                '
                )
                ->from('user_store_templates as ust')
                ->join('user_payment_info as upi', 'upi.template_id = ust.template_id', 'left')
                ->join('matjary_templates as mt', 'mt.id = ust.template_id', 'left')
                ->where('upi.id', $invoiceId)
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

    public function save_newsletter_email($requestData) {
        try {
            $query = $this->db->insert('newsletter_email_list', $requestData);
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
            ->where_in('role_id', array(2,3))
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
            ->where_in('usr_role', array(2,3))
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

}

?>
