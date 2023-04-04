<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NotificationCategories extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'   =>    'New Customer Registred on Store',                
                'is_active'   =>    1,
                'created_at'  =>    DATETIME
            ],
            [
                'name'   =>    'Order Placed By Customer',                
                'is_active'   =>    1,
                'created_at'  =>    DATETIME
            ],
            [
                'name'   =>    'Refund Request Raised By Customer',                
                'is_active'   =>    1,
                'created_at'  =>    DATETIME
            ],
            [
                'name'   =>    'Gift Card Purchased By Customer',                
                'is_active'   =>    1,
                'created_at'  =>    DATETIME
            ]            
        ];

        /* Using Query Builder */
        $this->db->table('NotificationCategories')->insertBatch($data);

    }
}

?>