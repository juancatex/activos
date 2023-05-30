<?php

namespace App\Http\Controllers;

use App\Models\ActivoAsignacion;
use Illuminate\Http\Request;

class ActivoAsignacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $Activo = ActivoAsignacion::create([
            'idactivo' => $request->idactivo,
            'iduser' => $request->iduser,
            'fechaini' => $request->fechaini,
            'estadoini' => $request->estadoini,
            'obs' => $request->obs 
        ]);  
        return redirect('Activo');
    }

    /**
     * Display the specified resource.
     */
    public function show(ActivoAsignacion $activoAsignacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ActivoAsignacion $activoAsignacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ActivoAsignacion $activoAsignacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ActivoAsignacion $activoAsignacion)
    {
        //
    }
}
