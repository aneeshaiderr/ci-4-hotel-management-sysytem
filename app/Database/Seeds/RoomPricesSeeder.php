<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;
class RoomPricesSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        $rooms = $this->db->table('rooms')->select('id, hotel_id')->get()->getResult();

        $data = [];
        foreach ($rooms as $room) {
            $data[] = [
                'hotel_id'   => $room->hotel_id,
                'room_id'    => $room->id,
                'rate'       => $faker->randomFloat(2, 2000, 20000),
                'start_date' => $faker->dateTimeBetween('-1 month', '+1 month')->format('Y-m-d'),
                'end_date'   => $faker->dateTimeBetween('+1 month', '+12 months')->format('Y-m-d'),
                'created_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                'updated_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
            ];
        }

        $this->db->table('room_prices')->insertBatch($data);
    }
}
