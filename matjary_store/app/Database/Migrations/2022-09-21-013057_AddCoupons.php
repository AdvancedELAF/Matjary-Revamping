<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCoupons extends Migration
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
            'coupon_code' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'coupon_title' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'coupon_desc' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'coupon_startdate' => [
                'type'      => 'DATE',
                'null'      => false,
            ],
            'coupon_expirydate' => [
                'type'      => 'DATE',
                'null'      => false,
            ],
            'quantity' => [
                'type'      => 'INT',
                'constraint' => '100',
                'null'      => true,
            ],
            'discount_type' => [
                'type'      => 'INT',
                'constraint' => '100',
                'null'      => true,
                'comment' => '1=percentage,2=amount',                
            ],
            'discount_value' => [
                'type'      => 'INT',
                'constraint' => '100',
                'null'      => true,
            ],
            'for_orders' => [
                'type'      => 'INT',
                'constraint' => '100',
                'null'      => true,
                'comment' => '1=all orders,2=orders over',
            ],
            'min_amount' => [
                'type'      => 'INT',
                'constraint' => '100',
                'null'      => true,
            ],
            'is_active' => [
                'type' => 'INT',
                'constraint' => 5,
                'comment' => '1=active,2=deactive,3=deleted',
            ],
            'created_at' => [
                'type'           => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type'           => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('Coupons');
    }

    public function down()
    {
        $this->forge->dropTable('Coupons');
    }
}