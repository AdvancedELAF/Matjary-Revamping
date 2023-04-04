<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ShippingCompanies extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'        =>    'Aramex',
                'description' =>    'Our Domestic Express service offers reliable door-to-door solutions for time-critical packages that need to be delivered within your country or city. We can pick up and deliver your packages within agreed times and you can track your shipments online at any time.',
                'is_active'   =>    1,
                'created_at'  =>    DATETIME,
                'updated_at'  =>    DATETIME
            ],
            [
                'name'        =>    'ZidShip',
                'description' =>    'An integrated shipping solution to get shipping services from diverse providers with one contract and one team of customer support with ZidShip.',
                'is_active'   =>    1,
                'created_at'  =>    DATETIME,
                'updated_at'  =>    DATETIME
            ]
        ];

        /* Using Query Builder */
        $this->db->table('shippingcompanies')->insertBatch($data);

    }
}

?>