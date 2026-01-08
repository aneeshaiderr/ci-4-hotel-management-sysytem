<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserInfoTable extends Migration
{
    public function up()
    {
        // Make sure 'users' table exists first!
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [  // Foreign key to users table
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true, // MUST match users.id
                'null'       => false,
            ],

            'first_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'last_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'contact_no' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],

            'status' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1, // Active = 1, Inactive = 0
            ],

            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        // Primary key
        $this->forge->addKey('id', true);
        // Index for foreign key
        $this->forge->addKey('user_id');
        // Foreign key constraint
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');

        // Create table
        $this->forge->createTable('user_info', true);
    }

    public function down()
    {
        $this->forge->dropTable('user_info', true);
    }
}
