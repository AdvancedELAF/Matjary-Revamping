<?php 
namespace App\Models;
use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class PaymentModel extends Model {

    protected $DBGroup              = 'default';
	protected $table                = 'PaymentSetting';
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

	public function get_all_payment_companies(){
		$query = $this->db->query('select * from PaymentGateways where is_active=1');
        return $query->getResult();
	}

    public function insert_data($data = array())
    {
        $query = $this->db->table($this->table)->insert($data);
        return $this->db->insertID();
    }

    public function get_all_data()
    {
        $query = $this->db->query('select * from ' . $this->table .' where is_active=1');
        return $query->getResult();
    }

	public function get_pg_data($pg_id)
    {
        $query = $this->db->query('select * from ' . $this->table .' where id='.$pg_id.' and is_active=1');
		
        return $query->getRow();
    }

    public function update_data($id, $data = array())
    {
		
		$query = $this->db->query('select * from ' . $this->table .' where pay_cmp_id='.$id);
        $qryResult = $query->getResult();
		if(isset($qryResult) && !empty($qryResult)){
			$this->db->table($this->table)->update($data, array(
				"pay_cmp_id" => $id,
			));
			return $this->db->affectedRows();
		}else{
			$array_push_data = array("is_active"=>1,"created_at"=>DATETIME);
			$data = array_merge($data,$array_push_data);
			$query = $this->db->table($this->table)->insert($data);
        	return $this->db->insertID();
		}

        
    }

	public function get_available_payment_gateways(){
		$query = $this->db->query(
			'select 
			ps.*, pg.name as gateway_name 
			from ' . $this->table .' as ps 
			inner join PaymentGateways as pg 
			on pg.id=ps.pay_cmp_id 
			where ps.is_active=1'
		);
        return $query->getResult();
	}    	
}
?>