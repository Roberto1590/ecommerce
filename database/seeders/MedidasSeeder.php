<?php

namespace Database\Seeders;

use App\Models\Medidas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedidasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Medidas::factory()->create([
            'sigla'     => 'km',
            'medida'    => 'Quilômetro',
        ]);
        Medidas::factory()->create([
            'sigla'     => 'hm',
            'medida'    => 'Hectômetro',
        ]);
        Medidas::factory()->create([
            'sigla'     => 'dam',
            'medida'    => 'decâmetro',
        ]);
        Medidas::factory()->create([
            'sigla'     => 'm',
            'medida'    => 'Metro',
        ]);
        Medidas::factory()->create([
            'sigla'     => 'dm',
            'medida'    => 'Decímetro',
        ]);
        Medidas::factory()->create([
            'sigla'     => 'cm',
            'medida'    => 'Centímetro',
        ]);
    }
}
