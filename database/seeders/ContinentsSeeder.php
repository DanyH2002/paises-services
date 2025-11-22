<?php

namespace Database\Seeders;

use App\Models\Continents;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContinentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $continent = [
            ['name' => 'América'],
            ['name' => 'África'],
            ['name' => 'Asia'],
            ['name' => 'Antártida'],
            ['name' => 'Europa'],
            ['name' => 'Oceanía']
        ];

        foreach ($continent as $continents) {
            Continents::create($continents);
        }
    }
}
