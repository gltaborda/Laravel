<?php

namespace Database\Seeders;
use App\Models\Instrument;
use Illuminate\Database\Seeder;

class InstrumentSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        
        Instrument::factory(20)->create();
        // \App\Models\User::factory(10)->create();
    }
}