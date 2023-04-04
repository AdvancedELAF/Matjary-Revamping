<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBanners extends Migration
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
            'sub_title' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'image' => [
                'type'       => 'TEXT',
                'constraint' => '255',
            ],
            'banner_url' => [
                'type'       => 'TEXT',
                'constraint' => '1000',
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
        $this->forge->createTable('Banners');
    }

    public function down()
    {
        $this->forge->dropTable('Banners');
    }
}