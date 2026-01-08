<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRoomPricesTable extends Migration
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

            'hotel_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
            ],

            'room_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
            ],

            'rate' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],

            'start_date' => [
                'type' => 'DATE',
                'null' => true,
            ],

            'end_date' => [
                'type' => 'DATE',
                'null' => true,
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


        $this->forge->addKey('hotel_id');
        $this->forge->addKey('room_id');
        $this->forge->addKey('start_date');
        $this->forge->addKey('end_date');


        $this->forge->createTable('room_prices', true);
    }

    public function down()
    {
        $this->forge->dropTable('room_prices', true);
    }
}
