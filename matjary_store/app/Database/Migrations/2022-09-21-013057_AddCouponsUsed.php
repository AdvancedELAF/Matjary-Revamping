<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCouponsUsed extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'customer_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'order_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],             
            'coupon_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'coupon_amount' => [
                'type'       => 'float',            
            ],
            'created_at' => [
                'type'           => 'DATETIME',
                'null' => true,
            ],            
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('CouponsUsed');
    }

    public function down()
    {
        $this->forge->dropTable('CouponsUsed');
    }
}