<?php 
namespace App\Models;
use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class UserRoleModel extends Model {

    protected $DBGroup              = 'default';
	protected $table                = 'UserRoles';
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
        $query = $this->db->query('select * from ' . $this->table . ' where is_active in(1,2) order by id desc');
        return $query->getResult();
		

    }
	public function get_all_data_grid() 
    {
		$query = $this->db->query("select Users.id as user_id,Users.is_active ,Users.name ,Users.email ,userroles.id as role_id, userroles.role_name            
               from Users
               LEFT JOIN UserRoles ON Users.role_id = UserRoles.id  
			   where Users.is_active in (1,2)			           
               ORDER by Users.id"); 
			return $query->getResult();
		
    }

  
}

?>