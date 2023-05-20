<?php 
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class ProductFeedBackModel extends Model {

    protected $DBGroup              = 'default';
	protected $table                = 'ProductFeedbacks';
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

    public function get_all_data()
    {
        $query = $this->db->query('select * from ' . $this->table .' where is_active in(1,2) order by id desc');
        return $query->getResult();
    }

    public function get_all_active_data()
    {
        $query = $this->db->query('select * from ' . $this->table .' where is_active in(1) order by id desc');
        return $query->getResult();
    }

    public function insert_data($faqModel = array())
    {
        $this->db->table($this->table)->insert($faqModel); 
        return $this->db->insertID();
    }

    public function get_customer_feedback_products($prodId){
        $query = $this->db->query(
        "SELECT c.*, cc.name,cc.email FROM ProductFeedbacks as c left join Customers as cc on cc.id=c.customer_id WHERE c.customer_id=cc.id AND c.product_id = $prodId AND c.is_active=1;"
        );
        $result = $query->getResult();
        if(count($result) > 0){
            return $result;
        }else{
            return false;
        }
    }

    public function get_customer_feedback_count_ratting($prodId){
        $query = $this->db->query("SELECT * FROM ".$this->table." WHERE product_id = ".$prodId);
        $result = $query->getResult();
        if(count($result) > 0){
            return $result;
        }else{
            return false;
        }
    }

    public function get_customer_feedback_avg_ratting($prodId){
        $query = $this->db->query("SELECT AVG(ratting) AS AverageRate  FROM ".$this->table." WHERE product_id = ".$prodId);      
        $result = $query->getResult();
        if(count($result) > 0){
            return $result;
        }else{
            return false;
        }
    }  
}
?>