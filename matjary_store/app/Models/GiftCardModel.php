<?php 
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class GiftCardModel extends Model {

    protected $DBGroup              = 'default';
	protected $table                = 'GiftCards';
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

    public function get_all_active_data(){
        $query = $this->db->query('select * from ' . $this->table .' where is_active in(1) order by id desc');

        return $query->getResult();
    }  

    public function insert_customer_giftcard($data = array()){
        $this->db->table('GiftCardPurchased')->insert($data); 
        return $this->db->insertID();
    }

    public function insert_data($bannerModel = array())
    {
        $this->db->table($this->table)->insert($bannerModel); 
        return $this->db->insertID();
    }

    public function update_data($id, $data = array())
    {
        $this->db->table($this->table)->update($data, array(
            "id" => $id,
        ));
        return $this->db->affectedRows();
    }

    public function delete_data($id)
    {
        return $this->db->table($this->table)->delete(array(
            "id" => $id,
        ));
    }
    
    public function get_single_gift_details($giftId){
        $query = $this->db->query('select * from ' . $this->table .' where id= "'.$giftId.'" and is_active in(1) ');
        return $query->getFirstRow();
    }

    public function get_gift_purchased_details($cusId){      
        //$query = $this->db->query('select * from GiftCardPurchased where customer_id= "'.$cusId.'" and is_active in(1) ');
        $query = $this->db->query('
            select GiftCardPurchased.*,
            GiftCards.id,
            GiftCardPurchased.id as giftcard_prchsed_id,
            GiftCards.name, 
            GiftCards.image,
            GiftCards.start_date,
            GiftCards.expiry_date
            from GiftCardPurchased 
            inner join GiftCards on GiftCards.id=GiftCardPurchased.gc_id 
            where GiftCardPurchased.customer_id='.$cusId.' and GiftCards.is_active = 1'
        );
              
        return $query->getResult();
    }

    public function find_in_giftcardpurchased($giftcard_code){
        $query = $this->db->query('
        select *
        from GiftCardPurchased 
        where egift_code="'.$giftcard_code.'"');
        return $query->getRow();
    }

    public function upt_gc_balance($id, $data = array()){
        $this->db->table('GiftCardPurchased')->update($data, array(
            "id" => $id,
        ));
        return $this->db->affectedRows();
    }
    
    public function card_purchased_details($giftId){ 
        $query = $this->db->query('
        select GiftCardPurchased.*,
        GiftCards.id,
        GiftCards.name, 
        GiftCards.image 
        from GiftCardPurchased 
        inner join GiftCards on GiftCards.id=GiftCardPurchased.gc_id 
        where GiftCardPurchased.gc_id='.$giftId.' '            
        );
        return $query->getFirstRow();
    }

    public function my_single_gc_details($giftPrchdId,$customerId){
        $query = $this->db->query('
        select 
        gc.id,
        gc.name, 
        gc.name_ar,
        gc.image,
        gc.short_desc,
        gc.long_desc,
        gc.start_date,
        gc.expiry_date,
        gcp.egift_code,
        gcp.gc_amount,
        gcp.gc_balance,
        gcp.gc_status
        from GiftCardPurchased as gcp 
        left join GiftCards as gc on gc.id=gcp.gc_id 
        where gcp.id='.$giftPrchdId.' 
        and gcp.customer_id='.$customerId.' 
        and gc.is_active=1 
        ');
        return $query->getFirstRow();
    }

    public function is_customer_gc_valid($gc_code,$customerId,$totalprice){
        $result = [];
        $is_gc_code_exist_qry = $this->db->query('
        select 
        gc.id,
        gcp.gc_amount,
        gcp.gc_balance,
        gcp.gc_status
        from GiftCards as gc 
        left join GiftCardPurchased as gcp on gcp.gc_id=gc.id 
        where gcp.egift_code="'.$gc_code.'" 
        and gc.is_active=1 
        ');
        // $getLastQuery = $this->db->getLastQuery($is_gc_code_exist_qry);
        // echo '<pre>'; print_r($getLastQuery); exit;
        $isGcCodeExist = $is_gc_code_exist_qry->getRow();
        
        if(isset($isGcCodeExist) && !empty($isGcCodeExist)){
            $is_gc_code_customer_exist_qry = $this->db->query('
            select 
            gc.id,
            gcp.gc_amount,
            gcp.gc_balance,
            gcp.gc_status
            from GiftCards as gc 
            left join GiftCardPurchased as gcp on gcp.gc_id=gc.id 
            where gcp.egift_code="'.$gc_code.'" 
            and gcp.customer_id='.$customerId.' 
            and gc.is_active=1 
            ');
            $isGcCodeCstmrExist = $is_gc_code_customer_exist_qry->getRow();
            if(isset($isGcCodeCstmrExist) && !empty($isGcCodeCstmrExist)){
                $is_gc_code_expired_qry = $this->db->query('
                select 
                gc.id,
                gcp.gc_amount,
                gcp.gc_balance,
                gcp.gc_status
                from GiftCards as gc 
                left join GiftCardPurchased as gcp on gcp.gc_id=gc.id 
                where gcp.egift_code="'.$gc_code.'" 
                and gcp.customer_id='.$customerId.' 
                and gc.expiry_date >= CURDATE()  
                and gc.is_active=1 
                ');
                $isGcCodeExpired = $is_gc_code_expired_qry->getRow();
                if(isset($isGcCodeExpired) && !empty($isGcCodeExpired)){
                    $is_gc_code_balance_qry = $this->db->query('
                    select 
                    gc.id,
                    gcp.id as giftcard_prchsed_id,
                    gcp.gc_amount,
                    gcp.gc_balance,
                    gcp.gc_status
                    from GiftCards as gc 
                    left join GiftCardPurchased as gcp on gcp.gc_id=gc.id 
                    where gcp.egift_code="'.$gc_code.'" 
                    and gcp.customer_id='.$customerId.' 
                    and gcp.gc_balance >= '.$totalprice.' 
                    and gc.is_active=1 
                    ');
                    $isGcCodeBalanced = $is_gc_code_balance_qry->getRow();
                    if(isset($isGcCodeBalanced) && !empty($isGcCodeBalanced)){
                        $result['statusCode']= 200;
                        $result['statusMessage'] = $this->ses_lang=='en'?'The Gift Card Has Been Applied Successfully.':'تم تطبيق بطاقة الهدايا بنجاح.';
                        $result['statusData']= $isGcCodeBalanced;
                        return $result;
                    }else{
                        $result['statusCode']= 404;
                        $result['statusMessage'] = $this->ses_lang=='en'?'Gift Card Balance Is Low, Your Current Balance Is : ':'رصيد بطاقة الهدايا منخفض ، رصيدك الحالي هو:'.$isGcCodeExpired->gc_balance;
                        return $result;
                    }
                }else{
                    $result['statusCode']= 404;
                    $result['statusMessage'] = $this->ses_lang=='en'?'Gift Card Code Is Expired.':'انتهت صلاحية رمز بطاقة الهدايا.';
                    return $result;
                }
            }else{
                $result['statusCode']= 404;
                $result['statusMessage'] = $this->ses_lang=='en'?'You Have Not Purchased This Gift Card.':'لم تقم بشراء بطاقة الهدايا هذه.';
                return $result;
            }
        }else{
            $result['statusCode']= 404;
            $result['statusMessage'] = $this->ses_lang=='en'?'Gift Card Code Is Not Valid':'رمز بطاقة الهدايا غير صالح';
            return $result;
        }
    }

    public function get_single_purchased_gc_details($purchadedGcId){
        $query = $this->db->query('
        select GiftCardPurchased.* 
        from GiftCardPurchased 
        where GiftCardPurchased.id='.$purchadedGcId.' '            
        );
        return $query->getFirstRow();
    }

    public function update_single_purchased_gc_details($giftcard_prchsed_id, $gc_refund_amount){
       
        $aftectedId = $this->db
            ->table('GiftCardPurchased')
            ->where(["id" => $giftcard_prchsed_id])
            ->set(["gc_balance" => $gc_refund_amount])
            ->set(["updated_at" => DATETIME])
            ->update();
       
        $aftectedId = $this->db->affectedRows();
        if(is_int($aftectedId)){
            return true;
        }else{
            return false;
        }
    }
    
}

?>