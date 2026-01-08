<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;
class ServicesSeeder extends Seeder
{
 public function run()
    {
        $faker = Factory::create();

        $services = ['Breakfast', 'Airport Pickup', 'Spa', 'Gym', 'Laundry'];

        $data = [];
        foreach ($services as $service) {
            $data[] = [
                'service_name' => $service,
                'status'       => $faker->randomElement(['active', 'inactive']),
                'price'        => $faker->randomFloat(2, 500, 5000),
                'created_at'   => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                'updated_at'   => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
            ];
        }

        $this->db->table('services')->insertBatch($data);
    }
}
