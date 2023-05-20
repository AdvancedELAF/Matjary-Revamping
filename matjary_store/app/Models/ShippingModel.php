<?php 
namespace App\Models;
use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class ShippingModel extends Model {

    protected $DBGroup              = 'default';
	protected $table                = 'ShippingSetting';
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

    
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

	public function get_all_shipping_companies(){
		$query = $this->db->query('select * from ShippingCompanies where is_active=1');
        return $query->getResult();
	}

	public function get_store_all_active_shipping_companies(){
		$query = $this->db->query('
		select 
		ss.ship_cmp_id,
		sc.name as ship_cmp_name 
		from '.$this->table.' as ss 
		left join ShippingCompanies as sc on sc.id=ss.ship_cmp_id 
		where ss.is_active=1');
        return $query->getResult();
	}

    public function insert_data($shippingModel = array())
    {
        $query = $this->db->table($this->table)->insert($shippingModel);
        return $this->db->insertID();
    }

    public function get_all_data()
    {
        $query = $this->db->query('select * from ' . $this->table .' where is_active=1');
        return $query->getResult();
    }

    public function update_data($id, $data = array())
    {
		
		$query = $this->db->query('select * from ' . $this->table .' where ship_cmp_id='.$id);
        $qryResult = $query->getResult();
		if(isset($qryResult) && !empty($qryResult)){
			$this->db->table($this->table)->update($data, array(
				"ship_cmp_id" => $id,
			));
			return $this->db->affectedRows();
		}else{
			$array_push_data = array("is_active"=>1,"created_at"=>DATETIME);
			$data = array_merge($data,$array_push_data);
			$query = $this->db->table($this->table)->insert($data);
        	return $this->db->insertID();
		}
    }

	public function get_shipping_cmp_info($ship_cmp_id){
		$query = $this->db->query('select * from ' . $this->table .' where ship_cmp_id='.$ship_cmp_id);
        $qryResult = $query->getRow();
		if(isset($qryResult) && !empty($qryResult)){
			return $qryResult;
		}else{
			return false;
		}
	}

	public function get_number_of_available_shipments(){
		$result = [];
		$query = $this->db->query('select id from Orders where pickup_req_flag in(0,2) and is_giftcard_purchased=0 and order_status=2 and is_active=1');
        $qryResult = $query->getResult();
		if(isset($qryResult) && !empty($qryResult)){
			return $qryResult;
		}else{
			return false;
		}
	}
    	
}

?>