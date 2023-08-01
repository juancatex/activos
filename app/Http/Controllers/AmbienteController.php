<?php

namespace App\Http\Controllers;

use App\Models\Ambiente;
use Illuminate\Http\Request;
use App\Clases\Menulist;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AmbienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $listamenus = new Menulist;  
        $Ambiente= Ambiente::where('activo',1)
        ->orderBy('idambiente')
        ->paginate(10);   
        $idactivolast = Ambiente::latest()->first();
        return Inertia::render('Empresa/Ambiente', [
            'menus' => $listamenus->Getmenus(empty($request->touch)?'0-0-0':$request->touch),
            'ambiente' => $Ambiente ,
            'lastid'=>$idactivolast!=null?$idactivolast->idambiente+1:1,
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
            'nomambiente' => 'required|string' 
        ]);
        
        $Ambiente = Ambiente::create($request->input());  
        $Ambiente->save();
        return redirect('Ambiente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ambiente $ambiente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ambiente $ambiente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ambiente $ambiente)
    {
        $Ambiente = Ambiente::findOrFail($request->idambiente); 
        $Ambiente->nomambiente = $request->nomambiente;  
        $Ambiente->save(); 

        return redirect('Ambiente');
    }
    public function desabilitar(Request $request)
    {
        $Ambiente = Ambiente::findOrFail($request->idambiente); 
        $Ambiente->activo = 0; 
        $Ambiente->save(); 
        return redirect('Ambiente');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ambiente $ambiente)
    {
        //
    }
}
