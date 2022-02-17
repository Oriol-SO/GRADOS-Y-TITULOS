 <?php
 
 Schema::create('personas', function (Blueprint $table) {
      $table->id();
      $table->string('nom');
      $table->string('apePat');
      $table->string('apeMat');
      $table->boolean('gen');
      $table->string('dom');
      $table->string('email');
      $table->integer('tipDoc');
      $table->string('numDoc');
      $table->date('fecNac');
      $table->string('numcel',9);
      $table->string('grad_esud');
      $table->string('abre_grad');
      $table->string('cod_alum',10)->nullable();
      $table->string('curri')->nullable();
      $table->string('espe')->nullable();
      $table->date('fec_matri')->nullable();
      $table->date('fec_egre')->nullable();
      $table->string('proced')->nullable();
      $table->timestamps();
        });

     Schema::create('users', function (Blueprint $table) {
          $table->id('id_user');
          $table->string('name');
          $table->string('email')->unique();
          $table->timestamp('email_verified_at')->nullable();
          $table->string('password')->nullable();
          $table->usignedBigInteger('id_persona')->usigned();
          $table->rememberToken();      
          $table->foreign('id_persona')->references('id')->on('personas');
          $table->timestamps();
      });

      Schema::create('roles', function (Blueprint $table) {
        $table->id();
        $table->string('rolNombre');
        $table->integer('rolDep')->nullable();
        $table->boolean('rolMod');
        $table->timestamps();
    });



      Schema::create('persona_roles', function (Blueprint $table) {
        $table->id();
        $table->date('fecIni');
        $table->date('fecFin')->nullable();
        $table->boolean('estado');
        $table->BigInteger('perId')->unsigned(); 
        $table->string('facId'); //se obtendra de la api
        $table->string('escId');//se obtendra de la api
        $table->BigInteger('rolId')->unsigned();
       
       
        $table->foreign('perId')->references('id')->on('personas');
        $table->foreign('rolId')->references('id')->on('roles');
        $table->timestamps();
    });


    Schema::create('modalidades', function (Blueprint $table) {
      $table->id('modId');
      $table->string('modNombre');
      $table->string('modAbre');
      $table->timestamps();
  });

  Schema::create('grados', function (Blueprint $table) {
    $table->id('graId');
    $table->string('graNom');
    $table->string('graAbr');
    $table->string('nivel');
    $table->timestamps();
});

Schema::create('procesos', function (Blueprint $table) {
  $table->id('procId');
  $table->string('procNom');
  $table->BigInteger('gradoId')->unsigned();
  $table->BigInteger('modaId')->unsigned();
  $table->string('tipo');

  $table->foreign('gradoId')->references('id')->on('grados');
  $table->foreign('modaId')->references('id')->on('modalidades');

  $table->timestamps();
});



denominacion
public function up()
    {
        Schema::create('denominacion', function (Blueprint $table) {
$table->id();
$table->string('nombre');
$table->string('especialidad_id');
$table->string('grado_id');
$table->foreign('grado_id')->references('id')->on('grado');
        });
    }

table fase
public function up()
    {
        Schema::create('fase', function (Blueprint $table) {
$table->id();
$table->string('nombre');
$table->integer('numero');
$table->string('llave');
$table->string('proceso_id');
$table->foreign('proceso_id')->references('id')->on('proceso');
});
    }


table fase_rol_requisitos
public function up()
    {
        Schema::create('fase_rol_requisitos', function (Blueprint $table) {
$table->id();
$table->string('rol_id');
$table->string('requisito_id');
$table->string('fase_id');
$table->boolean('tiene_plantilla');
$table->foreign('rol_id')->references('id')->on('rol');
$table->foreign('requisito_id')->references('id')->on('requisito');
$table->foreign('llave')->references('id')->on('fase');
});
}

table requisito
public function up()
    {
        Schema::create('requisito', function (Blueprint $table) {
$table->id();
$table->string('nombre');
$table->string('tipo_archivo_id');
 $table->string('html_formato:text')->nullable();
$table->string('tipo_archivo_id');
$table->string('diploma_id');
$table->foreign('tipo_archivo_id')->references('id')->on('tipo_archivo');
$table->foreign('diploma_id')->references('id')->on('diploma');
});
}

table tipo_archivo
public function up()
    {
        Schema::create('tipo_archivo', function (Blueprint $table) {
$table->id();
$table->string('nombre');
});
}
table linea_investigacion
public function up()
    {
        Schema::create('linea_investigacion', function (Blueprint $table) {
$table->id();
$table->string('nombre');
});
}





////////
OBSERVACIONES:    
public function up()
    {
        Schema::create('observaciones', function (Blueprint $table) {
            $table->id(obserId);
            $table->foreign('file_Id')->references('filId')->on('files');
            $table->text('texto');
            $table->foreign('persona_rol_id')->references('personarol_id')->on('files');            
            $table->timestamps();
        });
    }
 
       FILES
public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id('filId');
            $table->foreign('tramite_trald')->references('tramId')->on('tramites');
            $table->string('path');
            $table->foreign('personarol_id')->references('perId')->on('personas'); 
            $table->foreign('faseRolRequisito_id')->references('reqId')->on('face_rol_requisitos');
            $table->timestamp('');
        });
     }


ESTADO
public function up()
    {
        Schema::create('estados', function (Blueprint $table) {
            $table->id('estaId');
            $table->string('nombre');
            $table->timestamps();
        });
    }

TRABAJOS
public function up()
    {
        Schema::create('trabajos', function (Blueprint $table) {
            $table->id('trabId');
            $table->string('modo_sustentacion'); 
            $table->string('url_repositorio');
            $table->date('fecha_sustentacion')->nullable();
            $table->text('nombre');
           $table->foreign('linea_investigacion_id')->references('linInvId')->on('linea_investigacion');
            $table->timestamps();
        });
        
    }

TRAMITES	
public function up()
    {
        Schema::create('tramites', function (Blueprint $table) {
            $table->id('tramId');
            $table->date('fec-inicio');
            $table->date('fec-fin')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->string('modo_obtencion')->nullable();
            $table->set('tipo_tramite',[1,2]);
            $table->int('fase_actual');
            $table->boolean('estado');

            $table->foreign('trabajos_id')->references('trabId')->on('trabajos');
            $table->foreign('persona_id')->references('perId')->on('personas');
            $table->foreign('proceso_id')->references('proId')->on('proceso');
            $table->foreign('consejo_id')->nullable()->references('consId')->on('consejo');
            $table->foreign('resolucion_id')->nullable()->references('resolId')->on('resolucion');
            $table->timestamps();
        });
    }
fin1

RESOLUCION
public function up()
    {
        Schema::create('resoluciones', function (Blueprint $table) {
            $table->id('resolId');
            $table->date('fecha');
            $table->string('numero');
            $table->string('estado');
            $table->timestamps();
        });
    }


CONSEJO
public function up()
    {
        Schema::create('consejos', function (Blueprint $table) {
            $table->id('consId');
            $table->string('numero')->nullable();
            $table->date('fecha');
            $table->boolean('estado');          
            $table->string('num_oficio');
            $table->timestamps();
        });
    }


DIPLOMA
public function up()
    {
            Schema::create('diploma', function (Blueprint $table) {
                $table->id('dipId');
                $table->foreign('tramite_id')->references('tramId')->on('tramites');
                $table->string('num_lib');
                $table->string('num_lib_regis');
                $table->integer('lib_foli');
                $table->string('num_sticker');
                $table->date('fec_hor_entre')->nullable();
                $table->string('num_info_vice');
                $table->timestamps();
        });

REVISION
public function up()
    {
            Schema::create('revision', function (Blueprint $table) {
                $table->id('revId');
                $table->foreign('file_id')->references('fileId')->on('files');
                $table->foreign('per_rol_id')->references('perRolId')->on('personaRoles');
                $table->boolean('estado');
                $table->foreign('estado_id')->references('estaId')->on('estado');
                $table->timestamps();
        });
    }

LINEA_INVESTIGACION_ESCUELA
public function up()
    {
            Schema::create('linea_investigacion_escuela', function (Blueprint $table) {
                $table->id('inveScuId');
                $table->string('escuela_id');
                $table->foreign('lin_invs_id')->references('linInvId')->on('linea_investigacion');
                $table->timestamps();
        });
    }

INVOLUCRADOS
public function up()
    {
            Schema::create('involucrados', function (Blueprint $table) {
                $table->id('involId');
                $table->foreign('trabajo_id')->references('trabId')->on('trabajos');
                $table->foreign('rol')->references('perRolId')->on('personaRoles');
                $table->foreign('pers_rol_id')->references('perRolId')->on('personaRoles');
                $table->boolean('estado');
                $table->timestamps();
        });
    }