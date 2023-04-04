<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGiftCardPurchased extends Migration
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
            'gc_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'egift_code' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'gc_amount' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'gc_balance' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'gc_status' => [
                'type'       => 'INT',
                'constraint' => 11,
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
        $this->forge->createTable('GiftCardPurchased');
    }

    public function down()
    {
        $this->forge->dropTable('GiftCardPurchased');
    }
}