<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddOrders extends Migration
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
                'constraint' => 11,
            ],
            'shipping_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'pickup_req_ref_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'pickup_req_gu_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'pickup_req_flag' => [
                'type'       => 'TINYINT',
                'constraint' => 5,
            ],
            'is_coupon_applied' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'coupon_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'coupon_amount' => [
                'type'       => 'float',
            ],
            'is_giftcard_purchased' => [
                'type'       => 'TINYINT',
                'constraint' => 5,
                'comment' => '0=pickup request has not raised yet,1=already pickup request has raised',
            ],
            'is_giftcard_applied' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'giftcard_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'giftcard_prchsed_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'giftcard_amount' => [
                'type'       => 'float',
            ],
            'total_price' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'customer_address_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'ship_cmp_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'payment_type' => [
                'type'       => 'INT',
                'constraint' => 11,
                'comment' => '1=COD,2=online banking,3=giftcard',
            ],
            'transaction_id' => [
                'type'       => 'TEXT',
                'constraint' => '1000',
            ],
            'pg_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'comment' => 'payment gateway id',
            ],
            'pg_req' => [
                'type'       => 'TEXT',
                'constraint' => '1000',
            ],
            'pg_res' => [
                'type'       => 'TEXT',
                'constraint' => '1000',
            ],
            'shipping_req' => [
                'type'       => 'TEXT',
                'constraint' => '1000',
            ],
            'shipping_res' => [
                'type'       => 'TEXT',
                'constraint' => '1000',
            ],
            'pickup_req' => [
                'type'       => 'TEXT',
                'constraint' => '1000',
            ],
            'pickup_res' => [
                'type'       => 'TEXT',
                'constraint' => '1000',
            ],
            'refund_req' => [
                'type'       => 'TEXT',
                'constraint' => '500',
            ],
            'refund_res' => [
                'type'       => 'TEXT',
                'constraint' => '500',
            ],
            'payment_status' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'order_status' => [
                'type'       => 'INT',
                'constraint' => 11,
                'comment' => '1=complete,2=pending,3=cancel',
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
        $this->forge->createTable('Orders');
    }

    public function down()
    {
        $this->forge->dropTable('Orders');
    }
}