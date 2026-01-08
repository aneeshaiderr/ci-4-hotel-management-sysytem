<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRoomsTable extends Migration
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

            'room_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],

            'floor' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],

            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['available', 'occupied', 'maintenance'],
                'default'    => 'available',
                'null'       => true,
            ],

            'beds' => [
                'type'       => 'TINYINT',
                'constraint' => 3,
                'unsigned'   => true,
            ],

            'max_guests' => [
                'type'       => 'TINYINT',
                'constraint' => 3,
                'unsigned'   => true,
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
        $this->forge->addKey('room_number');


        $this->forge->createTable('rooms', true);
    }

    public function down()
    {
        $this->forge->dropTable('rooms', true);
    }
}
