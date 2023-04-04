<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCustomers extends Migration
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
                'constraint' => '1000',
            ],
            'contact_no' => [
                'type'       => 'VARCHAR',
                'constraint'     => '25',
            ],
            'profile_image' => [
                'type'       => 'TEXT',
                'constraint' => '1000',
            ],
            'address' => [
                'type'       => 'TEXT',
                'constraint' => '1000',
            ],
            'country_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'state_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'city_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'zipcode' => [
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
        $this->forge->createTable('Customers');
    }

    public function down()
    {
        $this->forge->dropTable('Customers');
    }
}