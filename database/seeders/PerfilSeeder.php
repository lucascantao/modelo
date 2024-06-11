<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Perfil;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Perfil::create([
            'nome' => 'usuario',
            'descricao' => 'Usuario comum'
        ]);
        Perfil::create([
            'nome' => 'admin',
            'descricao' => 'Administrador do setor'
        ]);
        Perfil::create([
            'nome' => 'master',
            'descricao' => 'Mestre do sistema'
        ]);
    }
}
