<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;
class RoomsSeeder extends Seeder
{
  public function run()
    {
        $faker = Factory::create();

        $hotels = $this->db->table('hotels')->select('id')->get()->getResult();

        $data = [];
        foreach ($hotels as $hotel) {
            for ($i=1; $i<=10; $i++) {
                $data[] = [
                    'hotel_id'    => $hotel->id,
                    'room_number' => $faker->numberBetween(100, 500),
                    'floor'       => $faker->numberBetween(1, 5),
                    'status'      => $faker->randomElement(['available', 'occupied', 'maintenance']),
                    'beds'        => $faker->numberBetween(1, 3),
                    'max_guests'  => $faker->numberBetween(1, 5),
                    'created_at'  => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                ];
            }
        }

        $this->db->table('rooms')->insertBatch($data);
    }
}
