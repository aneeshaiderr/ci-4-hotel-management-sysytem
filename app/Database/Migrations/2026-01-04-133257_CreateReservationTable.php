<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReservationTable extends Migration
{
     public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],

            'hotel_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],

            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],

            'guest_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],

            'hotel_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],

            'room_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],

            'staff_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],

            'discount_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],

            'check_in' => [
                'type' => 'DATE',
            ],

            'check_out' => [
                'type' => 'DATE',
            ],

            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'cancelled', 'completed'],
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

            'deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);


        $this->forge->addKey('id', true);


        $this->forge->addKey('hotel_code');


        $this->forge->createTable('reservation', true);
    }

    public function down()
    {
        $this->forge->dropTable('reservation', true);
    }
}
