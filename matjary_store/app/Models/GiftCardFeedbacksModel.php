<?php 
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class GiftCardFeedbacksModel extends Model {

    protected $DBGroup              = 'default';
	protected $table                = 'GiftCardFeedbacks';
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
    
    public function insert_customer_giftcard($data = array()){
        $this->db->table('GiftCardPurchased')->insert($data); 
        return $this->db->insertID();
    }

    public function insert_data($bannerModel = array())
    {
        $this->db->table($this->table)->insert($bannerModel); 
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
    
    public function get_single_gift_details($giftId){
        $query = $this->db->query('select * from ' . $this->table .' where id= "'.$giftId.'" and is_active in(1) ');
        return $query->getFirstRow();
    } 
    
    public function get_customer_feedback_gift_card($customerId,$gcId){
        $query = $this->db->query("SELECT * FROM ".$this->table." WHERE customer_id=".$customerId." and gc_id = ".$gcId);
        $result = $query->getResult();
        if(count($result) > 0){
            return $result;
        }else{
            return false;
        }
    }
    public function get_customer_feedback_count_ratting($giftId){
        $query = $this->db->query("SELECT * FROM ".$this->table." WHERE gc_id = ".$giftId);
        $result = $query->getResult();
        if(count($result) > 0){
            return $result;
        }else{
            return false;
        }
    }

    public function get_customer_feedback_avg_ratting($giftId){
        $query = $this->db->query("SELECT AVG(ratting) AS AverageRate  FROM ".$this->table." WHERE gc_id = ".$giftId);
        $result = $query->getResult();
        if(count($result) > 0){
            return $result;
        }else{
            return false;
        }
    }

    public function get_all_fb($giftId)
    {
        $query = $this->db->query(
            "SELECT c.*, cc.name,cc.email FROM GiftCardFeedbacks as c left join Customers as cc on cc.id=c.customer_id WHERE c.customer_id=cc.id AND  c.gc_id = $giftId AND c.is_active=1;"
        );
        return $query->getResult();
    }
    
}

?>