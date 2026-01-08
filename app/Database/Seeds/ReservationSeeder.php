<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ReservationSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();


        $rooms = $this->db->table('rooms')->select('id, hotel_id')->get()->getResult();
        $discounts = $this->db->table('discount')->select('id')->get()->getResult();

        if (empty($rooms) || empty($discounts)) {
            echo "Rooms or Discounts table is empty. Seed them first.\n";
            return;
        }

        $data = [];

        for ($i = 0; $i < 20; $i++) {

            $room = $faker->randomElement($rooms);
            $discount = $faker->randomElement($discounts);

            $check_in = $faker->dateTimeBetween('now', '+3 months');
            if (!$check_in) {
                $check_in = new \DateTime();
            }

            $days = $faker->numberBetween(1, 5);
            $check_out = clone $check_in;
            $check_out->modify("+$days days");


            $deleted_at = $faker->optional()->dateTimeThisYear();
            if ($deleted_at) {
                $deleted_at = $deleted_at->format('Y-m-d H:i:s');
            } else {
                $deleted_at = null;
            }

            $data[] = [
                'hotel_code'  => 'HPK' . $faker->unique()->numberBetween(100, 999),
                'user_id'     => $faker->numberBetween(1, 5),
                'guest_id'    => $faker->numberBetween(1, 20),
                'hotel_id'    => $room->hotel_id,
                'room_id'     => $room->id,
                'staff_id'    => $faker->optional()->numberBetween(1, 5),
                'discount_id' => $discount->id,
                'check_in'    => $check_in->format('Y-m-d'),
                'check_out'   => $check_out->format('Y-m-d'),
                'status'      => $faker->randomElement(['active', 'cancelled', 'completed']),
                'created_at'  => (new \DateTime())->format('Y-m-d H:i:s'),
                'updated_at'  => (new \DateTime())->format('Y-m-d H:i:s'),
                'deleted_at'  => $deleted_at,
            ];
        }

        $this->db->table('reservation')->insertBatch($data);
        echo "ReservationSeeder executed successfully.\n";
    }
}
