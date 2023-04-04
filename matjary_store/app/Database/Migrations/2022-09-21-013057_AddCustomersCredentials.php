<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCustomersCredentials extends Migration
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
            'customer_id' => [
                'type'       => 'INT',
                'constraint'     => 11,
            ],
            'password' => [
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
        $this->forge->createTable('CustomersCredentials');
    }

    public function down()
    {
        $this->forge->dropTable('CustomersCredentials');
    }
}