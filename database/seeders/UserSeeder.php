<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        [
            'id' => '1',
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'persona_id'=>1
        ],
        [
            'id' => '2',
            'name' => 'Secretaria',
            'email' => 'secretarias@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'persona_id' => '2'
        ],
    ]);
    }
}
