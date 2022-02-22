<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id' => 1,
                'rolNombre' => 'Rector',
                'rolDep' => null,
                'rolMod' => false,
                'rol_id'=>1,

            ],
            [
                'id' => 2,
                'rolNombre' => 'Vicerrector',
                'rolDep' => null,
                'rolMod' => false,
                'rol_id'=>2,
            ],
            [
                'id' => 11,
                'rolNombre' => 'Secretaria Vicerrectorado',
                'rolDep' => null,
                'rolMod' => true,
                'rol_id'=>11,
            ],
            [
                'id' => 3,
                'rolNombre' => 'Secretaria general uno',
                'rolDep' => null,
                'rolMod' => true,
                'rol_id'=>3,
            ],
            [
                'id' => 12,
                'rolNombre' => 'Secretaria general dos',
                'rolDep' => null,
                'rolMod' => true,
                'rol_id'=>12,
            ],
            [
                'id' => 4,
                'rolNombre' => 'Decano',
                'rolDep' => null,
                'rolMod' => false,
                'rol_id'=>4,
            ],
            [
                'id' => 5,
                'rolNombre' => 'Secretaria de facultad',
                'rolDep' => null,
                'rolMod' => true,
                'rol_id'=>5,
            ],
            [
                'id' => 6,
                'rolNombre' => 'Director de escuela',
                'rolDep' => null,
                'rolMod' => false,
                'rol_id'=>6,
            ],
            [
                'id' => 7,
                'rolNombre' => 'Secretaria de escuela',
                'rolDep' => null,
                'rolMod' => false,
                'rol_id'=>7,
            ],
            [
                'id' => 8,
                'rolNombre' => 'Jurado',
                'rolDep' => null,
                'rolMod' => true,
                'rol_id'=>8,
            ],
            [
                'id' => 9,
                'rolNombre' => 'Asesor',
                'rolDep' => null,
                'rolMod' => true,
                'rol_id'=>9,
            ],
            [
                'id' => 10,
                'rolNombre' => 'Alumno',
                'rolDep' => null,
                'rolMod' => true,
                'rol_id'=>10,
            ], 
            [
                'id' => 13,
                'rolNombre' => 'Administrador',
                'rolDep' => null,
                'rolMod' => true,
                'rol_id'=>13,
            ],
            [
                'id' => 14,
                'rolNombre' => 'Jefe de Registros Academicos',
                'rolDep' => null,
                'rolMod' => true,
                'rol_id'=>14,
            ],
        ]);
    }
}
