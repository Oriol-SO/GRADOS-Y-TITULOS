<?php

namespace App\Http\Controllers\Formatos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GenerarDocumentoController extends Controller
{
    public $pdf = null;
    public function __construct($formato = 'FUT', $request = null, $datosBd = null)
    {

        switch ($formato) {
            case 'FUT':
                $pdf = new FutController();
                $pdf->construir($request, $datosBd);
                $this->pdf = $pdf;
                break;
            case 'Resolución':
                $pdf = new Resolucion();
                $pdf->construir($datosBd, $request);
                $this->pdf = $pdf;
                break;
            case 'Oficio':
                $pdf = new OficioController();
                $pdf->construir($datosBd, $request);
                $this->pdf = $pdf;
                break;
                // case 'Informe':
                //         $pdf = new VicInformeController();
                //         $pdf->construir();
                //         $this->pdf = $pdf;
                //         break;    
            case 'Informe':
                $pdf = new EscInformeController();
                $pdf->construir();
                $this->pdf = $pdf;
                break;
            case 'Oficio':
                $pdf = new DeclaracionJController();
                $pdf->construir();
                $this->pdf = $pdf;
                break;
            case 'Especial1':
                //return 'fsafa';
                $pdf = new Especial1Controller();
                $pdf->construir();
                $this->pdf = $pdf;
                break;
            default:
                $pdf = new BlanckController();
                $pdf->construir();
                $this->pdf = $pdf;
                break;
        }
    }
}
