<?php 
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class CouponModel extends Model {

    protected $DBGroup              = 'default';
	protected $table                = 'Coupons';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

    // .. other member variables
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
        // OR $this->db = db_connect();
    }

    public function get_all_data()
    {
        $query = $this->db->query('select * from ' . $this->table .' where is_active in(1,2) order by id desc');
        return $query->getResult();
    }

    public function insert_data($data = array())
    {
        $this->db->table($this->table)->insert($data);
        return $this->db->insertID();
    }

    public function insert_utilized_coupon_data($data = array()){
        $this->db->table('CouponsUsed')->insert($data);
        return $this->db->insertID();
    }

    public function update_data($id, $data = array())
    {
        $this->db->table($this->table)->update($data, array(
            "id" => $id,
        ));
        return $this->db->affectedRows();
    }

    public function chk_coupon_code_valid($coupon_code,$customer_id,$total_price){
        $response = array();
        $couponExist = $this->db->query('select * from '. $this->table .' where coupon_code="'.$coupon_code.'" and is_active=1');
        $is_exist = $couponExist->getRow();
        if(isset($is_exist) && !empty($is_exist)){
            $isExpired = $this->db->query('select * from '. $this->table .' where coupon_code="'.$coupon_code.'" and CURDATE() between coupon_startdate and coupon_expirydate ');
            $is_expired = $isExpired->getRow();
            if(isset($is_expired) && !empty($is_expired)){
                $coupon_id = $is_expired->id;
                $isCpnAlreadyUsedBySameCustomer = $this->db->query(
                    '
                    select 
                    Coupons.* 
                    from CouponsUsed 
                    inner join Coupons on Coupons.id=CouponsUsed.coupon_id 
                    where CouponsUsed.coupon_id = '.$coupon_id.'  
                    and CouponsUsed.customer_id='.$customer_id
                );
                $is_CpnUsedBySameCustomer = $isCpnAlreadyUsedBySameCustomer->getRow();
                if(isset($is_CpnUsedBySameCustomer) && !empty($is_CpnUsedBySameCustomer)){
                    $response['responseCode'] = 3;
                    $response['responseMessage'] = 'coupon code is already used by same customer previously';
                    return $response;
                }else{
                    $is_CpnForAllOrderQry = $this->db->query('select * from '. $this->table .' where coupon_code="'.$coupon_code.'" and for_orders=1');
                    $CpnForAllOrderData = $is_CpnForAllOrderQry->getRow();
                    if(isset($CpnForAllOrderData) && !empty($CpnForAllOrderData)){
                        $couponQry = $this->db->query('select * from '. $this->table .' where coupon_code="'.$coupon_code.'" ');
                        $couponData = $couponQry->getRow();
                        $response['responseCode'] = 4;
                        $response['responseMessage'] = 'coupon code is valid.';
                        $response['responseData'] = $couponData;
                        return $response;
                    }else{
                        $is_CpnForOrderOverQry = $this->db->query('select * from '. $this->table .' where coupon_code="'.$coupon_code.'" and for_orders=2');
                        $CpnForAllOrderData = $is_CpnForOrderOverQry->getRow();
                        if(isset($CpnForAllOrderData) && !empty($CpnForAllOrderData)){
                            $is_CpnForMinOrderQry = $this->db->query('select * from '. $this->table .' where coupon_code="'.$coupon_code.'" and for_orders=2 and min_amount <= '.$total_price);
                            $CpnForMinOrderData = $is_CpnForMinOrderQry->getRow();
                            if(isset($CpnForMinOrderData) && !empty($CpnForMinOrderData)){
                                $couponQry = $this->db->query('select * from '. $this->table .' where coupon_code="'.$coupon_code.'" ');
                                $couponData = $couponQry->getRow();
                                $response['responseCode'] = 4;
                                $response['responseMessage'] = 'coupon code is valid.';
                                $response['responseData'] = $couponData;
                                return $response;
                            }else{
                                $couponQry = $this->db->query('select * from '. $this->table .' where coupon_code="'.$coupon_code.'" ');
                                $couponData = $couponQry->getRow();
                                $response['responseCode'] = 5;
                                $response['responseMessage'] = 'Cart Amount Is Lesser Than Minimum Order Limit Amount To Apply Coupon Code.';
                                $response['responseData'] = $couponData;
                                return $response;
                            }
                        }                    
                    }
                }
            }else{
                $response['responseCode'] = 2;
                $response['responseMessage'] = 'coupon code is expired or not valid.';
                return $response;
            }
        }else{
            $response['responseCode'] = 1;
            $response['responseMessage'] = 'coupon code is not exist.';
            return $response;
        }
    }
}

?>