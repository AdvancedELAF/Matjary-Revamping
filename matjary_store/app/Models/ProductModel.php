<?php 
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class ProductModel extends Model {

    protected $DBGroup              = 'default';
	protected $table                = 'Products';
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

    public function get_all_data(){
        $query = $this->db->query(
            '
            select p.*, p.retail_price - (p.retail_price * (p.discount_per / 100)) AS product_price ,pc.category_name, pc.category_name_ar 
            from ' . $this->table .' as p 
            left join ProductCategories as pc 
            on p.category_id=pc.id 
            where p.is_active in(1,2) 
            order by p.id desc
            '
        );
        return $query->getResult();
    }

    public function get_single_product_details($productId){
        $builder = $this->db->table($this->table)->select('id')->where('id', $productId);
        $numRows = $builder->countAll();
        if($numRows > 0){
            $query = $this->db->query(
                '
                select p.*, p.retail_price - (p.retail_price * (p.discount_per / 100)) AS product_price ,pc.category_name,pc.category_name_ar 
                from ' . $this->table .' as p 
                left join ProductCategories as pc 
                on p.category_id=pc.id 
                where p.id='.$productId
            );
            return $query->getRow();
        }else{
            return false;
        }

    }

    public function get_search_result($query,$ses_lang){
        if($ses_lang=='en'){
            $query = $this->db->query(
                'select 
                p.*, p.retail_price - (p.retail_price * (p.discount_per / 100)) AS product_price 
                FROM ' . $this->table .' as p 
                WHERE p.title LIKE "%'.trim($query).'%"  
                OR p.keywords LIKE "%'.trim($query).'%" 
                OR p.tags LIKE "%'.trim($query).'%" 
                OR p.title_ar LIKE "%'.trim($query).'%" 
                OR p.keywords_ar LIKE "%'.trim($query).'%" 
                OR p.tags_ar LIKE "%'.trim($query).'%"  
                AND p.is_active in(1) 
                ORDER BY p.id DESC '
            );
            
        }else{
            $query = $this->db->query(
                'select 
                p.*, p.retail_price - (p.retail_price * (p.discount_per / 100)) AS product_price 
                FROM ' . $this->table .' as p 
                WHERE p.title LIKE "%'.trim($query).'%"  
                OR p.keywords LIKE "%'.trim($query).'%" 
                OR p.tags LIKE "%'.trim($query).'%" 
                OR p.title_ar LIKE "%'.trim($query).'%" 
                OR p.keywords_ar LIKE "%'.trim($query).'%" 
                OR p.tags_ar LIKE "%'.trim($query).'%"  
                AND p.is_active in(1) 
                ORDER BY p.id DESC '
            );
        }
        return $query->getResult();
    }

    public function get_all_active_data()
    {
        $query = $this->db->query(
            'select 
            p.*, p.retail_price - (p.retail_price * (p.discount_per / 100)) AS product_price 
            from ' . $this->table .' as p 
            where p.is_active in(1) 
            order by p.id desc'
        );
        
        return $query->getResult();
    }
    public function get_feature_product_data()
    {
        $query = $this->db->query(
            'select 
            p.*, p.retail_price - (p.retail_price * (p.discount_per / 100)) AS product_price 
            from ' . $this->table .' as p 
            where p.feature=1 and p.is_active in(1) 
            order by p.id desc'
        );
        
        return $query->getResult();
    }

    public function check_product_name_exist($product_name){
        $query = $this->db->query("SELECT p.*, p.retail_price - (p.retail_price * (p.discount_per / 100)) AS product_price FROM " . $this->table ." as p WHERE p.title='".$product_name."'");
        $result = $query->getResult();
        if(count($result) > 0){
            return true;
        }else{
            return false;
        }
    }

    public function check_product_name_ar_exist($product_name_ar){
        $query = $this->db->query("SELECT p.*, p.retail_price - (p.retail_price * (p.discount_per / 100)) AS product_price FROM " . $this->table ." as p WHERE p.title_ar='".$product_name_ar."'");
        $result = $query->getResult();
        if(count($result) > 0){
            return true;
        }else{
            return false;
        }
    }

    public function insert_data($data = array()){
        if(isset($data['title']) && !empty($data['title'])){
            $query = $this->db->query('select * from ' . $this->table . ' where title = "'.$data['title'].'"');
        }else{
            $query = $this->db->query('select * from ' . $this->table . ' where title_ar = "'.$data['title_ar'].'"');
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

    public function get_single_prod_details($id){
        $query = $this->db->query(
            '
            select p.*, p.retail_price - (p.retail_price * (p.discount_per / 100)) AS product_price from ' . $this->table .' as p 
            where p.id='.$id.' 
            ');
        return $query->getResult();
    }
    public function get_all_prod_categories($id){
        $query = $this->db->query('select p.*, p.retail_price - (p.retail_price * (p.discount_per / 100)) AS product_price from ' . $this->table .' as p where p.category_id='.$id.' ');
        return $query->getResult();
    }
    public function get_categories_details($id){
        $query = $this->db->query(
            'select 
            id,parent_cat_id,category_name,category_name_ar,category_img,is_active from ProductCategories 
            where id='.$id.' 
            ');
        
        return $query->getResult();
    }

    public function get_latest_product_data(){
        $query = $this->db->query('
            select p.*, p.retail_price - (p.retail_price * (p.discount_per / 100)) AS product_price from ' . $this->table .' as p 
            WHERE  DATE_SUB(CURDATE(),INTERVAL 30 DAY) <= p.created_at and p.is_active in(1)  
        ');
        return $query->getResult();
    }
    
    public function get_discount_product_data(){ 
        $query = $this->db->query('
            select p.*, p.retail_price - (p.retail_price * (p.discount_per / 100)) AS product_price from ' . $this->table .' as p 
            WHERE p.discount_per IS NOT NULL and p.discount_per != 0 and p.is_active in(1)  
        '); 
        return $query->getResult();
    }
    
    public function check_product_total_exist(){
        $query = $this->db->query(
            'select id  FROM ' . $this->table .' where is_active in(1)'
        ); 
        $result = $query->getResult();       
    }
	
}

?>