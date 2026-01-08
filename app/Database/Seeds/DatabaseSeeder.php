<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('HotelsSeeder');
        $this->call('RoomsSeeder');
        $this->call('RoomPricesSeeder');
        $this->call('ServicesSeeder');
        $this->call('DiscountsSeeder');
        $this->call('ReservationSeeder');
    }
}
