<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user001 = User::create([
            'name' => 'José Lucas dos Santos Cantão',
            'username' => 'jose.cantao',
            'email' => 'cantao162@gmail.com',
            'perfil_id' => 3,
            'setor_id' => 32
        ]);
        $user002 = User::create([
            'name' => 'Bruno Gomes Haick',
            'username' => 'bruno.haick',
            'email' => 'brunohaick@gmail.com',
            'perfil_id' => 3,
            'setor_id' => 32
        ]);
        $user003 = User::create([
            'name' => 'Demys Alves Brito',
            'username' => 'demys.brito',
            'email' => 'demysbrito@gmail.com',
            'perfil_id' => 3,
            'setor_id' => 32
        ]);
    }
}
