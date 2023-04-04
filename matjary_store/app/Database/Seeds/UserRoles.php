<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserRoles extends Seeder
{
    public function run()
    {
        $data = [
            [
                'role_name'   =>    'Store Super Admin',
                'description' =>    'A store super administrator, sometimes referred to as a store manager, is a person whose duties are to oversee the daily operations of a retail store. In this career, you provide customer assistance, lead job training, monitor inventory, and make performance assessments of employees and sales.',
                'is_active'   =>    1,
                'created_at'  =>    DATETIME,
                'updated_at'  =>    DATETIME
            ],
            [
                'role_name'   =>    'Store Admin',
                'description' =>    'A store administrator, sometimes referred to as a store manager, is a person whose duties are to oversee the daily operations of a retail store. In this career, you provide customer assistance, lead job training, monitor inventory, and make performance assessments of employees and sales.',
                'is_active'   =>    1,
                'created_at'  =>    DATETIME,
                'updated_at'  =>    DATETIME
            ],
            [
                'role_name'   =>    'Store Support Manager',
                'description' =>    'Developing store strategies to raise customers pool, expand store traffic and optimize profitability. Meeting sales goals by training, motivating, mentoring and providing feedback to store staff. Ensuring high levels of customers satisfaction through excellent service.',
                'is_active'   =>    1,
                'created_at'  =>    DATETIME,
                'updated_at'  =>    DATETIME
            ],
            [
                'role_name'   =>    'Store Technical Support Manager',
                'description' =>    'As a Technical Support Manager, you will be resolving the technical faults in software and hardware. You will be installing and configuring computer systems. You will also be identifying and resolving any issues regarding computer hardware and software.',
                'is_active'   =>    1,
                'created_at'  =>    DATETIME,
                'updated_at'  =>    DATETIME
            ],
            [
                'role_name'   =>    'Store Sales Support Manager',
                'description' =>    'A sales support manager is responsible for monitoring the sales operations of an organization, evaluating the sales performance, and conducting data analysis and research to identify business opportunities that would generate more revenue resources and increase the companys profitability.',
                'is_active'   =>    1,
                'created_at'  =>    DATETIME,
                'updated_at'  =>    DATETIME
            ],
            [
                'role_name'   =>    'Store Inventory Manager',
                'description' =>    'Oversees team of inventory or warehouse employees. Manages inventory tracking system to record deliveries, shipments and stock levels. Evaluates deliveries, shipments and product levels to improve inventory control procedures. Analyzes daily product and supply levels to anticipate inventory problems and shortages.',
                'is_active'   =>    1,
                'created_at'  =>    DATETIME,
                'updated_at'  =>    DATETIME
            ]
        ];

        /* Using Query Builder */
        $this->db->table('userroles')->insertBatch($data);

    }
}

?>