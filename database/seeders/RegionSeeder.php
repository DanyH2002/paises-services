<?php

namespace Database\Seeders;

use App\Models\regions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $regions = [
            ['name' => 'America', 'code' => 'AME', 'description' => 'Norteamérica, Sudamérica, América Central, el Caribe'],
            ['name' => 'Asia-Pacífico', 'code' => 'APAC', 'description' => 'Asia Central y Meridional, Noreste Asiático, Sudeste Asiático, Australia y Oceanía'],
            ['name' => 'Europa', 'code' => 'EUR', 'description' => 'Europa del Norte, Europa del Sur, Europa del Este, Europa Occidental'],
            ['name' => 'Oriente Medio/África', 'code' => 'MEA', 'description' => 'Oriente Medio, Norte de África, Sur de África']
        ];

        foreach ($regions as $region) {
            regions::create($region);
        }
    }
}
