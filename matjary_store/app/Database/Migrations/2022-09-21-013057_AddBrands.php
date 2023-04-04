<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBrands extends Migration
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
            'brand_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'brand_image' => [
                'type'       => 'TEXT',
                'constraint' => '255',
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
        $this->forge->createTable('Brands');
    }

    public function down()
    {
        $this->forge->dropTable('Brands');
    }
}