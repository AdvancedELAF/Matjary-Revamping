<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStates extends Migration
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
            'short_code' => [
                'type'       => 'TEXT',
                'constraint' => '500',
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],
            'country_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],            
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('States');
    }

    public function down()
    {
        $this->forge->dropTable('States');
    }
}