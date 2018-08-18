<?php

use Illuminate\Database\Seeder;
use App\Models\Transaksi;

class DummyDataSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 20)->create();
    }
}
