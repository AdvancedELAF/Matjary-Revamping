<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRefundRequest extends Migration
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
                'type' => 'INT',
                'constraint' => 11,          
            ],
            'order_id' => [
                'type' => 'INT',
                'constraint' => 11,               
            ],
            'refund_amount' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],            
            'refund_reason' => [
                'type'       => 'TEXT',
                'constraint' => '1000',
            ],
            'other_reason' => [
                'type'       => 'TEXT',
                'constraint' => '1000',
            ],
            'refund_status' => [
                'type' => 'INT',
                'constraint' => 11, 
                'comment' => '0=refund not approve yet,1=refund is approved,2=refund has been received by customer',              
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
        $this->forge->createTable('RefundRequest');
    }

    public function down()
    {
        $this->forge->dropTable('RefundRequest');
    }
}