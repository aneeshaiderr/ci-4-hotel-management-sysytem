<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;
class DiscountsSeeder extends Seeder
{
   public function run()
    {
        $faker = Factory::create();

        $data = [];
        for ($i=1; $i <= 5; $i++) {
            $data[] = [
                 'discount_type' => $faker->randomElement(['percentage', 'amount']),
                'discount_name' => $faker->words(2, true),
                'value'      => $faker->randomFloat(2, 5, 50),
                'start_date' => $faker->dateTimeBetween('-1 month', '+1 month')->format('Y-m-d'),
                'end_date'   => $faker->dateTimeBetween('+1 month', '+12 months')->format('Y-m-d'),
                'status'     => $faker->randomElement(['active', 'inactive']),
                'created_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                'updated_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
            ];
        }

        $this->db->table('discounts')->insertBatch($data);
    }
}
