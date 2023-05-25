<?php

class DashboardModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        //$this->check_db = $this->load->database('check_db', TRUE);
    }

    public function dashboard_analytics() {
        try {
            $result = [];
            
            $query = $this->db->query("SELECT id , email  FROM users WHERE is_active='1'");
            $result['totalUser'] = $query->result();

            $query = $this->db->query("SELECT id , email  FROM newsletter_email_list WHERE is_active='1'");
            $result['emailSubscribers'] = $query->result();

            $query = $this->db->query("SELECT id  FROM user_payment_info WHERE is_active='1'");
            $result['totalOrders'] = $query->result();

            $query = $this->db->query("SELECT SUM(total_price) as total FROM user_payment_info WHERE is_active='1' ");
            $result['totalRevenue'] = $query->result();

            $query = $this->db->query("SELECT id , created_datetime FROM users WHERE  created_datetime BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() and is_active='1'");
	        $result['totalResentUsers'] = $query->result();

            $query = $this->db->query("SELECT id , created_at FROM user_payment_info WHERE  created_at BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() and is_active='1'");
	        $result['totalResentOrders'] = $query->result();

            $query = $this->db->query("SELECT SUM(total_price) as total FROM user_payment_info WHERE created_at BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() and is_active='1' ");
            $result['totalRecentRevenue'] = $query->result();

            return $result;           
            
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    
    public function get_monthly_user_register_report() {
        try {
        $query = $this->db->query("SELECT 
            SUM(IF(month = 'Jan', total, 0)) AS 'Jan',
            SUM(IF(month = 'Feb', total, 0)) AS 'Feb',
            SUM(IF(month = 'Mar', total, 0)) AS 'Mar',
            SUM(IF(month = 'Apr', total, 0)) AS 'Apr',
            SUM(IF(month = 'May', total, 0)) AS 'May',
            SUM(IF(month = 'Jun', total, 0)) AS 'Jun',
            SUM(IF(month = 'Jul', total, 0)) AS 'Jul',
            SUM(IF(month = 'Aug', total, 0)) AS 'Aug',
            SUM(IF(month = 'Sep', total, 0)) AS 'Sep',
            SUM(IF(month = 'Oct', total, 0)) AS 'Oct',
            SUM(IF(month = 'Nov', total, 0)) AS 'Nov',
            SUM(IF(month = 'Dec', total, 0)) AS 'Dec'
            FROM
            (SELECT 
                MIN(DATE_FORMAT(created_datetime, '%b')) AS month,
                count(id) AS total
            FROM
                users
            WHERE YEAR(created_datetime)=YEAR(now()) and is_active='1'
            GROUP BY YEAR(created_datetime) , MONTH(created_datetime)
            ORDER BY YEAR(created_datetime) , MONTH(created_datetime)) AS sale;");
            return $query->row();
        
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function get_monthly_sales_report() {
        try {
        $query = $this->db->query("SELECT 
            SUM(IF(month = 'Jan', total, 0)) AS 'Jan',
            SUM(IF(month = 'Feb', total, 0)) AS 'Feb',
            SUM(IF(month = 'Mar', total, 0)) AS 'Mar',
            SUM(IF(month = 'Apr', total, 0)) AS 'Apr',
            SUM(IF(month = 'May', total, 0)) AS 'May',
            SUM(IF(month = 'Jun', total, 0)) AS 'Jun',
            SUM(IF(month = 'Jul', total, 0)) AS 'Jul',
            SUM(IF(month = 'Aug', total, 0)) AS 'Aug',
            SUM(IF(month = 'Sep', total, 0)) AS 'Sep',
            SUM(IF(month = 'Oct', total, 0)) AS 'Oct',
            SUM(IF(month = 'Nov', total, 0)) AS 'Nov',
            SUM(IF(month = 'Dec', total, 0)) AS 'Dec'
            FROM
            (SELECT 
                MIN(DATE_FORMAT(created_at, '%b')) AS month,
                SUM(total_price) AS total
            FROM
                user_payment_info
            WHERE YEAR(created_at)=YEAR(now()) and is_active='1'
            GROUP BY YEAR(created_at) , MONTH(created_at)
            ORDER BY YEAR(created_at) , MONTH(created_at)) AS sale;");
            return $query->row();
        
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function get_monthly_orders_report() {
        try {
        $query = $this->db->query("SELECT 
            SUM(IF(month = 'Jan', total, 0)) AS 'Jan',
            SUM(IF(month = 'Feb', total, 0)) AS 'Feb',
            SUM(IF(month = 'Mar', total, 0)) AS 'Mar',
            SUM(IF(month = 'Apr', total, 0)) AS 'Apr',
            SUM(IF(month = 'May', total, 0)) AS 'May',
            SUM(IF(month = 'Jun', total, 0)) AS 'Jun',
            SUM(IF(month = 'Jul', total, 0)) AS 'Jul',
            SUM(IF(month = 'Aug', total, 0)) AS 'Aug',
            SUM(IF(month = 'Sep', total, 0)) AS 'Sep',
            SUM(IF(month = 'Oct', total, 0)) AS 'Oct',
            SUM(IF(month = 'Nov', total, 0)) AS 'Nov',
            SUM(IF(month = 'Dec', total, 0)) AS 'Dec'
            FROM
            (SELECT 
                MIN(DATE_FORMAT(created_at, '%b')) AS month,
                count(id) AS total
            FROM
                user_payment_info
            WHERE YEAR(created_at)=YEAR(now()) and is_active='1'
            GROUP BY YEAR(created_at) , MONTH(created_at)
            ORDER BY YEAR(created_at) , MONTH(created_at)) AS sale;");
            return $query->row();
        
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function get_monthly_revenue_report() {
        try {
        $query = $this->db->query("SELECT 
            SUM(IF(month = 'Jan', total, 0)) AS 'Jan',
            SUM(IF(month = 'Feb', total, 0)) AS 'Feb',
            SUM(IF(month = 'Mar', total, 0)) AS 'Mar',
            SUM(IF(month = 'Apr', total, 0)) AS 'Apr',
            SUM(IF(month = 'May', total, 0)) AS 'May',
            SUM(IF(month = 'Jun', total, 0)) AS 'Jun',
            SUM(IF(month = 'Jul', total, 0)) AS 'Jul',
            SUM(IF(month = 'Aug', total, 0)) AS 'Aug',
            SUM(IF(month = 'Sep', total, 0)) AS 'Sep',
            SUM(IF(month = 'Oct', total, 0)) AS 'Oct',
            SUM(IF(month = 'Nov', total, 0)) AS 'Nov',
            SUM(IF(month = 'Dec', total, 0)) AS 'Dec'
            FROM
            (SELECT 
                MIN(DATE_FORMAT(created_at, '%b')) AS month,
                sum(total_price) AS total
            FROM
                user_payment_info
            WHERE YEAR(created_at)=YEAR(now()) and is_active='1'
            GROUP BY YEAR(created_at) , MONTH(created_at)
            ORDER BY YEAR(created_at) , MONTH(created_at)) AS sale;");
            return $query->row();
        
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

?>