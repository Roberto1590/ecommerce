<?php

namespace Database\Seeders;

use App\Models\Pesos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PesosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pesos::factory()->create([
            'sigla'     => 'kg',
            'peso'    => 'Quilograma',
        ]);
        Pesos::factory()->create([
            'sigla'     => 'hg',
            'peso'    => 'Hectograma ',
        ]);
        Pesos::factory()->create([
            'sigla'     => 'dag',
            'peso'    => 'Decagrama',
        ]);
        Pesos::factory()->create([
            'sigla'     => 'g',
            'peso'    => 'Grama',
        ]);
        Pesos::factory()->create([
            'sigla'     => 'dg',
            'peso'    => 'Decigrama',
        ]);
        Pesos::factory()->create([
            'sigla'     => 'cg',
            'peso'    => 'Centigrama',
        ]);
        Pesos::factory()->create([
            'sigla'     => 'mg',
            'peso'    => 'Miligrama',
        ]);
    }
}
