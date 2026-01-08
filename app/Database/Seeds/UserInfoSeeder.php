<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class UserInfoSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        $data = [];

        // Generate 10 user_info records
        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'user_id'    => $i, // Make sure these user_ids exist in 'users' table
                'first_name' => $faker->firstName(),
                'last_name'  => $faker->lastName(),
                'email'      => $faker->unique()->safeEmail(),
                'password'   => password_hash('password123', PASSWORD_BCRYPT),
                'contact_no' => $faker->phoneNumber(),
                'status'     => $faker->randomElement([0, 1]),
                'created_at' => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
                'updated_at' => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
                'deleted_at' => null,
            ];
        }

        $this->db->table('user_info')->insertBatch($data);
    }
}
