<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MasterSeeder extends Seeder
{
    public function run()
    {
        /* Seeders can call other seeders, with the call() method. */
        $this->call('PaymentGateways');
        $this->call('ShippingCompanies');
        $this->call('UserRoles');
        $this->call('Countries');
        $this->call('States');
        $this->call('Cities');
        $this->call('NotificationCategories');


    }
}

?>