<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPasswordResets extends Migration
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
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'user_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'token' => [
                'type'       => 'TEXT',
                'constraint' => '255',
            ],
            'reset_flag' => [
                'type' => 'INT',
                'constraint' => 5,
                'comment' => '0=password reset request not raised or expired , 1=password request raised.',
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
        $this->forge->createTable('PasswordResets');
    }

    public function down()
    {
        $this->forge->dropTable('PasswordResets');
    }
}