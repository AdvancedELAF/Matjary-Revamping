<?php 
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class CustomerModel extends Model {

    protected $DBGroup              = 'default';
	protected $table                = 'Customers';
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
        $query = $this->db->query("SELECT * FROM ".$this->table." WHERE is_active in(1,2) order by id desc");
        return $query->getResult();
    }

    public function get_single_customer_data($customerId){
        $query = $this->db->query(
            '
            select 
            c.*,
            Countries.name as country_name,
            States.name as state_name,
            Cities.name as city_name 
            from '.$this->table.' as c 
            left join Countries on Countries.id=c.country_id 
            left join States on States.id=c.state_id 
            left join Cities on Cities.id=c.city_id 
            where c.id='.$customerId.'  
            and c.is_active=1
            '
        );
        return $query->getRow();
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

    public function update_cust_pass_data($customer_id, $data = array()){

        $query = $this->db->query(
            "SELECT uc.id FROM CustomersCredentials as uc WHERE uc.customer_id=".$customer_id
        );
        $result = $query->getRow();
        if(isset($result) && !empty($result)){
            $this->db->table('CustomersCredentials')->update($data, array(
                "customer_id" => $customer_id
            ));
        }else{
            $this->db->table('CustomersCredentials')->insert($data);
        }

        $this->db->table('PasswordResets')->update(array(
            "customer_id" => $customer_id,
            "reset_flag" => 0,
            "updated_at" => DATETIME
        ));
        return $this->db->affectedRows();
    }

    public function delete_data($id)
    {
        return $this->db->table($this->table)->delete(array(
            "id" => $id,
        ));
    }
    public function check_email_exist($email){
        $query = $this->db->query("SELECT * FROM Customers WHERE email='".$email."' ");
        $result = $query->getResult();
        if(count($result) > 0){
            return true;
        }else{
            return false;
        }
    }

    public function insert_customer_reset_pass_data($data){
        $this->db->table('PasswordResets')->insert($data);
        return $this->db->insertID();
    }

    public function insert_cust_pass_data($data){
        $this->db->table('CustomersCredentials')->insert($data);
        return $this->db->insertID();
    }

    public function chk_reset_pass_request_exist($customerId){        
            $query = $this->db->query(
                "SELECT c.id,c.name,c.email  
                FROM ".$this->table." as c 
                left join PasswordResets as pr
                on pr.customer_id=c.id 
                WHERE c.id='".$customerId."' 
                AND pr.reset_flag=1 
                AND c.is_active=1"
            );        
        $result = $query->getRow();
        if(isset($result) && !empty($result)){
            return true;
        }else{
            return false;
        }
    }

    public function chk_customer_exist_with_email($email){
        $query = $this->db->query(
            "SELECT c.id,c.name,c.email,cc.password 
            FROM ".$this->table." as c 
            left join CustomersCredentials as cc 
            on cc.customer_id=c.id 
            WHERE c.email='".$email."' 
            AND c.is_active=1"
        );
        $result = $query->getRow();
        if(isset($result) && !empty($result)){
            return $result;
        }else{
            return false;
        }
    }

    public function chk_customer_credentials($data){
        $query = $this->db->query(
            "SELECT c.id,c.name,c.email 
            FROM ".$this->table." as c 
            left join CustomersCredentials as cc 
            on cc.customer_id=c.id 
            WHERE c.email='".$data['email']."' 
            AND cc.password 
            AND c.is_active=1"
        );
       
        $result = $query->getResult();

        if(count($result) > 0){
            return $result;
        }else{
            return false;
        }
    }
    public function chk_verify_password($customer_id){
       $query = $this->db->query("SELECT * FROM CustomersCredentials WHERE id=".$customer_id);
       return $query->getResult();
     
      
    }
    public function update_cust_pass($customerId, $data = array()){
        $this->db->table('CustomersCredentials')->update($data, array(
            "customer_id" => $customerId
        ));      
        return $this->db->affectedRows();
    }

    public function delete_profile_picture($id)
    {       
        $this->db
            ->table($this->table)
            ->where(["id" => $id])
            ->set(["profile_image" => ''])
            ->update();
        return $this->db->affectedRows();
    }
       
}

?>