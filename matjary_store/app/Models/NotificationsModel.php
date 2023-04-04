<?php 
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class NotificationsModel extends Model {

    protected $DBGroup              = 'default';
	protected $table                = 'Notifications';
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

    public function get_all_data(){  
        $query = $this->db->query(
            '
            select 
            N.*,
            NotificationCategories.id,NotificationCategories.name,NotificationCategories.name_ar,NotificationCategories.is_active			
            from  Notifications as N 
            left join NotificationCategories on NotificationCategories.id = N.type_id 			
            where NotificationCategories.is_active=1 and N.created_at BETWEEN CURDATE() - INTERVAL 10 DAY AND CURDATE()
            order by N.id desc 
            '
        );
        return $query->getResult();
    }

    public function get_all_active_data()
    {
        $query = $this->db->query('select * from ' . $this->table .' where is_active in(1) order by id desc');
        return $query->getResult();
    }

    public function insert_data($data = array())
    {
        $this->db->table($this->table)->insert($data);
        return $this->db->insertID();
    }

}


?>