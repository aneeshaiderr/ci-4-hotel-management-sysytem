<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDiscountTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'type' => [
                'type'       => 'ENUM',
                'constraint' => ['percentage', 'amount'],
            ],

            'value' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],

            'start_date' => [
                'type' => 'DATE',
            ],

            'end_date' => [
                'type' => 'DATE',
            ],

            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'inactive'],
                'default'    => 'active',
                'null'       => true,
            ],

            'created_at' => [
            'type' => 'DATETIME',
            'null' => false,
            ],

            'updated_at' => [
            'type' => 'DATETIME',
            'null' => false,
            ],
        ]);


        $this->forge->addKey('id', true);


        $this->forge->createTable('discount', true);
    }

    public function down()
    {
        $this->forge->dropTable('discount', true);
    }
}
