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
            'id' => '1',
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'persona_id'=>1
        ],
        [
            'id' => '2',
            'name' => 'secrevicerectorado',
            'email' => 'secVicRec@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'persona_id' => '13'
        ],
        //secretarias generales
        [
            'id' => '3',
            'name' => 'secretaria ge',
            'email' => 'secGenUno@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'persona_id' => '2'
        ], [
            'id' => '4',
            'name' => 'secre ge 2',
            'email' => 'secGenDos@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'persona_id' => '14'
        ],
    );
    }
}
