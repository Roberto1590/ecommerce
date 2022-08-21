<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RotasSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ContatoUsuarioSeeder::class);
        $this->call(MedidasSeeder::class);
        $this->call(PesosSeeder::class);
    }
}
