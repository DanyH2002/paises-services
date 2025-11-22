<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $currency = [
            ['name' => 'Euro'],
            ['name' => 'Dólar (USD)'],
            ['name' => 'Real Brasileño'],
            ['name' => 'Rublo Ruso'],
            ['name' => 'Libra Esterlina'],
            ['name' => 'Franco Suizo'],
            ['name' => 'Yen Japonés'],
            ['name' => 'Yuan Chino'],
            ['name' => 'Dólar Hongkonés'],
            ['name' => 'Dólar Canadiense'],
            ['name' => 'Dólar Australiano'],
            ['name' => 'Peso Mexicano'],
            ['name' => 'Rupia Indonesia'],
            ['name' => 'Rial Iraní'],
            ['name' => 'Lira Turca'],
            ['name' => 'Lira Egipcia'],
            ['name' => 'Corona Checa'],
            ['name' => 'Corona Sueca'],
            ['name' => 'Corona Danesa'],
            ['name' => 'Rupia India'],
            ['name' => 'Rand'],
            ['name' => 'Peso Colombiano'],
            ['name' => 'Peso Filipino'],
            ['name' => 'Quetzal Gatemalteco'],
            ['name' => 'Forint'],
            ['name' => 'Tenge Kazajo'],
            ['name' => 'Chelin kKeniano'],
            ['name' => 'Otro']
        ];

        foreach ($currency as $currency) {
            Currency::create($currency);
        }
    }
}
