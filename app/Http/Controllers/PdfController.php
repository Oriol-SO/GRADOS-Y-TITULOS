<?php

namespace App\Http\Controllers;

use FPDF;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;
class PdfController extends Controller
{
    
    public function Addtopdf(Request $request)
    {

        // Now let's understand

        // To use Fpdi, we required to declare path in header of file.

        // create pdf by declare pdf variable
        $pdf = new Fpdi();


        // To add a page
        $pdf->AddPage();

        // to set font. This is compulsory
        $pdf->SetFont('Arial', 'B', 8);

        // set the source file
        // Below is the path of pdf in which you going to print details.
        //  Right now i had blank pdf
        $path = public_path("ORIGINAL FUT.pdf");

        // Set path
        $pdf->setSourceFile($path);

        // import page 1
        // define page number
        // if you want to print detail in page to you have to write 2 instead of 1.
        // right now we have only one page pdf.

        $tplId = $pdf->importPage(1);
        // use the imported page and place it at point 10,10 with a width of 100 mm
        $pdf->useTemplate($tplId, null, null, null, 210, true);

        // Now this details we are going to print in pdf.
        // Horizontal and veritcal setXY


        $pdf->SetXY(110, 30);
        // Details you want to print

        // Now let's change details an position
        $pdf->MultiCell(55, 5, utf8_decode($request->dato), 0);

       // let's bring another below it

        // Second details
        $pdf->SetXY(40, 50);
        $pdf->Write(0.1,"asunto");

        $pdf->SetXY(40, 60);
        $pdf->Write(0.1,"a");

        // Now this showing as preview in browser
// This is output
// let's check now by running project. But before that we have to add Route.

        // Because I is for preview for browser.
        $pdf->Output('F',"Fut.pdf");

    

        return "pdf modificado";


    }
}
