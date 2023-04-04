<?php 
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class SizeModel extends Model {

    protected $DBGroup              = 'default';
	protected $table                = 'Sizes';
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
        $query = $this->db->query('select * from ' . $this->table .' where is_active in(1,2) order by id desc');
        return $query->getResult();
    }

    public function get_all_active_data()
    {
        $query = $this->db->query('select * from ' . $this->table .' where is_active in(1) order by id desc');
        return $query->getResult();
    }

    public function check_size_name_exist($size){
        $query = $this->db->query("SELECT * FROM " . $this->table ." WHERE size='".$size."'");
        $result = $query->getResult();
        if(count($result) > 0){
            return true;
        }else{
            return false;
        }
    }

    public function insert_data($data = array())
    {
        $query = $this->db->query('select * from ' . $this->table . ' where size = "'.$data['size'].'"');
        $query = $query->getResult();

        //echo print_r($query); exit;
        if(count($query) > 0){
            return false;
        }else{
            $this->db->table($this->table)->insert($data);
            return $this->db->insertID();
        }
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

    public function get_single_prod_cat_details($id){
        $query = $this->db->query(
            '
            select * from ' . $this->table .' 
            where id='.$id.' 
            ');
        return $query->getResult();
    }
    // public function get_productwise_size($prodId) 
    // {
	// 	$query = $this->db->query("select Products.id as pro_id,Products.is_active ,Products.size_id ,Products.color_id ,Sizes.id as size_id, Sizes.size            
    //            from Products
    //            LEFT JOIN Sizes ON Products.size_id = Sizes.id  
	// 		   where Products.id = '.$prodId.' and Products.is_active in (1,2)			           
    //            ORDER by Products.id"); 
	// 		return $query->getResult();
		
    // }

    

	
}








?>