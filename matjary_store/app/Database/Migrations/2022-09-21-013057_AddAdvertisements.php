<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAdvertisements extends Migration
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
            'add_img' => [
                'type'       => 'TEXT',
                'constraint' => '255',
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'sub_title' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],            
            'add_position' => [
                'type'       => 'TINYINT',
                'constraint' => '5',
                'comment' => '1=top,2=middle,3=middle,4=left,5=right',
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
        $this->forge->createTable('Advertisements');
    }

    public function down()
    {
        $this->forge->dropTable('Advertisements');
    }
}