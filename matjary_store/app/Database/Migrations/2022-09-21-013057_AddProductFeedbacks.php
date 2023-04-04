<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProductFeedbacks extends Migration
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
            'product_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'category_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'customer_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'feedback' => [
                'type'       => 'TEXT',
                'constraint' => '1000',
            ],
            'ratting' => [
                'type'       => 'INT',
                'constraint' => 11,
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
        $this->forge->createTable('ProductFeedbacks');
    }

    public function down()
    {
        $this->forge->dropTable('ProductFeedbacks');
    }
}