<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGiftCards extends Migration
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
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'image' => [
                'type'       => 'TEXT',
                'constraint' => '1000',
            ],
            'short_desc' => [
                'type'       => 'TEXT',
                'constraint' => '1000',
            ],
            'long_desc' => [
                'type'       => 'TEXT',
                'constraint' => '1000',
            ],
            'start_date' => [
                'type'           => 'DATE',
                'null' => true,
            ],
            'expiry_date' => [
                'type'           => 'DATE',
                'null' => true,
            ],
            'is_active' => [
                'type' => 'INT',
                'constraint' => 5,
                'comment' => '1=active,2=deactive,3=deleted',
            ],
            'created_by' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'updated_by' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
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
        $this->forge->createTable('GiftCards');
    }

    public function down()
    {
        $this->forge->dropTable('GiftCards');
    }
}