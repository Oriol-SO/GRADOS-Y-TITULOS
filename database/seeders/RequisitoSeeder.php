<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RequisitoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //Tipos 1:FUT 2:Voucher 3:Constancia o certificado 4:Copia 5:Documento original 6: fotografias 7:Resolución 8:DVD 9:Oficio 10:informe
         DB::table('requisitos')->insert([
            //INICIO PROCESOS GENERALES
                //inicio bachiller 1000
                    [
                        'id' => '1001',
                        'nombre' => 'FUT dirigido al Decano de facultad, solicitando ser declarado expedito.',
                        'tipoarchi_id' => '1',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,

                    ],
                    [
                        'id' => '1002',
                        'nombre' => 'FUT dirigido al Decano de facultad, solicitando optar el grado académico de Bachiller',
                        'tipoarchi_id' => '1' ,
                        'tipo_documento'=>'pdf' ,
                        'html_formato'=>null,        
                    ],
                    [
                        'id' => '1003',
                        'nombre' => 'Recibo de pago por derecho de expedito',
                        'tipoarchi_id' => '2' , 
                        'tipo_documento'=>'pdf' ,
                        'html_formato'=>null,       
                    ],
                    [
                        'id' => '1004',
                        'nombre' => 'Recibo de pago por derecho de bachiller',
                        'tipoarchi_id' => '2',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,          
                    ],
                    [
                        'id' => '1005',
                        'nombre' => 'Constancia de Estadística expedida por la oficina de Estadística',
                        'tipoarchi_id' => '3',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,          
                    ],
                    [
                        'id' => '1006',
                        'nombre' => 'Recibo de pago por derecho de caligrafiado ',
                        'tipoarchi_id' => '2' ,
                        'tipo_documento'=>'pdf' ,
                        'html_formato'=>null,        
                    ],
                    [
                        'id' => '1007',
                        'nombre' => 'Recibo de pago por derecho de certificación',
                        'tipoarchi_id' => '2' ,  
                        'tipo_documento'=>'pdf' ,
                        'html_formato'=>null,      
                    ],
                    [
                        'id' => '1008',
                        'nombre' => 'Constancia de no adeudar a la Undac',
                        'tipoarchi_id' => '3',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,          
                    ],
                    [
                        'id' => '1009',
                        'nombre' => 'Constancia de Egresado conteniendo el total de créditos aprobados, expedido por la Dirección de Escuela',
                        'tipoarchi_id' => '3',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,          
                    ],
                    [
                        'id' => '1010',
                        'nombre' => 'Constancia de Matricula, expedido por la oficina de Registros Académicos de la Facultad.',
                        'tipoarchi_id' => '3' ,
                        'tipo_documento'=>'pdf' ,
                        'html_formato'=>null,        
                    ],
                    [
                        'id' => '1011',
                        'nombre' => 'Constancia de ingreso',
                        'tipoarchi_id' => '3' ,
                        'tipo_documento'=>'pdf' ,
                        'html_formato'=>null,        
                    ],
                    [
                        'id' => '1012',
                        'nombre' => 'Certificado de estudios superiores original',
                        'tipoarchi_id' => '3' ,
                        'tipo_documento'=>'pdf' ,
                        'html_formato'=>null,        
                    ],
                    [
                        'id' => '1013',
                        'nombre' => 'En caso de convalidación adjuntar copia de la resolución respectivamente',
                        'tipoarchi_id' => '5' ,
                        'tipo_documento'=>'pdf' ,
                        'html_formato'=>null,        
                    ],
                    [
                        'id' => '1014',
                        'nombre' => 'Certificado de Programa de Extensión y Proyección Social, expedido por la oficina correspondiente',
                        'tipoarchi_id' => '3' ,
                        'tipo_documento'=>'pdf' ,
                        'html_formato'=>null,        
                    ],
                    [
                        'id' => '1015',
                        'nombre' => 'Certificado de conocimiento de un idioma extranjero: ingles o lengua nativa',
                        'tipoarchi_id' => '3',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,          
                    ],
                    [
                        'id' => '1016',
                        'nombre' => 'Certificado del dominio de computación e Informática en su especialidad por cada escuela.',
                        'tipoarchi_id' => '3' ,
                        'tipo_documento'=>'pdf' ,
                        'html_formato'=>null,        
                    ],
                    [
                        'id' => '1017',
                        'nombre' => 'Certificado de Practicas Pre Profesionales',
                        'tipoarchi_id' => '3',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,          
                    ],
                    [
                        'id' => '1018',
                        'nombre' => 'Copia fotostática legalizada y/o autentificada del certificado de practicas pre profesionales, por un periodo minimó de 85 días acompañado del informe aprobado por la comisión de practicas pre profesionales de cada escuela profesional',
                        'tipoarchi_id' => '4' , 
                        'tipo_documento'=>'pdf' ,
                        'html_formato'=>null,       
                    ],
                    [
                        'id' => '1019',
                        'nombre' => 'Copia fotostática ampliada y legalizada del Documento Nacional de Identidad (DNI) y estar vigente',
                        'tipoarchi_id' => '4' , 
                        'tipo_documento'=>'pdf' ,
                        'html_formato'=>null,       
                    ],
                    [
                        'id' => '1020',
                        'nombre' => 'Partida de nacimiento original actualizado',
                        'tipoarchi_id' => '5' , 
                        'tipo_documento'=>'pdf' ,
                        'html_formato'=>null,       
                    ],
                    [
                        'id' => '1021',
                        'nombre' => '04 fotografías a colores tamaño pasaporte en una mica tamaño fotocheck, fondo blanco, con terno oscuro camisa y/o blusa blanca.',
                        'tipoarchi_id' => '6' , 
                        'tipo_documento'=>'pdf' ,
                        'html_formato'=>null,       
                    ],
                    [
                        'id' => '1022',
                        'nombre' => 'Para el registro de Grado Académico de Bachiller, adjuntar un DVD regrabable , conteniendo lo siguiente:
                        Fotografía digital tamaño pasaporte, en archivo JPG (No escaneado),Grabado con código F026_NRO DNI_B. Dimenciones 274 X  354 pixeles.  Resolución  mínima de 300 dpi.
                        Constancia de Egresado, Grabado con código CE026_NRO DNI_B. Escaneado y guardado en PDF.
                        Constancia de Matrícula, Grabado con código CM026_NRO DNI_B. Escaneado y guardado en PDF. ',
                        'tipoarchi_id' => '8' ,
                        'tipo_documento'=>'pdf' ,
                        'html_formato'=>null,        
                    ],
                    [
                        'id' => '1023',
                        'nombre' => 'Resolución de expedito',
                        'tipoarchi_id' => '7' ,
                        'tipo_documento'=>'pdf' ,
                        'html_formato'=>null,        
                    ],
                    [
                        'id' => '1024',
                        'nombre' => 'Resolución de aprobación de consejo de facultad',
                        'tipoarchi_id' => '7' ,
                        'tipo_documento'=>'pdf' ,
                        'html_formato'=>null,        
                    ],
                    [
                        'id' => '1025',
                        'nombre' => 'Oficio de remisión de expediente  vicerrectorado',
                        'tipoarchi_id' => '9' , 
                        'tipo_documento'=>'pdf' ,
                        'html_formato'=>null,       
                    ],
                    [
                        'id' => '1026',
                        'nombre' => 'Informe de aprobación para secretaría general',
                        'tipoarchi_id' => '10',
                        'tipo_documento'=>'pdf' ,
                        'html_formato'=>null,         
                    ],
                //Fin Bachiller         
                  
                //inicio TITULO 4000
                    [
                        'id' => '4001',
                        'nombre' => 'Realizar un compromiso de declaración jurada por parte del usuario para culminar su procedimiento y no abandonar el proceso.',
                        'tipoarchi_id' => '1' , 
                        'tipo_documento'=>'pdf' ,
                        'html_formato'=>null,       
                    ],
                    [
                        'id' => '4002',
                        'nombre' => 'Solicitud dirigida al Decano de la facultad, para aprobación e inscripción del proyecto de investigación ',
                        'tipoarchi_id' => '1' ,
                        'tipo_documento'=>'pdf' ,
                        'html_formato'=>null,        
                    ],
                    [
                        'id' => '4003',
                        'nombre' => 'Ejemplar del proyecto de investigación',
                        'tipoarchi_id' => '5',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,          
                    ],
                    [
                        'id' => '4004',
                        'nombre' => 'Solicitud dirigida al decano de facultad para designación de asesor',
                        'tipoarchi_id' => '1' ,
                        'tipo_documento'=>'pdf' ,
                        'html_formato'=>null,        
                    ],
                    [
                        'id' => '4005',
                        'nombre' => 'Resolución de designación de asesor',
                        'tipoarchi_id' => '7',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4006',
                        'nombre' => 'Copia fotostática del informe aprobatorio sobre la revisión del proyecto de investigación del asesor sobre la originalidad',
                        'tipoarchi_id' => '9',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4007',
                        'nombre' => 'Copia fotostática del informe aprobatorio sobre la revisión del proyecto de investigación por el Director de la Unidad de investigación de la facultad sobre la originalidad',
                        'tipoarchi_id' => '4',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4008',
                        'nombre' => 'Resolución de aprobación e inscripción del proyecto de tesis',
                        'tipoarchi_id' => '7',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4009',
                        'nombre' => 'Solicitud dirigida al Decano de facultad, para aprobación del informe de investigación (borrador de tesis)',
                        'tipoarchi_id' => '1',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4010',
                        'nombre' => 'Copia fotostática del informe aprobatorio sobre la revisión del informe de investigación (borrador de tesis), del asesor',
                        'tipoarchi_id' => '4',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4011',
                        'nombre' => 'Solicitud dirigida al Decano de la facultad, para nombramiento de jurados',
                        'tipoarchi_id' => '1',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4012',
                        'nombre' => 'Resolución de nombramiento de jurados',
                        'tipoarchi_id' => '7',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4013',
                        'nombre' => 'Copia fotostática del informe aprobatorio sobre la revisión del informe de investigación (borrador de tesis) jurado 1',
                        'tipoarchi_id' => '9',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4014',
                        'nombre' => 'Copia fotostática del informe aprobatorio sobre la revisión del informe de investigación (borrador de tesis) jurado 2',
                        'tipoarchi_id' => '9',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4015',
                        'nombre' => 'Copia fotostática del informe aprobatorio sobre la revisión del informe de investigación (borrador de tesis) jurado 3',
                        'tipoarchi_id' => '9',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4016',
                        'nombre' => 'Solicitud dirigida al Decano de la facultad, para aprobación de la tesis',
                        'tipoarchi_id' => '1',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4017',
                        'nombre' => 'Resolución de aprobación de tesis emitido por el Decano',
                        'tipoarchi_id' => '7',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4018',
                        'nombre' => 'Cuatro (04) fotografías a colores tamaño pasaporte, fondo blanco, con terno de color oscuro, camisa blanca para caballeros y blusa blanca para damas',
                        'tipoarchi_id' => '6',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4019',
                        'nombre' => 'Copia fotostática ampliada y legalizada del Documento Nacional de Identidad.',
                        'tipoarchi_id' => '4',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4020',
                        'nombre' => 'Copia del Grado Académico de Bachiller, certificada por Secretaría General de la UNDAC',
                        'tipoarchi_id' => '4',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4021',
                        'nombre' => 'Constancia de matrícula del primer semestre, indicando el día, mes y año de matrícula, el número de créditos matriculados, acorde a la Ley N° 30220, expedido por la Unidad de Registros Académicos por la Facultad correspondiente,',
                        'tipoarchi_id' => '3',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4022',
                        'nombre' => 'Constancia de egresado, indicando el día, mes y año de egreso, el número de créditos concluidos y el año del plan curricular desarrollado, acorde a la Ley N° 30220, expedido por la Dirección de Escuela de Formación Profesional correspondiente,',
                        'tipoarchi_id' => '3',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4023',
                        'nombre' => 'Constancia de No Adeudar a la UNDAC; expedido por la oficina de tesorería y contabilidad, código 027.',
                        'tipoarchi_id' => '3',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4024',
                        'nombre' => 'Recibo de pago por derecho de expedito',
                        'tipoarchi_id' => '2',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4025',
                        'nombre' => 'Recibo de pago por derecho de título profesional',
                        'tipoarchi_id' => '2',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4026',
                        'nombre' => 'Recibo de pago por derecho de certificación',
                        'tipoarchi_id' => '2',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4027',
                        'nombre' => 'Recibo de pago por derecho de diploma',
                        'tipoarchi_id' => '2',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4028',
                        'nombre' => 'Solicitud dirigida al decano de facultad para ser declarado expedito para sustentación de tesis',
                        'tipoarchi_id' => '1',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4029',
                        'nombre' => 'Presentar un folder tamaño oficio o colgante, forrado del color de la facultad correspondiente al grado que se solicita',
                        'tipoarchi_id' => '11', 
                        'tipo_documento'=>'pdf' ,
                        'html_formato'=>null,        
                    ],
                    [
                        'id' => '4030',
                        'nombre' => 'Resolución de expedito para sustentación de la tesis',
                        'tipoarchi_id' => '7',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4031',
                        'nombre' => 'Solicitud dirigida al decano de facultad señalando fecha y hora de sustentación',
                        'tipoarchi_id' => '1',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4032',
                        'nombre' => 'Resolución de fecha y hora de sustentación',
                        'tipoarchi_id' => '7',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4033',
                        'nombre' => 'Copia fotostática del acta de sustentación de la tesis, certificada por el secretario docente de la facultad correspondiente',
                        'tipoarchi_id' => '4',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4034',
                        'nombre' => 'Formato de autorización para la publicación de la tesis en el repositorio institucional donde debe indicar la url',
                        'tipoarchi_id' => '5',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4035',
                        'nombre' => 'DVD regrabable conteniendo lo siguiente </br> -Constancia de egresado, grabado con código CE026_NRO DNI_T.pdf<br>-Constancia de matrícula grabado con código CM026_NRO DNI_T.pdf<br>-Fotografia digital con dimensiones 274x354px con resolución mínima de 300dpi grabado con código F026_NRO DNI_T.jpg <br>-Diploma del grado académico de bachiller escaneado anverso y reverso, grabado con código D026_NRO DNI_B.pdf<br>-Tesis con código T026_NRO DNI_T.pdf editable',
                        'tipoarchi_id' => '8',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4036',
                        'nombre' => 'Para el repositorio institucional de la UNDAC, adjuntar un DVD regrabable y remitirlos adjuntos al correo repositorio@undac.edu.pe, conteniendo lo siguiente: <br>-Tesis con código T026_NRO DNI_T.pdf editable<br>-Copia del acta de sustentación en formato pdf<br>-Resolución de fecha y hora de sustentación en formato pdf editable',
                        'tipoarchi_id' => '8',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4037',
                        'nombre' => 'Solicitud dirigida al decano de la facultad, para aprobación del título profesional, por consejo de facultad',
                        'tipoarchi_id' => '1',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4038',
                        'nombre' => 'Resolución de aprobación del titulo profesional por consejo de facultad',
                        'tipoarchi_id' => '7',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4039',
                        'nombre' => 'Oficio para vicerrectorado',
                        'tipoarchi_id' => '9',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,
                    ],
                    [
                        'id' => '4040',
                        'nombre' => 'Informe de aprobación para secretaría general',
                        'tipoarchi_id' => '10', 
                        'tipo_documento'=>'pdf' ,
                        'html_formato'=>null,        
                    ],
                //Fin TITULO
            //FIN PROCESOS GEENRALES
            //INICIO PROCESOS SEGUNDARIOS
                //inicio Constancia de primera matricula 5100
                    [
                        'id' => '5101',
                        'nombre' => 'FUT dirigido al jefe de registros academicos de facultad, solicitando constancia de primera matricula.',
                        'tipoarchi_id' => '1',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,          
                    ],
                    [
                        'id' => '5102',
                        'nombre' => 'Recibo de pago a la cuenta NN s/ NN',
                        'tipoarchi_id' => '2',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,          
                    ],
                    [
                        'id' => '5103',
                        'nombre' => 'Constancia de primera matricula',
                        'tipoarchi_id' => '3' ,
                        'tipo_documento'=>'pdf' ,
                        'html_formato'=>null,        
                    ],
                //Fin de Constancia de primera matricula
                //inicio Certificado de Estudios 5200
                    [
                        'id' => '5201',
                        'nombre' => 'FUT dirigido al jefe de registros academicos de facultad, solicitando Certificado de Estudios',
                        'tipoarchi_id' => '1',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,          
                    ],
                    [
                        'id' => '5202',
                        'nombre' => 'Recibo de pago a la cuenta 017 s/ 80.00',
                        'tipoarchi_id' => '2' ,
                        'tipo_documento'=>'pdf' ,
                        'html_formato'=>null,        
                    ],
                    [
                        'id' => '5203',
                        'nombre' => 'Constancia de no adeudar a la Biblioteca',
                        'tipoarchi_id' => '3',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,          
                    ],
                    [
                        'id' => '5204',
                        'nombre' => 'Resolucion de convalidación',
                        'tipoarchi_id' => '5',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,          
                    ],
                    [
                        'id' => '5205',
                        'nombre' => 'Record de Notas',
                        'tipoarchi_id' => '5' ,
                        'tipo_documento'=>'pdf' ,
                        'html_formato'=>null,        
                    ],
                    [
                        'id' => '5206',
                        'nombre' => 'Fotografia Digital Con terno, en fondo Blanco y sin anteojos Dimensiones: 240 x 288 Formato: JPG',
                        'tipoarchi_id' => '6',
                        'tipo_documento'=>'pdf',
                        'html_formato'=>null,          
                    ],
                    [
                        'id' => '5207',
                        'nombre' => 'Certificado de Estudios',
                        'tipoarchi_id' => '3' ,
                        'tipo_documento'=>'pdf' ,
                        'html_formato'=>null,        
                    ],
                //Fin de Certificado de Estudios
            //FIN PROCESOS SEGUNDARIOS
                           
                ]);
    }
}
