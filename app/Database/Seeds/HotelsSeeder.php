<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;
class HotelsSeeder extends Seeder
{
  public function run()
    {
        $faker = Factory::create();

        $data = [];
        for ($i=1; $i <= 5; $i++) {
            $data[] = [
                'hotel_name' => $faker->company,
                'address'    => $faker->address,
                'contact_no' => $faker->phoneNumber,
                'created_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                'updated_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
            ];
        }

        $this->db->table('hotels')->insertBatch($data);
    }
}
