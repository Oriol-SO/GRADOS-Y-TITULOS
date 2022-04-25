<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Formatos\PdfController;
use Illuminate\Http\Request;
use App\Models\tablainicio;

class BachillerIniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $BachillerIni['Mes']=tablainicio::all('Mes');
        $BachillerIni['Valor']=tablainicio::all('Iniciados');
        return($BachillerIni);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function pdf(){
        $documento = new PdfController(); 
        $documento=$documento->pdf->Output('S');
        //Almaceno el documento  
        
        $path = 'documentos/0/Especial1.pdf';
        Storage::put($path, $documento);
         
        return response()->json(["status" => 'Documento cargado', "path" => $path]);
    }
}
