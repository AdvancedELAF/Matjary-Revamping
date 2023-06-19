<?php 
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class UserModel extends Model {

    protected $DBGroup              = 'default';
	protected $table                = 'Users';
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
       
        $query = $this->db->query(
            "select 
            Users.id as user_id,
            Users.name,
            Users.email,
            Users.is_active,
            UserRoles.id as role_id, 
            UserRoles.role_name            
            from Users
            LEFT JOIN UserRoles ON Users.role_id = UserRoles.id  
            where Users.is_active in (1,2)			           
            ORDER by Users.id DESC"); 
		return $query->getResult();
    }
    public function get_login_user_data($userId)
    {
        
        $query = $this->db->query(
            "select 
            Users.id as user_id,
            Users.name,
            Users.email,
            Users.addr_residential,
            Users.addr_permanent,
            Users.role_id,
            Users.profile_image,
            Users.country_id,
            Users.state_id,
            Users.city_id,
            Users.zipcode,
            Users.contact_no,
            Users.date_of_birth,
            Users.gender,
            Users.social_fb_link,
            Users.social_twitter_link,
            Users.social_linkedin_link,           
            Users.social_skype_link,
            Users.is_active,
            UserRoles.id as role_id, 
            UserRoles.role_name            
            from Users
            LEFT JOIN UserRoles ON Users.role_id = UserRoles.id  
            where Users.id = ".$userId."  and Users.is_active in (1,2)			           
            ORDER by Users.id DESC"); 
        return $query->getFirstRow();
    }

    public function insert_data($userModel = array())
    {
        $this->db->table($this->table)->insert($userModel);
        return $this->db->insertID();
    }

    public function update_data($id, $data = array())
    {
        $this->db->table($this->table)->update($data, array(
            "id" => $id,
        ));
        return $this->db->affectedRows();
    }

    public function check_email_exist($email){
        $query = $this->db->query("SELECT * FROM Users WHERE email='".$email."' ");
        $result = $query->getResult();
        if(count($result) > 0){
            return true;
        }else{
            return false;
        }
    }

    public function insert_user_reset_pass_data($data){
        $this->db->table('PasswordResets')->insert($data);
        return $this->db->insertID();
    }
    
    public function insert_cust_pass_data($userId,$data){
     
        $this->db->table('UsersCredentials')->insert($data);

        $checkData = $this->db->query('select * from PasswordResets where user_id = "'.$userId.'" and reset_flag = 1');
        
        $row = $checkData->getRow();
       
        if(isset($row) && !empty($row)){
            $rowid = $row->id;   
            $aftectedId = $this->db
                        ->table('PasswordResets')
                        ->where(["id" => $rowid])
                        ->set(["reset_flag" => 0])
                        ->set(["updated_at" => DATETIME])
                        ->update();

           $aftectedId = $this->db->affectedRows();
           if(is_int($aftectedId)){
            return true;
           }else{
            return false;
           }

        }else{
            return false;
        }
    }

    public function chk_user_exist_with_email($email){
        $query = $this->db->query(
            "SELECT c.id,c.name,c.email,uc.password 
            FROM ".$this->table." as c 
            left join UsersCredentials as uc 
            on uc.user_id=c.id 
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
    public function chk_verify_password($userId){       
        $query = $this->db->query("SELECT * FROM UsersCredentials WHERE user_id=".$userId);
        return $query->getResult();     
       
    }

    public function update_cust_pass($customer_id, $data = array()){

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

    public function update_user_pass_data($userId, $data = array()){

        $query = $this->db->query(
            "SELECT uc.id FROM UsersCredentials as uc WHERE uc.user_id=".$userId
        );
        $result = $query->getRow();
        if(isset($result) && !empty($result)){
            $this->db->table('UsersCredentials')->update($data, array(
                "user_id" => $userId
            ));
        }else{
            $this->db->table('UsersCredentials')->insert($data);
        }

        $this->db->table('PasswordResets')->update(array(
            "user_id" => $userId,
            "reset_flag" => 0,
            "updated_at" => DATETIME
        ));
        return $this->db->affectedRows();
    }

    public function chk_reset_pass_request_exist($userId){
        $query = $this->db->query(
            "SELECT u.id,u.name,u.email  
            FROM ".$this->table." as u 
            left join PasswordResets as pr
            on pr.user_id=u.id 
            WHERE u.id='".$userId."' 
            AND pr.reset_flag=1 
            AND u.is_active=1"
        );
        $result = $query->getRow();
        if(isset($result) && !empty($result)){
            return true;
        }else{
            return false;
        }
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