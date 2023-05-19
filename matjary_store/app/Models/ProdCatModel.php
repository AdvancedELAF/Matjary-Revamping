<?php 
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class ProdCatModel extends Model {

    protected $DBGroup              = 'default';
	protected $table                = 'ProductCategories';
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

    public function check_category_name_exist($cat_name){
        $query = $this->db->query("SELECT * FROM " . $this->table . " WHERE category_name='".$cat_name."'");
        $result = $query->getResult();
        if(count($result) > 0){
            return true;
        }else{
            return false;
        }
    }

    public function check_category_name_ar_exist($cat_name_ar){
        $query = $this->db->query("SELECT * FROM " . $this->table . " WHERE category_name_ar='".$cat_name_ar."'");
        $result = $query->getResult();
        if(count($result) > 0){
            return true;
        }else{
            return false;
        }
    }

    public function insert_data($data = array()){
        if(isset($data['category_name']) && !empty($data['category_name'])){
            $query = $this->db->query('select * from ' . $this->table . ' where category_name = "'.$data['category_name'].'" ');
        }else{
            $query = $this->db->query('select * from ' . $this->table . ' where category_name_ar = "'.$data['category_name_ar'].'" ');
        }
        
        $query = $query->getResult();
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
            select 
            pcat.id,
            pcat.parent_cat_id,
            pcat1.category_name as parent_cat, 
            pcat.category_name,
            pcat.category_desc,
            pcat1.category_name_ar as parent_cat_ar, 
            pcat.category_name_ar,
            pcat.category_desc_ar,
            pcat.is_active 
            from ' . $this->table .' as pcat 
            LEFT JOIN ProductCategories AS pcat1 ON pcat.id = pcat1.parent_cat_id 
            where id='.$id.' 
            ');
        return $query->getResult();
    }

    public function get_all_data()
    {
        $query = $this->db->query(
            '
            select
            pcat1.id as id,
            pcat.category_name as parent_cat_name,
            pcat1.category_name,
            pcat1.category_name_ar,
            pcat1.parent_cat_id,
            pcat1.category_img,
            pcat1.is_active
            from ProductCategories as pcat
            RIGHT JOIN ProductCategories AS pcat1
            ON pcat.id = pcat1.parent_cat_id
            where pcat1.is_active in(1) order by pcat1.id desc
        ');
        
        return $query->getResult();
    }    
    
    public function get_all_active_data(){
        
        $query = $this->db->query(
            '
            select
            pcat1.id as id,
            pcat.category_name as parent_cat_name,
            pcat1.category_name,
            pcat1.category_img,
            pcat.category_name_ar as parent_cat_name_ar,
            pcat1.category_name_ar,
            pcat1.parent_cat_id,
            pcat1.is_active
            from ProductCategories as pcat
            RIGHT JOIN ProductCategories AS pcat1
            ON pcat.id = pcat1.parent_cat_id 
            where pcat1.parent_cat_id = 0 and pcat1.is_active in(1) order by pcat1.id desc
            ');
           
        return $query->getResult();
    }
    public function get_all_active_category_data(){
        
        $query = $this->db->query(
            '
            select
            pcat1.id as id,
            pcat.category_name as parent_cat_name,
            pcat1.category_name,
            pcat.category_name_ar as parent_cat_name_ar,
            pcat1.category_name_ar,
            pcat1.parent_cat_id,
            pcat1.category_img,
            pcat1.is_active
            from ProductCategories as pcat
            RIGHT JOIN ProductCategories AS pcat1
            ON pcat.id = pcat1.parent_cat_id 
            where pcat1.is_active in(1) order by pcat1.id desc
            ');
           
        return $query->getResult();
    }

    public function get_all_active_subCategory($parent_cat_id){
        $query = $this->db->query(
            '
            select
            pcat.id,
            pcat.category_name,
            pcat.category_name_ar,
            pcat.parent_cat_id,
            pcat.is_active
            from ProductCategories as pcat
            where pcat.parent_cat_id = '.$parent_cat_id.' and pcat.is_active in(1) order by pcat.id desc
        ');
        return $query->getResult();
    }   	
}

?>