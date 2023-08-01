<?php

namespace App\Http\Controllers;

use App\Models\ActivoGrupo;
use Illuminate\Http\Request;
use App\Clases\Menulist;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ActivoGrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $listamenus = new Menulist;  
        $ActivoGrupo= ActivoGrupo::where('activo',1)
        ->orderBy('idag')
        ->paginate(10);   
        $idactivolast = ActivoGrupo::latest()->first();
        return Inertia::render('Empresa/Grupo', [
            'menus' => $listamenus->Getmenus(empty($request->touch)?'0-0-0':$request->touch),
            'grupo' => $ActivoGrupo ,
            'lastid'=>$idactivolast!=null?$idactivolast->idag+1:1,
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
            'nomgrupo' => 'required|string' 
        ]);
        
        $ActivoGrupo = ActivoGrupo::create($request->input());  
        $ActivoGrupo->save();
        return redirect('Grupo');
    }

    /**
     * Display the specified resource.
     */
    public function show(ActivoGrupo $activoGrupo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ActivoGrupo $activoGrupo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ActivoGrupo $activoGrupo)
    {
        $ActivoGrupo = ActivoGrupo::findOrFail($request->idag); 
        $ActivoGrupo->nomgrupo = $request->nomgrupo;  
        $ActivoGrupo->vida = $request->vida;  
        $ActivoGrupo->save(); 

        return redirect('Grupo');
    }
    public function desabilitar(Request $request)
    {
        $ActivoGrupo = ActivoGrupo::findOrFail($request->idag); 
        $ActivoGrupo->activo = 0; 
        $ActivoGrupo->save(); 
        return redirect('Grupo');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ActivoGrupo $activoGrupo)
    {
        //
    }
}
