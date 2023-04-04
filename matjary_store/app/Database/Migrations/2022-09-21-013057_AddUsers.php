<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUsers extends Migration
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
            'addr_residential' => [
                'type'       => 'TEXT',
                'constraint' => '255',
            ],
            'addr_permanent' => [
                'type'       => 'TEXT',
                'constraint' => '255',
            ],            
            'date_of_birth' => [
                'type'           => 'DATETIME',
                'null' => true,
            ],            
            'gender' => [
                'type'           => 'INT',
                'constraint' => 5,
                'comment' => '1=male,2=female',
            ],
            'profile_image' => [
                'type'       => 'TEXT',
                'constraint' => '1000',
            ],
            'country_id' => [
                'type'       => 'INT',
                'constraint' => 5,
            ],
            'state_id' => [
                'type'       => 'INT',
                'constraint' => 5,
            ],
            'city_id' => [
                'type'       => 'INT',
                'constraint' => 5,
            ],
            'zipcode' => [
                'type'       => 'INT',
                'constraint' => 5,
            ],
            'contact_no' => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
            ],
            'social_fb_link' => [
                'type'       => 'TEXT',
                'constraint' => '255',
            ],
            'social_twitter_link' => [
                'type'       => 'TEXT',
                'constraint' => '255',
            ],
            'social_linkedin_link' => [
                'type'       => 'TEXT',
                'constraint' => '255',
            ],            
            'social_skype_link' => [
                'type'       => 'TEXT',
                'constraint' => '255',
            ],
            'role_id' => [
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
        $this->forge->createTable('Users');
    }

    public function down()
    {
        $this->forge->dropTable('Users');
    }
}