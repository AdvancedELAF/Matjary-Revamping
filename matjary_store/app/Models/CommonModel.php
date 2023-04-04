<?php 
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class CommonModel extends Model {

    protected $DBGroup              = 'default';
    protected $table                = 'Common';
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
	//public $db_samatjary;

    public function __construct()
    {
        parent::__construct();

        $this->db = \Config\Database::connect();
        // OR $this->db = db_connect();
		//$this->db_samatjary = db_connect('samatjary');

    }

	// public function get_store_owner_subscription_details($baseUrl){
	// 	//$baseUrl = 'http://RRRe.matjary.in';
	// 	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
	// 		$baseUrl = str_replace("https://","",$baseUrl);
	// 	}else {
	// 		$baseUrl = str_replace("http://","",$baseUrl);
	// 	}
	// 	$baseUrl = str_replace("www.","",$baseUrl);
		
	// 	$query = $this->db_samatjary->query('select * from user_subscriptions where store_link="'.$baseUrl.'" order by id desc');
    //     return $query->getResult();
	// }

	public function get_all_country_data(){
		$query = $this->db->query('select * from Countries order by name asc');
        return $query->getResult();
	}

	public function get_all_state_data(){
		$query = $this->db->query('select * from States order by name asc');
        return $query->getResult();
	}

	public function get_all_city_data(){
		$query = $this->db->query('select * from Cities order by name asc');
        return $query->getResult();
	}

    public function update_data($id, $table, $data = array())
    {
        $this->db->table($table)->update($data, array(
            "id" => $id,
        ));
        return $this->db->affectedRows();
    }

    public function get_country_states($country_id){
		$query = $this->db->query('select * from States where country_id='.$country_id.' order by name asc');
        return $query->getResult();
	}

	public function get_state_cities($state_id){
		$query = $this->db->query('select * from Cities where state_id='.$state_id.' order by name asc');
        return $query->getResult();
	}

	public function dashboard_analytics(){
		$result = [];
		$query = $this->db->query("SELECT id , name , email  FROM Users WHERE is_active='1'");
		$result['totalUser'] = $query->getResult(); 

		$query = $this->db->query("SELECT id , is_active  FROM Products WHERE is_active='1'");
		$result['totalProduct'] = $query->getResult(); 

		$query = $this->db->query("SELECT id , is_active , order_status FROM Orders WHERE is_active='1' and order_status = '1'");
		$result['totalOrders'] = $query->getResult();

		$query = $this->db->query("SELECT id  FROM ProductCategories WHERE is_active='1'");
		$result['totalCategories'] = $query->getResult();

		$query = $this->db->query("SELECT id  FROM Brands WHERE is_active='1'");
		$result['totalBrands'] = $query->getResult();

		$query = $this->db->query("SELECT id  FROM Coupons WHERE is_active='1'");
		$result['totalCoupons'] = $query->getResult();

		$query = $this->db->query("SELECT id  FROM Customers WHERE is_active='1'");
		$result['totalCustomers'] = $query->getResult(); 

		$query = $this->db->query("SELECT id  FROM Subscribers WHERE is_active='1'");
		$result['totalSubscribers'] = $query->getResult();

		$query = $this->db->query("SELECT id  FROM GiftCards WHERE is_active='1'");
		$result['totalGiftCards'] = $query->getResult();

		$query = $this->db->query('select * from Orders where pickup_req_flag in(0,2) and is_giftcard_purchased=0 and is_active=1 ');
		$result['totalShippingOrders'] = $query->getResult();  

		$query = $this->db->query('select * from Orders where pickup_req_flag=1 and is_giftcard_purchased=0 and is_active=1 group by pickup_req_ref_id');
		$result['totalShippmentPickups'] = $query->getResult();

		$query = $this->db->query("SELECT id  FROM Banners WHERE is_active='1'");
		$result['totalBanners'] = $query->getResult(); 

		$query = $this->db->query("SELECT id  FROM Advertisements WHERE is_active='1'");
		$result['totalAdvertisements'] = $query->getResult();

		$query = $this->db->query("SELECT id , created_at FROM Customers WHERE  created_at BETWEEN CURDATE() - INTERVAL 10 DAY AND CURDATE() and is_active='1'");
	    $result['totalResentCustomers'] = $query->getResult();

		$query = $this->db->query("SELECT id , created_at FROM Users WHERE  created_at BETWEEN CURDATE() - INTERVAL 10 DAY AND CURDATE() and is_active='1'");
	    $result['totalResentUsers'] = $query->getResult();

		$query = $this->db->query("SELECT id , created_at FROM Subscribers WHERE  created_at BETWEEN CURDATE() - INTERVAL 10 DAY AND CURDATE() and is_active='1'");
	    $result['totalResentSubcrs'] = $query->getResult();

		return $result;
	}

	public function best_selling_products(){
		$query = $this->db->query("select product_id, sum(qty_price) 
		from OrderItems 
		group by product_id 
		order by sum(qty_price) desc 
		limit 5");
	    return $query->getResult();
	}
	
	public function get_current_year_profit(){
		
		// $query = $this->db->query("select year(created_at) as year ,month(created_at) as month ,sum(total_price) as total_price
		// from Orders
		// group by year(created_at),month(created_at)
		// order by year(created_at),month(created_at)");
		$query = $this->db->query("SELECT 
		SUM(IF(month = 'Jan', total, 0)) AS 'Jan',
		SUM(IF(month = 'Feb', total, 0)) AS 'Feb',
		SUM(IF(month = 'Mar', total, 0)) AS 'Mar',
		SUM(IF(month = 'Apr', total, 0)) AS 'Apr',
		SUM(IF(month = 'May', total, 0)) AS 'May',
		SUM(IF(month = 'Jun', total, 0)) AS 'Jun',
		SUM(IF(month = 'Jul', total, 0)) AS 'Jul',
		SUM(IF(month = 'Aug', total, 0)) AS 'Aug',
		SUM(IF(month = 'Sep', total, 0)) AS 'Sep',
		SUM(IF(month = 'Oct', total, 0)) AS 'Oct',
		SUM(IF(month = 'Nov', total, 0)) AS 'Nov',
		SUM(IF(month = 'Dec', total, 0)) AS 'Dec'
		FROM
		(SELECT 
			MIN(DATE_FORMAT(created_at, '%b')) AS month,
			sum(total_price) AS total
		FROM
			Orders
		
		GROUP BY YEAR(created_at) , MONTH(created_at)
		ORDER BY YEAR(created_at) , MONTH(created_at)) AS sale;");
	    return $query->getResult();
	}

	public function search($query,$ses_lang){
		if($ses_lang=='en'){
			$query = $this->db->query("SELECT title,keywords,tags FROM Products WHERE title LIKE '%".trim($query)."%' OR keywords LIKE '%".trim($query)."%' OR tags LIKE '%".trim($query)."%' OR title_ar LIKE '%".trim($query)."%' OR keywords_ar LIKE '%".trim($query)."%' OR tags_ar LIKE '%".trim($query)."%' AND is_active in(1) ORDER BY id ASC");
		}else{
			$query = $this->db->query("SELECT title_ar,keywords_ar,tags_ar FROM Products WHERE title LIKE '%".trim($query)."%' OR keywords LIKE '%".trim($query)."%' OR tags LIKE '%".trim($query)."%' OR title_ar LIKE '%".trim($query)."%' OR keywords_ar LIKE '%".trim($query)."%' OR tags_ar LIKE '%".trim($query)."%' AND is_active in(1) ORDER BY id ASC");
		}
		return $query->getResult();
	}
	

}








?>