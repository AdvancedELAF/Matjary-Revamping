<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProducts extends Migration
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
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'short_desc' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'long_desc' => [
                'type'       => 'TEXT',
                'constraint' => '500',
            ],
            'image' => [
                'type'       => 'TEXT',
                'constraint' => '500',
            ],
            'retail_price' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'wholesale_price' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'discount_per' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'sales_tax' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'stock_quantity' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'order_limit_quantity' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'threshold_quantity' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'feature' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'category_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'brand_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'color_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'size_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'weight' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
            ],
            'keywords' => [
                'type'       => 'TEXT',
                'constraint' => '500',
            ],
            'tags' => [
                'type'       => 'TEXT',
                'constraint' => '500',
            ],
            'promotion_status' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'author_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'views' => [
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
        $this->forge->createTable('Products');
    }

    public function down()
    {
        $this->forge->dropTable('Products');
    }
}