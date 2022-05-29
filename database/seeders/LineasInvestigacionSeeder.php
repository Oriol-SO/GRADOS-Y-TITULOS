<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LineasInvestigacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('linea_de_investigaciones')->insert([
            //FACULTAD DE CIENCIAS DE LA SALUD
            ['id'=>1,'inveNombre'=>'Salud pública'],
            ['id'=>2,'inveNombre'=>'Epidemias'],
            ['id'=>3,'inveNombre'=>'Recursos medicinales'],

            //FACULTAD DE ODONTOLOGÍA
            ['id'=>4,'inveNombre'=>'Salud pública'],
            ['id'=>5,'inveNombre'=>'Epidemias'],
            ['id'=>6,'inveNombre'=>'Recursos medicinales'],
            
            //FACULTAD DE CIENCIAS AGROPECUARIAS
            ['id'=>7,'inveNombre'=>'Recursos'],
            ['id'=>8,'inveNombre'=>'Sanidad'],
            ['id'=>9,'inveNombre'=>'Procesos agrícolas'],
            //FACULTAD DE CIENCIAS AGROPECUARIAS-ZOOTECNIA
            ['id'=>10,'inveNombre'=>'Biotecnología'],
            ['id'=>11,'inveNombre'=>'Sanidad'],
            ['id'=>12,'inveNombre'=>'Reproducción animal'],
            //FACULTAD DE CIENCIAS AGROPECUARIAS-Profesional de Industrias Alimentarias
            ['id'=>13,'inveNombre'=>'Biotecnología'],
            ['id'=>14,'inveNombre'=>'Sanidad'],
            ['id'=>15,'inveNombre'=>'Reproducción animal'],
            
            //FACULTAD DE CIENCIAS ECONÓMICAS Y CONTABLES
            ['id'=>16,'inveNombre'=>'Desarrollo urbano'],
            ['id'=>17,'inveNombre'=>'Financiero'],
            ['id'=>18,'inveNombre'=>'Pobreza'],
            ['id'=>19,'inveNombre'=>'Productividad empresarial'],

            //FACULTAD DE CIENCIAS EMPRESARIALES
            ['id'=>20,'inveNombre'=>'Desarrollo urbano'],
            ['id'=>21,'inveNombre'=>'Financiero'],
            ['id'=>22,'inveNombre'=>'Pobreza'],
            ['id'=>23,'inveNombre'=>'Productividad empresarial'],

            //FACULTAD DE CIENCIAS DE LA EDUCACIÓN
            ['id'=>24,'inveNombre'=>'Educación'],
            ['id'=>25,'inveNombre'=>'Políticas'],
            ['id'=>26,'inveNombre'=>'Intercultural'],
            ['id'=>27,'inveNombre'=>'Ambiente'],

            //FACULTAD DE CIENCIAS DE LA COMUNICACIÓN
            ['id'=>28,'inveNombre'=>'Educación'],
            ['id'=>29,'inveNombre'=>'Políticas'],
            ['id'=>30,'inveNombre'=>'Intercultural'],
            ['id'=>31,'inveNombre'=>'Ambiente'],

            //FACULTAD DE DERECHO Y CIENCIAS POLÍTICAS
            ['id'=>32,'inveNombre'=>'Educación'],
            ['id'=>33,'inveNombre'=>'Políticas'],
            ['id'=>34,'inveNombre'=>'Intercultural'],
            ['id'=>35,'inveNombre'=>'Ambiente'],

            //FACULTAD DE INGENIERÍA
            ['id'=>36,'inveNombre'=>'Geotecnia'],
            ['id'=>37,'inveNombre'=>'Evaluación de riesgos'],
            ['id'=>38,'inveNombre'=>'Tratamiento de efluentes'],

            //FACULTAD DE INGENIERÍA DE MINAS   
            ['id'=>39,'inveNombre'=>'Geotecnia'],
            ['id'=>40,'inveNombre'=>'Evaluación de riesgos'],
            ['id'=>41,'inveNombre'=>'Tratamiento de efluentes'],

            //FACULTAD DE MEDICINA HUMANA  
            ['id'=>42,'inveNombre'=>'Salud pública'],
            ['id'=>43,'inveNombre'=>'Epidemias'],
            ['id'=>44,'inveNombre'=>'Recursos medicinales'],

            ]);
    }
}
