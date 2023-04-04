<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAboutUs extends Migration
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
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'short_description' => [
                'type'       => 'TEXT',
                'constraint' => '1000',
            ],
            'long_description' => [
                'type'       => 'TEXT',
                'constraint' => '1000',
            ],
            'image' => [
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
        $this->forge->createTable('AboutUs');
    }

    public function down()
    {
        $this->forge->dropTable('AboutUs');
    }
}