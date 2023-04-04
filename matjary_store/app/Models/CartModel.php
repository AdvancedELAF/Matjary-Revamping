<?php 
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class CartModel extends Model {

    protected $DBGroup              = 'default';
	protected $table                = 'Cart';
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
        $query = $this->db->query('select * from ' . $this->table .' order by id desc');
        return $query->getResult();
    }

    public function get_customer_cart_data($customerId){
        $query = $this->db->query(
            '
            select 
            p.*, p.retail_price - (p.retail_price * (p.discount_per / 100)) AS product_price 
            from ' . $this->table .' as c 
            left join Products as p on p.id=c.product_id 
            where c.customer_id='.$customerId.' 
            and p.is_active=1  
            order by c.id desc'
        );
        return $query->getResult();
    }

    public function insert_data($data = array())
    {
        $this->db->table($this->table)->insert($data);
        return $this->db->insertID();
    }

    public function update_data($id, $data = array())
    {
        $this->db->table($this->table)->update($data, array(
            "id" => $id,
        ));
        return $this->db->affectedRows();
    }

    public function chk_prod_exist_with_same_customer($productId,$customerId){
        $query = $this->db->query("SELECT * FROM ".$this->table." WHERE customer_id=".$customerId." AND product_id=".$productId);
        $result = $query->getRow();
        //echo '<pre>'; print_r($result); exit;
        if(isset($result) && !empty($result)){
            return true;
        }else{
            return false;
        }
    }

    public function insert_data_in_cart($data){
        $customerId = $data['customer_id'];

        $this->db->table($this->table)->insert($data);
        $insertedId = $this->db->insertID();

        if(is_int($insertedId)){
            $query = $this->db->query("SELECT * FROM ".$this->table." WHERE customer_id=".$customerId);
            $result = $query->getResult();
            if(count($result) > 0){
                return count($result);
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function get_single_customer_cart_products($customerId){
        $query = $this->db->query("SELECT * FROM ".$this->table." WHERE customer_id=".$customerId);
        $result = $query->getResult();
        if(count($result) > 0){
            return $result;
        }else{
            return false;
        }
    }

}

?>