<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCountries extends Migration
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
            'sortname' => [
                'type'       => 'VARCHAR',
                'constraint' => '3',
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'phonecode' => [
                'type' => 'INT',
                'constraint' => 11,
            ],            
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('Countries');
    }

    public function down()
    {
        $this->forge->dropTable('Countries');
    }
}