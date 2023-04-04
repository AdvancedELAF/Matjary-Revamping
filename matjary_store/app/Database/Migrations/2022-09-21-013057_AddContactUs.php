<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddContactUs extends Migration
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
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'email' => [
                'type'       => 'TEXT',
                'constraint' => '100',
            ],  
            'contact_no' => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
            ], 
            'massage' => [
                'type'       => 'TEXT',
                'constraint' => '100',
            ],      
            'admin_reply' => [
                'type'       => 'TEXT',
                'constraint' => '100',
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
        $this->forge->createTable('ContactUs');
    }

    public function down()
    {
        $this->forge->dropTable('ContactUs');
    }
}