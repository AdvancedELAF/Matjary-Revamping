<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddOrderItems extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'order_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'product_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'product_qty' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'qty_price' => [
                'type'       => 'float',            
            ],
            'qty_sales_tax' => [
                'type'       => 'float',            
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
        $this->forge->createTable('OrderItems');
    }

    public function down()
    {
        $this->forge->dropTable('OrderItems');
    }
}