<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCities extends Migration
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
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'state_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],           
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('Cities');
    }

    public function down()
    {
        $this->forge->dropTable('Cities');
    }
}