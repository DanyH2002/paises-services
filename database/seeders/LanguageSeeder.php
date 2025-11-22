<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $language = [
            ['name' => 'Español'],
            ['name' => 'Inglés'],
            ['name' => 'Alemán'],
            ['name' => 'Italiano'],
            ['name' => 'Francés'],
            ['name' => 'Chino'],
            ['name' => 'Japonés'],
            ['name' => 'Árabe'],
            ['name' => 'Portugués'],
            ['name' => 'Ruso'],
            ['name' => 'Hindi / Urdu'],
            ['name' => 'Indonesio'],
            ['name' => 'Sueco'],
            ['name' => 'Bengalí'],
            ['name' => 'Coreano'],
            ['name' => 'Turco']
        ];

        foreach ($language as $language) {
            Language::create($language);
        }
    }
}
