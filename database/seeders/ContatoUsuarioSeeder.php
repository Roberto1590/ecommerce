<?php

namespace Database\Seeders;

use App\Models\Contato;
use App\Models\ContatoUsuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContatoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContatoUsuario::factory()->create([
            'user_id' => 1,
            'cpf' => '44377811231',
            'telefone_comercial' => '11945221512',
            'telefone_celular' => '11945251512',
            'sexo'     => 1
        ]);
    }
}
