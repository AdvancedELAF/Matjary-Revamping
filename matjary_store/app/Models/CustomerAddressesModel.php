<?php 
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class CustomerAddressesModel extends Model {

    protected $DBGroup              = 'default';
	protected $table                = 'CustomerAddresses';
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
    }

    public function get_all_data()
    {
        $query = $this->db->query('select * from ' . $this->table .' order by id desc');
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


    public function delete_data($id)
    {
        return $this->db->table($this->table)->delete(array(
            "id" => $id,
        ));
    }

    public function get_customer_address_list($customerId){
        $query = $this->db->query(
            '
            select 
            ca.*, 
            Countries.name as country_name,
            States.name as state_name,
            Cities.name as city_name 
            from ' . $this->table .' as ca 
            inner join Countries on Countries.id=ca.country_id 
            inner join States on States.id=ca.state_id 
            inner join Cities on Cities.id=ca.city_id 
            where ca.customer_id='.$customerId.' and ca.is_active = 1 order by ca.id desc' 
        );
        return $query->getResult();
    }

    public function get_single_address_info($addressId){
        $query = $this->db->query(
            '
            select 
            ca.*, 
            Countries.name as country_name,
            States.name as state_name,
            Cities.name as city_name 
            from ' . $this->table .' as ca 
            inner join Countries on Countries.id=ca.country_id 
            inner join States on States.id=ca.state_id 
            inner join Cities on Cities.id=ca.city_id 
            where ca.id='.$addressId.' and ca.is_active=1 
            '
        );
        return $query->getRow();
    }

    public function get_customer_single_address_info($addressId,$custmrId){
        $query = $this->db->query(
            '
            select 
            ca.*, 
            Countries.name as country_name,
            States.name as state_name,
            Cities.name as city_name,
            Customers.id as customer_id,
            Customers.name as customer_name,
            Customers.contact_no as customer_contactno,
            Customers.email as customer_email 
            from ' . $this->table .' as ca 
            left join Customers on Customers.id=ca.customer_id 
            inner join Countries on Countries.id=ca.country_id 
            inner join States on States.id=ca.state_id 
            inner join Cities on Cities.id=ca.city_id 
            where ca.id='.$addressId.' 
            and ca.customer_id='.$custmrId.' 
            and ca.is_active=1 
            '
        );
        return $query->getRow();
    }   
}

?>