<?php 
namespace App\Models;
use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class OrderModel extends Model {

    protected $DBGroup              = 'default';
	protected $table                = 'Orders';
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

    public function insert_data($data = array())
    {
        $query = $this->db->table($this->table)->insert($data);
		// $getLastQuery = $this->db->getLastQuery();
		// echo '<pre>'; print_r($getLastQuery); exit;
        return $this->db->insertID();
    }

    public function insert_order_refund_request($data = array())
    {
        $query = $this->db->query('select * from RefundRequest where order_id='.$data['order_id']);
        $row = $query->getRow();
        if(isset($row) && !empty($row)){
            return $row->id;
        }else{
            $query = $this->db->table('RefundRequest')->insert($data);
            // $getLastQuery = $this->db->getLastQuery();
            // echo '<pre>'; print_r($getLastQuery); exit;
            return $this->db->insertID();
        }
        
    }

    public function update_data($orderId, $data = array()){
        $this->db->table('Orders')->update($data, array(
            "id" => $orderId,
        ));
        return $this->db->affectedRows();
    }

    public function update_order_pickup_reff_id($PickupGUID, $data = array()){
        $this->db->table('Orders')->update($data, array(
            "pickup_req_gu_id" => $PickupGUID,
        ));
        return $this->db->affectedRows();
    }

    public function get_all_data()
    {
        $query = $this->db->query('select * from ' . $this->table .' where is_active=1 order by id desc');
        return $query->getResult();
    }

    public function get_all_shipment_orders(){
        $query = $this->db->query('select * from ' . $this->table .' where pickup_req_flag in(0,2) and is_giftcard_purchased=0 and order_status in(1,2) and is_active=1 order by id desc');
        return $query->getResult();
    }

    public function get_all_shipment_pickups(){
        $query = $this->db->query('select * from ' . $this->table .' where pickup_req_flag=1 and is_giftcard_purchased=0 and is_active=1 group by pickup_req_ref_id');
        return $query->getResult();

        // $builder = $this->db->table($this->table);
		// $builder->select('*');
        // $array = ['pickup_req_flag' => 1, 'is_giftcard_purchased' => 0, 'is_active' => 1];
        // $builder->where($array);
		// $builder->groupBy('pickup_req_ref_id');
		// $query = $builder->get();

		// echo "<pre>";
		// print_r($query->getResult());
        //return $query->getResult();
      
        // To get last query executed
        //return $this->db->getLastQuery();

    }
    public function get_single_shipment_pickups($guId){
        $query = $this->db->query('select * from ' . $this->table .' where pickup_req_gu_id =  "'.$guId.'" and pickup_req_flag=1 and is_giftcard_purchased=0 and is_active=1 ');
        return $query->getResult();

    }

    public function insert_order_item_data($data){
        $query = $this->db->table('OrderItems')->insert($data);
        return $this->db->insertID();
    }

	public function remove_customer_cart_data($customerId){
		return $this->db->table('Cart')->delete(array(
            "customer_id" => $customerId,
        ));
	}

    public function remove_product_from_customer_cart($product_id,$customerId){
		return $this->db->table('Cart')->delete(array(
            "customer_id" => $customerId,
            "product_id"=>$product_id
        ));
	}

	public function upt_product_stock_qty($productId, $data = array()){
		$this->db->table('Products')->update($data, array(
            "id" => $productId,
        ));
        return $this->db->affectedRows();
	}
    
	public function get_userwise_active_data($cusid)
    {
        $query = $this->db->query('select * from ' . $this->table .' where customer_id = "'.$cusid.'" and is_active in(1) order by id desc');
        return $query->getResult();
    }

    public function get_single_order_details_by_tran_ref_only($tranRef){
        $result = [];
        $orderQuery = $this->db->query(
            'select o.*, ca.address, c.name as country_name, s.name as state_name, Cities.name as city_name from ' . $this->table .' as o 
            left join CustomerAddresses as ca on ca.id=o.customer_address_id 
            left join Countries as c on c.id=ca.country_id 
            left join States as s on s.id=ca.state_id 
            left join Cities on Cities.id=ca.city_id 
            where o.transaction_id="'.$tranRef.'" '
        );
        
        $result['orderInfo'] = $orderQuery->getRow();
        // $getLastQuery = $this->db->getLastQuery();
        // echo '<pre>'; print_r($getLastQuery); exit;
        if(isset($result['orderInfo']) && !empty($result['orderInfo'])){
            
            $orderId = isset($result['orderInfo']->id)?$result['orderInfo']->id:'';
            //echo '<pre>'; print_r($orderId); exit;
            if(isset($result['orderInfo']->is_giftcard_purchased) && !empty($result['orderInfo']->is_giftcard_purchased)){
                $orderItemsQuery = $this->db->query(
                    '
                    select 
                    gc.*,
                    o.giftcard_amount,
                    o.total_price 
                    from GiftCards as gc 
                    left join ' . $this->table .' as o on o.giftcard_id=gc.id 
                    where gc.id='.$result['orderInfo']->giftcard_id
                );
                $result['orderGiftCardInfo'] = $orderItemsQuery->getRow();
            }else{

                $orderItemsQuery = $this->db->query(
                    '
                    select 
                    OrderItems.*,
                    Products.title as product_title,
                    Products.weight as product_weight 
                    from OrderItems 
                    left join Products on Products.id=OrderItems.product_id  
                    where OrderItems.order_id='.$orderId
                );
                // $getLastQuery = $this->db->getLastQuery();
                // echo '<pre>'; print_r($getLastQuery); exit;
                $result['orderProductItemsInfo'] = $orderItemsQuery->getResult();
            }
        }
        
        return $result;
    }

    public function get_single_order_details_by_tran_ref($tranRef){
        $result = [];
        $orderQuery = $this->db->query(
            'select o.*, ca.address, c.name as country_name, s.name as state_name, Cities.name as city_name from ' . $this->table .' as o 
            left join CustomerAddresses as ca on ca.id=o.customer_address_id 
            left join Countries as c on c.id=ca.country_id 
            left join States as s on s.id=ca.state_id 
            left join Cities on Cities.id=ca.city_id 
            where o.transaction_id="'.$tranRef.'" and o.is_active=2'
        );
        
        $result['orderInfo'] = $orderQuery->getRow();
        // $getLastQuery = $this->db->getLastQuery();
        // echo '<pre>'; print_r($getLastQuery); exit;
        if(isset($result['orderInfo']) && !empty($result['orderInfo'])){
            
            $orderId = isset($result['orderInfo']->id)?$result['orderInfo']->id:'';
            //echo '<pre>'; print_r($orderId); exit;
            if(isset($result['orderInfo']->is_giftcard_purchased) && !empty($result['orderInfo']->is_giftcard_purchased)){
                $orderItemsQuery = $this->db->query(
                    '
                    select 
                    gc.*,
                    o.giftcard_amount,
                    o.total_price 
                    from GiftCards as gc 
                    left join ' . $this->table .' as o on o.giftcard_id=gc.id 
                    where gc.id='.$result['orderInfo']->giftcard_id
                );
                $result['orderGiftCardInfo'] = $orderItemsQuery->getRow();
            }else{

                $orderItemsQuery = $this->db->query(
                    '
                    select 
                    OrderItems.*,
                    Products.title as product_title,
                    Products.weight as product_weight 
                    from OrderItems 
                    left join Products on Products.id=OrderItems.product_id  
                    where OrderItems.order_id='.$orderId
                );
                // $getLastQuery = $this->db->getLastQuery();
                // echo '<pre>'; print_r($getLastQuery); exit;
                $result['orderProductItemsInfo'] = $orderItemsQuery->getResult();
            }
        }
        
        return $result;
    }

    public function get_my_single_order_details($orderId,$custmrId){
        $result = [];
        $orderQuery = $this->db->query(
            'select o.*, ca.address, c.name as country_name, s.name as state_name, Cities.name as city_name from ' . $this->table .' as o 
            left join CustomerAddresses as ca on ca.id=o.customer_address_id 
            left join Countries as c on c.id=ca.country_id 
            left join States as s on s.id=ca.state_id 
            left join Cities on Cities.id=ca.city_id 
            where o.id='.$orderId.' and o.customer_id='.$custmrId.' and o.is_active=1'
        );
        $result['orderInfo'] = $orderQuery->getRow();
        if(isset($result['orderInfo']->is_giftcard_purchased) && !empty($result['orderInfo']->is_giftcard_purchased)){
            $orderItemsQuery = $this->db->query(
                '
                select 
                gc.*,
                o.giftcard_amount,
                o.total_price 
                from GiftCards as gc 
                left join ' . $this->table .' as o on o.giftcard_id=gc.id 
                where gc.id='.$result['orderInfo']->giftcard_id.' and o.id='.$result['orderInfo']->id
            );
            $result['orderGiftCardInfo'] = $orderItemsQuery->getRow();
        }else{
            $orderItemsQuery = $this->db->query(
                '
                select 
                OrderItems.*,
                Products.title as product_title,
                Products.weight as product_weight, 
                Products.image 
                from OrderItems 
                left join Products on Products.id=OrderItems.product_id  
                where OrderItems.order_id='.$orderId.' '
            );
            $result['orderProductItemsInfo'] = $orderItemsQuery->getResult();
        }
        return $result;
    }

    public function get_single_order_details($orderId){
        $result = [];
        $orderQuery = $this->db->query(
            'select o.*, ca.address, ca.zipcode, cus.name as customer_name, cus.email , c.name as country_name, s.name as state_name, Cities.name as city_name from ' . $this->table .' as o 
            left join CustomerAddresses as ca on ca.id=o.customer_address_id
            left join Customers as cus on cus.id=o.customer_id  
            left join Countries as c on c.id=ca.country_id 
            left join States as s on s.id=ca.state_id 
            left join Cities on Cities.id=ca.city_id 
            where o.id='.$orderId.' and o.is_active=1'
        );
        $result['orderInfo'] = $orderQuery->getRow();
        if(isset($result['orderInfo']->is_giftcard_purchased) && !empty($result['orderInfo']->is_giftcard_purchased)){
            $orderItemsQuery = $this->db->query(
                '
                select 
                gc.*,
                o.giftcard_amount,
                o.total_price 
                from GiftCards as gc 
                left join ' . $this->table .' as o on o.giftcard_id=gc.id 
                where gc.id='.$result['orderInfo']->giftcard_id.' and o.id='.$result['orderInfo']->id
            );
            $result['orderGiftCardInfo'] = $orderItemsQuery->getRow();
        }else{
            $orderItemsQuery = $this->db->query(
                '
                select 
                OrderItems.*,
                Products.title as product_title,
                Products.title_ar as product_title_ar,
                Products.weight as product_weight, 
                Products.image 
                from OrderItems 
                left join Products on Products.id=OrderItems.product_id  
                where OrderItems.order_id='.$orderId.' '
            );
            $result['orderProductItemsInfo'] = $orderItemsQuery->getResult();
        }
        return $result;
    }

	public function get_order_details_data($customerId,$orderId)
    {
		$query = $this->db->query(
            '
            select 
            o.*,
            OrderItems.order_id,OrderItems.product_id,OrderItems.qty_price,OrderItems.qty_sales_tax,OrderItems.product_qty,
			CustomerAddresses.id as cusid, CustomerAddresses.customer_id,CustomerAddresses.address,CustomerAddresses.country_id,CustomerAddresses.state_id,CustomerAddresses.city_id,CustomerAddresses.zipcode,
			Customers.contact_no
            from Orders as o 
            left join OrderItems on OrderItems.order_id=o.id 
			left join CustomerAddresses on CustomerAddresses.id=o.customer_address_id
			left join Customers on Customers.id=o.customer_id            
            where o.id='.$orderId.' 
            and o.is_active=1
            '
        );       
        return $query->getResult();
    }

    public function get_cus_gcwise_data($giftId,$cusid)
    {
        $query = $this->db->query('select * from ' . $this->table .' where customer_id = "'.$cusid.'" and giftcard_prchsed_id = "'.$giftId.'" and is_active in(1) order by id desc');
        return $query->getResult();
    }

    public function all_refund_request()
    {
		$query = $this->db->query(
            'select 
            r.*,
            o.transaction_id 
            from RefundRequest as r 
            left join Orders as o 
            on o.id=r.order_id 
            where r.is_active=1 
            and o.order_status=3 
            order by r.id desc'
        );   
        //echo $this->db->getLastQuery(); exit;
        return $query->getResult();
    }

    public function get_my_single_refund_details($orderId,$custmrId){
        $result = [];
        $orderQuery = $this->db->query(
            'select o.*, ca.address, ca.zipcode, c.name as country_name, s.name as state_name, Cities.name as city_name from ' . $this->table .' as o 
            left join CustomerAddresses as ca on ca.id=o.customer_address_id 
            left join Countries as c on c.id=ca.country_id 
            left join States as s on s.id=ca.state_id 
            left join Cities on Cities.id=ca.city_id 
            where o.id='.$orderId.' and o.customer_id='.$custmrId.' and o.is_active=1'
        );
        $result['orderInfo'] = $orderQuery->getRow();
        if(isset($result['orderInfo']->is_giftcard_purchased) && !empty($result['orderInfo']->is_giftcard_purchased)){
            $orderItemsQuery = $this->db->query(
                '
                select 
                gc.*,
                o.giftcard_amount,
                o.total_price 
                from GiftCards as gc 
                left join ' . $this->table .' as o on o.giftcard_id=gc.id 
                where gc.id='.$result['orderInfo']->giftcard_id.' and o.id='.$result['orderInfo']->id
            );
            $result['orderGiftCardInfo'] = $orderItemsQuery->getRow();
        }else{
            $orderItemsQuery = $this->db->query(
                '
                select 
                OrderItems.*,
                Products.title as product_title,
                Products.weight as product_weight, 
                Products.image 
                from OrderItems 
                left join Products on Products.id=OrderItems.product_id  
                where OrderItems.order_id='.$orderId.' '
            );
            $result['orderProductItemsInfo'] = $orderItemsQuery->getResult();
        }
        return $result;
    }

    public function get_single_refund_details($orderId){
        $result = [];
        $orderQuery = $this->db->query(
            'select o.*, ca.address, ca.zipcode, c.name as country_name, s.name as state_name, Cities.name as city_name from ' . $this->table .' as o 
            left join CustomerAddresses as ca on ca.id=o.customer_address_id 
            left join Countries as c on c.id=ca.country_id 
            left join States as s on s.id=ca.state_id 
            left join Cities on Cities.id=ca.city_id 
            where o.id='.$orderId.' and o.is_active=1'
        );
        $result['orderInfo'] = $orderQuery->getRow();
        if(isset($result['orderInfo']->is_giftcard_purchased) && !empty($result['orderInfo']->is_giftcard_purchased)){
            $orderItemsQuery = $this->db->query(
                '
                select 
                gc.*,
                o.giftcard_amount,
                o.total_price 
                from GiftCards as gc 
                left join ' . $this->table .' as o on o.giftcard_id=gc.id 
                where gc.id='.$result['orderInfo']->giftcard_id.' and o.id='.$result['orderInfo']->id
            );
            $result['orderGiftCardInfo'] = $orderItemsQuery->getRow();
        }else{
            $orderItemsQuery = $this->db->query(
                '
                select 
                OrderItems.*,
                Products.title as product_title,
                Products.weight as product_weight, 
                Products.image 
                from OrderItems 
                left join Products on Products.id=OrderItems.product_id  
                where OrderItems.order_id='.$orderId.' '
            );
            $result['orderProductItemsInfo'] = $orderItemsQuery->getResult();
        }
        return $result;
    }
    
    public function refund_approved_by_admin($orderId,$ses_user_id){
		$aftectedId = $this->db
            ->table('RefundRequest')
            ->where(["order_id" => $orderId])
            ->set(["refund_status" => 1])
            ->set(["approved_by" => $ses_user_id])
            ->set(["updated_at" => DATETIME])
            ->update();

        $aftectedId = $this->db->affectedRows();
        if(is_int($aftectedId)){
            return true;
        }else{
            return false;
        }
	}

    public function refund_approved_by_admin_and_amount_refunded_in_gc($orderId,$ses_user_id){
        $aftectedId = $this->db
            ->table('RefundRequest')
            ->where(["order_id" => $orderId])
            ->set(["refund_status" => 2])
            ->set(["approved_by" => $ses_user_id])
            ->set(["updated_at" => DATETIME])
            ->update();

        $aftectedId = $this->db->affectedRows();
        if(is_int($aftectedId)){
            return true;
        }else{
            return false;
        }
    }
    
    public function check_refund_detals($orderId)
    {
        $query = $this->db->query(
            '
            select rr.*,u.name as user_name,u.email as user_email from RefundRequest as rr 
            left join Users as u on u.id=rr.approved_by 
            where rr.order_id = '.$orderId.' 
            and rr.is_active=1'
        );
        return $query->getFirstRow();
    }

    public function get_myrefund_details_data($cusId)
    {
		$query = $this->db->query(
                '
                select 
                R.*,
                Orders.id,Orders.shipping_id,Orders.is_active,Orders.payment_type,Orders.transaction_id,Orders.payment_status,Orders.total_price,Orders.order_status			
                from RefundRequest as R 
                left join Orders on Orders.id = R.order_id 			
                where R.customer_id = '.$cusId.' and R.is_active=1
                '
            );   
        return $query->getResult();
    }
    	
}

?>