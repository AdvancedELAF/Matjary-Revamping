<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFaqs extends Migration
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
            'question' => [
                'type'       => 'TEXT',
                'constraint' => '1000',
            ],
            'answear' => [
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
        $this->forge->createTable('Faqs');
    }

    public function down()
    {
        $this->forge->dropTable('Faqs');
    }
}