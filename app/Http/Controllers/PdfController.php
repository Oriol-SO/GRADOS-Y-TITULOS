<?php

namespace App\Http\Controllers;

use FPDF;
use Illuminate\Http\Request;

class PdfController extends FPDF
{
    function Header()
    {           
        $this->SetFont('Times','B',12);
        $this->SetX(70);
        $this->MultiCell(120,5,utf8_decode('UNIVERSIDAD NACIONAL DANIEL ALCIDES CARRIÓN Decanato de la Facultad de Ingeniería'),0,'C');
        $this->SetFont('Times','',11);
        $this->SetX(70);
        $this->Cell(120,5, utf8_decode('Area de Grados y Títulos'),0,0,'C');
        $this->Image('img/undac.png',18,-2,35,27);
        $this->write(5, utf8_decode('----------------------------------------------------------------------------------------------------------------------------'));
        
    }
    function footer()
    {   
        $this->SetY(-30);
        $this->SetFont('Arial','',7.5);
        $this->SetX(8);
        $this->Write(4,'C.c');
        $this->Ln();
        $this->SetX(8);
        $this->Write(4,'Original Expediente');
        $this->Ln();
        $this->SetX(8);
        $this->Write(4,'Asesor');
        $this->Ln();
        $this->SetX(8);
        $this->Write(4,'Egresado');
        $this->Ln();
        $this->SetX(8);
        $this->Write(4,'Archivo');

        
    }
    function construir()
    {
        //Aqui todos los componentes del documento
        $this->SetMargins(25,5,20,0);
        $this->AliasNbPages();
        $this->AddPage();

        $this->SetFont('Times','UB',13);
        // $numero='103-2020';
        $this->Ln(10);
        $this->Cell(175, 10, utf8_decode('AQUI IRA LA LISTA DE EXPEDIENTES -ALUMNOS AGENDADOS'), 0, 0, 'C');
        $this->Ln(15);
        $this->SetFont('Times', '', 11);
        $this->MultiCell(170, 5, utf8_decode('Yo,'),0);
        $this->SetFont('Arial', '', 7);
        $this->SetXY(31,46);        
        $this->Cell(150, 5, '...........................................................................................................................................................................................................................,', 0, 0);
        //fecha
        $this->SetFont('Times', '', 11);
        // $mes=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        // $this->Cell(173,5,'Cerro de Pasco, '.gmdate("d", time() + 3600 * (-5 + date("I"))).' de '.$mes[gmdate('n',time() + 3600 * (-5 + date("I")))-1].' del '.gmdate('Y',time() + 3600 * (-5 + date("I"))),0,1,'R');
        $this->Ln();
        $this->Cell(20, 5, utf8_decode('con DNI N°'),0,0,'L');
        $this->SetFont('Arial', '', 7);
        $this->Cell(20,5,'..................',0,0,'L');
        $this->Ln();
        $this->SetFont('Times','B', 12);
        $this->write(10, utf8_decode('VISTO:'));
        $this->Ln();
        $this->Ln(15);
        $this->SetFont('Times','B', 13);
        $this->Cell(175,5, utf8_decode('REGÍSTRESE, COMUNÍQUESE Y ARCHÍVESE.'),0, 0, 'C');  
    }
}
