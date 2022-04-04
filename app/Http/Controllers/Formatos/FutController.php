<?php

namespace App\Http\Controllers\Formatos;

use App\Http\Controllers\Controller;
use App\Http\Middleware\TrustProxie;
use FPDF;
use Illuminate\Http\Request;
//Cell(ancho,alto,texto,bordes,salto para el otro parrafo,alineación,rellenado,link)
//write(alto,texto,link)
//Output(destino[I,D,F,S], nombre de archivo,utf8)
//Image(ruta, posicion x, posicion y, alto, ancho, tipo, link)
//SetMargins(1er, 2do, 3ro,4to)
use phpDocumentor\Reflection\PseudoTypes\True_;
//Cell(ancho,alto,texto,bordes,salto para el otro parrafo,alineación,rellenado,link)
//write(alto,texto,link)
//Output(destino[I,D,F,S], nombre de archivo,utf8)
//Image(ruta, posicion x, posicion y, alto, ancho, tipo, link)
//SetMargins(1er, 2do, 3ro,4to)

// $fpdf=new FPDF();
// $fpdf->AddPage('PORTRAIT','letter');
// $fpdf->SetMargins(20,20,20,30);
class FutController extends FPDF
{

    function Header()
    {
        $this->SetXY(0, 0);
        $this->Image('img/logo_undac.png', 30, 10, 15);
        $this->SetFont('Times', 'B', 13);
        $this->Cell(210, 10, '', 0, 2);
        $this->Cell(45);
        $this->Cell(135, 7, utf8_decode('UNIVERSIDAD NACIONAL DANIEL ALCIDES CARRIÓN'), 0, 2, 'C');
        $this->SetFont('Arial', '', 14);
        $this->Cell(135, 7, utf8_decode('FORMULARIO ÚNICO DE TRÁMITE'), 0, 2, 'C');
        $this->Ln(5);
        $this->Line(30, $this->GetY(), 180, $this->GetY());
        $this->Ln(5);
    }
    function construir($r, $b)
    {
        $this->SetMargins(20, 10, 20, 0);
        $this->AliasNbPages();
        $this->AddPage();
        $this->SetFont('Arial', 'B', 12);
        $this->SetXY(0, 0);
        $this->Image('img/LOGO10a.png', 23, 70, 170);
        $this->SetXY(125, 34);
        // Stylesheet
        $this->SetStyle("p", "Arial", "N", 11, "0,0,0", 10);
        $this->SetStyle("vb", "Arial", "B", 0, "0,0,0");

        if ($b['reqId'] == '4001') {

            $this->SetFont('Times', 'UB', 17);
            $this->SetXY(20, 45);
            $this->Cell(170, 5, 'DECLARACION JURADA', 0, 0, 'C');
            $p = explode("X0X", $b['texto'][0]['conDes']);
            $txt = "<p>" . (isset($p[0]) ? $p[0] : "") . "<vb>" . $b['apeNomUsu'] . "</vb>" . (isset($p[1]) ? $p[1] : "") . $r['nacionalidad'] . (isset($p[2]) ? $p[2] : "") . "<vb>" . $b['dni'] . "</vb>" . (isset($p[3]) ? $p[3] : "") . "<vb>" . $b['domicilio'] . "</vb>.</p>";
            $this->SetXY(30, 60);
            $this->WriteTag(150, 5, utf8_decode($txt), 0, "J", 0, 0);
            $this->SetFont('Times', 'B', 12);
            $this->SetXY(30, 80);
            $this->Cell(160, 5, 'DECLARO BAJO JURAMENTO:', 0, 0, 'L');
            $p1 = explode("X0X", $b['texto'][1]['conDes']);
            $txt1 = "<p>" . (isset($p1[0]) ? $p1[0] : "") . "</p>" .
                "<p>" . $r[$b['texto'][2]['parNom']] . "</p>
                     <p>" . (isset($p1[1]) ? $p1[1] : "") . "</p>";
            $this->SetXY(30, 90);
            $this->WriteTag(150, 5, utf8_decode($txt1), 0, "J", 0, 0);
            $p2 = explode("X0X", $b['texto'][3]['conDes']);
            $mes = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
            $txt2 = "<p>" . (isset($p2[0]) ? $p2[0] : "") . "<vb>" . gmdate('d') . "</vb>" . (isset($p2[1]) ? $p2[1] : "") . "<vb>" . $mes[date('n') - 1] . "</vb>" . (isset($p2[2]) ? $p2[2] : "") . "<vb>" . gmdate('Y') . "</vb>.</p>";
            $this->SetXY(30, 130);
            $this->WriteTag(150, 5, utf8_decode($txt2), 0, "J", 0, 0);
            $this->SetXY(30, 170);
            $this->SetFont('Times', 'B', 10);
            $this->MultiCell(170, 1, utf8_decode('_________________________________'), 0, 'C');
            $this->SetXY(30, 172);
            $this->MultiCell(170, 5, utf8_decode('FIRMA'), 0, 'C');
            $this->SetXY(30, 177);
            $this->SetFont('Arial', '', 9);
            $this->MultiCell(170, 4, utf8_decode($b['apeNomUsu']), 0, 'C');
            $this->SetXY(30, 181);
            $this->MultiCell(170, 4, utf8_decode('DNI:' . $b['dni']), 0, 'C');
        } else {


            $this->SetFont('Arial', 'B', 10);
            $this->MultiCell(55, 5, utf8_decode('SOLICITO:   ' . $b['texto'][0]['conDes']), 0); //$req->docCam1

            $this->SetFont('Arial', '', 8);
            $this->SetXY(145, 35);
            $this->Cell(35, 5, '..........................................', 0, 2);
            $this->SetXY(125, 40);
            $this->Cell(55, 5, '....................................................................', 0, 2);
            $this->SetXY(125, 45);
            $this->Cell(55, 5, '....................................................................', 0, 2);

            $this->SetFont('Arial', 'B', 7);
            $this->SetXY(120, 50);
            $this->Cell(60, 3, '1.     SUMILLA', 0, 2);

            $this->SetXY(30, 55);

            $this->Cell(0, 3, '', 0, 2);
            $this->SetFont('Times', '', 12);
            $this->Cell(150, 4, utf8_decode('DECANO DE LA FACULTAD DE ' . $b['facultad']), 0, 2); //$req->docCam2
            $this->SetFont('Arial', '', 7);
            $this->Cell(150, 0, '.........................................................................................................................................................................................................................', 0, 2);
            $this->SetFont('Arial', 'B', 7);
            $this->Cell(150, 5, '2.     DESTINATARIO', 0, 2);

            $this->Cell(0, 3, '', 0, 2);
            $this->SetFont('Times', '', 12);
            $this->Cell(150, 4, utf8_decode($b['apeNomUsu']), 0, 2); //$alum->name
            $this->SetFont('Arial', '', 7);
            $this->Cell(150, 0, '.........................................................................................................................................................................................................................', 0, 2);
            $this->SetFont('Arial', 'B', 7);
            $this->Cell(150, 5, '3.     DATOS DEL USUARIO(APELLIDOS Y NOMBRES)', 0, 2);

            $this->Cell(0, 3, '', 0, 2);
            $this->SetFont('Times', '', 12);
            $this->Cell(150, 4, utf8_decode($r[$b['texto'][0]['parNom']]), 0, 2);
            $this->SetFont('Arial', '', 7);
            $this->Cell(150, 0, '.........................................................................................................................................................................................................................', 0, 2);
            $this->SetFont('Arial', 'B', 7);
            $this->Cell(150, 5, '4.     CARGO ACTUAL Y/O CENTRO DE TRABAJO)', 0, 2);

            $this->Cell(0, 3, '', 0, 2);
            $this->SetFont('Times', '', 12);
            $this->Cell(75, 4, utf8_decode($b['dni']), 0, 0); //$alum->dni
            $this->Cell(75, 4, utf8_decode($b['codMat']), 0, 1); //$alum->code

            $this->SetFont('Arial', '', 7);
            $this->Cell(10);
            $this->Cell(150, 0, '.........................................................................................................................................................................................................................', 0, 2);
            $this->SetFont('Arial', 'B', 7);
            $this->Cell(75, 5, '5.     D.N.I.', 0, 0);
            $this->Cell(75, 5, utf8_decode('6.     CÓDIGO DE MATRíCULA'), 0, 1);

            $this->Cell(10);
            $this->Cell(0, 3, '', 0, 2);
            $this->SetFont('Times', '', 12);
            $this->Cell(75, 4, utf8_decode($b['numCel']), 0, 0); //$alum->phone
            $this->Cell(75, 4, utf8_decode($b['email']), 0, 1); //$alum->email
            $this->SetFont('Arial', '', 7);
            $this->Cell(10);
            $this->Cell(150, 0, '.........................................................................................................................................................................................................................', 0, 2);
            $this->SetFont('Arial', 'B', 7);
            $this->Cell(75, 5, utf8_decode('7.     N° CELULAR/TELF.'), 0, 0);
            $this->Cell(75, 5, utf8_decode('8.     CORREO ELECTRÓNICO'), 0, 1);

            $this->Cell(10);
            $this->Cell(0, 3, '', 0, 2);
            $this->SetFont('Times', '', 12);
            $this->Cell(40, 4, utf8_decode($b['facultad']), 0, 0);
            $this->Cell(70, 4, utf8_decode($b['escuela']), 0, 0, 'C'); //$alum->escuela
            $this->Cell(40, 4, utf8_decode($b['especialidad']), 0, 1);
            $this->SetFont('Arial', '', 7);
            $this->Cell(10);
            $this->Cell(150, 0, '.........................................................................................................................................................................................................................', 0, 2);
            $this->SetFont('Arial', 'B', 7);
            $this->Cell(40, 5, utf8_decode('9.     FACULTAD'), 0, 0);
            $this->Cell(70, 5, utf8_decode('ESCUELA PROFESIONAL'), 0, 0, 'C');
            $this->Cell(40, 5, utf8_decode('ESPECIALIDAD'), 0, 1);

            $this->Cell(10);
            $this->Cell(0, 3, '', 0, 2);
            $this->SetFont('Times', '', 12);
            $this->Cell(150, 4, utf8_decode($b['domicilio']), 0, 2); //$alum->dir
            $this->SetFont('Arial', '', 7);
            $this->Cell(150, 0, '.........................................................................................................................................................................................................................', 0, 2);
            $this->SetFont('Arial', 'B', 7);
            $this->Cell(150, 5, utf8_decode('10.     DOMICILIO DEL USUARIO (Calle, Distrito, Provincia Y Región)'), 0, 2);

            $this->Cell(0, 7, '', 0, 2);
            $this->SetFont('Arial', 'B', 7);
            $this->Cell(150, 5, utf8_decode('11.     FUNDAMENTACIÓN DEL PEDIDO'), 0, 2);
            $this->SetFont('Times', '', 12);

            // // Stylesheet
            // $this->SetStyle("p", "Arial", "N", 11, "0,0,0", 10);
            // $this->SetStyle("vb", "Times", "B", 0, "0,0,0");
            switch ($b['reqId']) {
                case '1001':
                    $this->cuerpoUno($r, $b);
                    break;
                case '1002':
                    $this->cuerpoDos($r, $b);
                    break;
                case '4002':
                    $this->FutAproPI($r, $b);
                    break;
                case '4004':
                    $this->FutDesigAsesor($r, $b);
                    break;
                case '4009':
                    $this->FutAproBorradorProInv($r, $b);
                    break;
                case '4011':
                    $this->FutDesigJurados($r, $b);
                    break;
                case '4016':
                    $this->FutAproProyTesis($r, $b);
                    break;
                case '4028':
                    $this->FutDeclaExpeT($r, $b);
                    break;
                case '4031':
                    $this->FutFechaHoraT($r, $b);
                    break;
                case '4037':
                    $this->FutAproTituloCF($r, $b);
                    break;
                default:
                    $this->Cell(0, 3, 'No Contemplado ', 0, 2);
                    break;
            }

            $this->Ln();

            $this->SetFont('Arial', 'B', 7);
            $this->Cell(10);
            $this->Cell(0, 3, '', 0, 2);
            $this->Cell(75, 5, '12.     ANEXO.', 0, 0);
            $this->Cell(17, 5, utf8_decode('13.     FECHA: '), 0, 0);
            $this->SetFont('Times', '', 12);
            $this->Cell(58, 3, utf8_decode(date('d/m/Y')), 0, 2);
            $this->SetFont('Arial', '', 7);
            $this->Cell(58, 0, utf8_decode('...................................................................................'), 0, 1);

            $this->Ln(4);
            $this->Cell(10);

            $anexos = explode(";", $r[$b['texto'][3]['parNom']]);

            $txt = "";
            foreach ($anexos as $anexo) {
                $txt = $txt . "<p>" . $anexo . "</p>";
            }

            $auxY = $this->GetY();
            $this->WriteTag(70, 5, utf8_decode($txt), 0, "J", 0, 0);

            $this->SetFont('Arial', 'B', 7);
            $this->SetXY(105, $auxY);
            $this->Cell(17, 5, utf8_decode('14.     FIRMA: '), 0, 0);
            $this->SetFont('Times', '', 12);
            $this->Cell(58, 3, utf8_decode(''), 0, 2);
            $this->SetFont('Arial', '', 7);
            $this->Cell(58, 0, utf8_decode('...................................................................................'), 0, 1);
        }
    }
    public function cuerpoUno($r, $b)
    {
        $porciones = explode("X0X", $b['texto'][1]['conDes']);
        $txt = "<p>" . $porciones[0] . "<vb>" . $b['denominacionGrado'] . "</vb>" . $porciones[1] . "</p>" .
            "<p>" . $r[$b['texto'][1]['parNom']] . "
        </p>
        <p>" . $b['texto'][2]['conDes'] . "
        </p>";
        $this->WriteTag(150, 5, utf8_decode($txt), 0, "J", 0, 0);
    }
    public function cuerpoDos($r, $b)
    {
        $porciones = explode("X0X", $b['texto'][1]['conDes']);
        $txt = "<p>" . $porciones[0] . "<vb>" . $b['denominacionGrado'] . "</vb>" . $porciones[1] . "</p>" .
            "<p>" . $r[$b['texto'][1]['parNom']] . "</p>
        <p>" . $b['texto'][2]['conDes'] . "
        </p>";
        $this->WriteTag(150, 5, utf8_decode($txt), 0, "J", 0, 0);
    }
    public function FutAproPI($r, $b)
    {
        $porciones = explode("X0X", $b['texto'][1]['conDes']);
        $txt = "<p>" . $porciones[0] . "<vb>" . $b['nombreTrabajo'] . "</vb>" . $porciones[1] . "</p>" .
            "<p>" . $r[$b['texto'][1]['parNom']] . "</p>
        <p>" . $b['texto'][2]['conDes'] . "
        </p>";
        $this->WriteTag(150, 5, utf8_decode($txt), 0, "J", 0, 0);
    }
    public function FutDesigAsesor($r, $b)
    {
        $porciones = explode("X0X", $b['texto'][1]['conDes']);
        $txt = "<p>" . $porciones[0] . "<vb>" . $b['nombreTrabajo'] . "</vb>" . $porciones[1] . "</p>" .
            "<p>" . $r[$b['texto'][1]['parNom']] . "</p>
        <p>" . $b['texto'][2]['conDes'] . "
        </p>";
        $this->WriteTag(150, 5, utf8_decode($txt), 0, "J", 0, 0);
    }
    public function FutAproBorradorProInv($r, $b)
    {
        $porciones = explode("X0X", $b['texto'][1]['conDes']);
        $txt = "<p>" . $porciones[0] . "<vb>" . $b['nombreTrabajo'] . "</vb>" . $porciones[1] . "</p>" .
            "<p>" . $r[$b['texto'][1]['parNom']] . "</p>
        <p>" . $b['texto'][2]['conDes'] . "
        </p>";
        $this->WriteTag(150, 5, utf8_decode($txt), 0, "J", 0, 0);
    }
    public function FutDesigJurados($r, $b)
    {
        $porciones = explode("X0X", $b['texto'][1]['conDes']);
        $txt = "<p>" . $porciones[0] . "<vb>" . $b['nombreTrabajo'] . "</vb>" . $porciones[1] . "</p>" .
            "<p>" . $r[$b['texto'][1]['parNom']] . "</p>
        <p>" . $b['texto'][2]['conDes'] . "
        </p>";
        $this->WriteTag(150, 5, utf8_decode($txt), 0, "J", 0, 0);
    }
    public function FutAproProyTesis($r, $b)
    {
        $porciones = explode("X0X", $b['texto'][1]['conDes']);
        $txt = "<p>" . $porciones[0] . "<vb>" . $b['nombreTrabajo'] . "</vb>" . $porciones[1] . "</p>" .
            "<p>" . $r[$b['texto'][1]['parNom']] . "</p>
        <p>" . $b['texto'][2]['conDes'] . "
        </p>";
        $this->WriteTag(150, 5, utf8_decode($txt), 0, "J", 0, 0);
    }
    public function FutDeclaExpeT($r, $b)
    {
        $porciones = explode("X0X", $b['texto'][1]['conDes']);
        $txt = "<p>" . $porciones[0] . "<vb>" . $b['denominacionGrado'] . "</vb>" . $porciones[1] . "</p>" .
            "<p>" . $r[$b['texto'][1]['parNom']] . "</p>
        <p>" . $b['texto'][2]['conDes'] . "
        </p>";
        $this->WriteTag(150, 5, utf8_decode($txt), 0, "J", 0, 0);
    }
    public function FutFechaHoraT($r, $b)
    {
        $porciones = explode("X0X", $b['texto'][1]['conDes']);
        $txt = "<p>" . $porciones[0] . "<vb>" . $b['nombreTrabajo'] . "</vb>" . $porciones[1] . "</p>" .
            "<p>" . $r[$b['texto'][1]['parNom']] . "</p>
        <p>" . $b['texto'][2]['conDes'] . "
        </p>";
        $this->WriteTag(150, 5, utf8_decode($txt), 0, "J", 0, 0);
    }
    public function FutAproTituloCF($r, $b)
    {
        $porciones = explode("X0X", $b['texto'][1]['conDes']);
        $txt = "<p>" . $porciones[0] . "<vb>" . $b['denominacionGrado'] . "</vb>" . $porciones[1] . "</p>" .
            "<p>" . $r[$b['texto'][1]['parNom']] . "</p>
        <p>" . $b['texto'][2]['conDes'] . "
        </p>";
        $this->WriteTag(150, 5, utf8_decode($txt), 0, "J", 0, 0);
    }
}
