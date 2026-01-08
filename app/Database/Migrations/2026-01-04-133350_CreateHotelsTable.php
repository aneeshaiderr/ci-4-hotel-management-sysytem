<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHotelsTable extends Migration
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

            'hotel_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],

            'address' => [
                'type' => 'TEXT',
            ],

            'contact_no' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
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


        $this->forge->addKey('hotel_name');


        $this->forge->createTable('hotels', true);
    }

    public function down()
    {
        $this->forge->dropTable('hotels', true);
    }
}
