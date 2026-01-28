<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,       
            CategorySeeder::class,
            LokasiSeeder::class,
            EventSeeder::class,
            TicketSeeder::class,
            PaymentTypeSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
