<?php

namespace Database\Seeders;

use App\Models\Proceso;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RolSeeder::class,
            PersonaSeeder::class,
            UserSeeder::class,
            Modalidad_seeder::class,
            Grados_seeder::class,
            Proceso_seeder::class,
            DenominacionSeeder::class,
            PersonaRolSeeder::class,
            FaseSeeder::class,
            TipoSeeder::class,
            RequisitoSeeder::class,
            FaseRolRequisitoSeeder::class,
            BachillerIni::class,
            BachillerFinal::class,
            EstadoSeeder::class,
            LineasInvestigacionSeeder::class,
        ]);
    }
}
