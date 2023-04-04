<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNotifications extends Migration
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
            'type_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'comment' => 'notification type id',
            ],
            'is_seen' => [
                'type' => 'INT',
                'constraint' => 11,
                'comment' => '0=not seen,1=seen	',
            ],            
            'reff_link' => [
                'type'       => 'TEXT',
                'constraint' => '1000',
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
        $this->forge->createTable('Notifications');
    }

    public function down()
    {
        $this->forge->dropTable('Notifications');
    }
}