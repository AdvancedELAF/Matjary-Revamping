<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSetting extends Migration
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
            'logo' => [
                'type'       => 'TEXT',
                'constraint' => '255',
            ],
            'favicon' => [
                'type'       => 'TEXT',
                'constraint' => '255',
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'site_email' => [
                'type'       => 'TEXT',
                'constraint' => '255',
            ],
            'address' => [
                'type'       => 'TEXT',
                'constraint' => '255',
            ],
            'contact_no' => [
                'type'       => 'VARCHAR',
                'constraint' =>'25',
            ],
            'short_desc' => [
                'type'       => 'TEXT',
                'constraint' => '255',
            ],
            'long_desc' => [
                'type'       => 'TEXT',
                'constraint' => '500',
            ],
            'smtp_host' => [
                'type'       => 'TEXT',
                'constraint' => '255',
            ],
            'smtp_username' => [
                'type'       => 'TEXT',
                'constraint' => '255',
            ],
            'smtp_password' => [
                'type'       => 'TEXT',
                'constraint' => '255',
            ],
            'smtp_port' => [
                'type'       => 'TEXT',
                'constraint' => '255',
            ],
            'smtp_from' => [
                'type'       => 'TEXT',
                'constraint' => '255',
            ],
            'administraitor_email' => [
                'type'       => 'TEXT',
                'constraint' => '255',
            ],
            'support_email' => [
                'type'       => 'TEXT',
                'constraint' => '255',
            ],
            'social_fb_link' => [
                'type'       => 'TEXT',
                'constraint' => '500',
            ],
            'social_twitter_link' => [
                'type'       => 'TEXT',
                'constraint' => '500',
            ],
            'social_youtube_link' => [
                'type'       => 'TEXT',
                'constraint' => '500',
            ],
            'social_linkedin_link' => [
                'type'       => 'TEXT',
                'constraint' => '500',
            ],
            'social_instagram_link' => [
                'type'       => 'TEXT',
                'constraint' => '500',
            ],
            'customer_help' => [
                'type'       => 'TEXT',               
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
        $this->forge->createTable('Setting');
    }

    public function down()
    {
        $this->forge->dropTable('Setting');
    }
}