<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddWishListProducts extends Migration
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
            'product_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],          
            'created_at' => [
                'type'           => 'DATETIME',
                'null' => true,
            ],
            
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('WishListProducts');
    }

    public function down()
    {
        $this->forge->dropTable('WishListProducts');
    }
}