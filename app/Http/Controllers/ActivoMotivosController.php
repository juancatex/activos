<?php

namespace App\Http\Controllers;

use App\Models\ActivoMotivos;
use Illuminate\Http\Request;
use App\Clases\Menulist;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ActivoMotivosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $listamenus = new Menulist;  
        $ActivoMotivos= ActivoMotivos::where('activo',1)
        ->orderBy('idmotivo')
        ->paginate(10);   
      
        return Inertia::render('Empresa/Motivos', [
            'menus' => $listamenus->Getmenus(empty($request->touch)?'0-0-0':$request->touch),
            'ambiente' => $ActivoMotivos 
        ]);
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
        $request->validate([  
            'nommotivo' => 'required|string' 
        ]);
        
        $ActivoMotivos = ActivoMotivos::create($request->input());  
        $ActivoMotivos->save();
        return redirect('Motivo');
    }

    /**
     * Display the specified resource.
     */
    public function show(ActivoMotivos $activoMotivos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ActivoMotivos $activoMotivos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ActivoMotivos $activoMotivos)
    {
        $ActivoMotivos = ActivoMotivos::findOrFail($request->idmotivo); 
        $ActivoMotivos->nommotivo = $request->nommotivo;  
        $ActivoMotivos->save(); 

        return redirect('Motivo');
    }
    public function desabilitar(Request $request)
    {
        $ActivoMotivos = ActivoMotivos::findOrFail($request->idmotivo); 
        $ActivoMotivos->activo = 0; 
        $ActivoMotivos->save(); 
        return redirect('Motivo');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ActivoMotivos $activoMotivos)
    {
        //
    }
}
