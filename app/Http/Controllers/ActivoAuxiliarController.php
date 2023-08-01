<?php

namespace App\Http\Controllers;

use App\Models\ActivoAuxiliar;
use Illuminate\Http\Request;
use App\Clases\Menulist;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Models\ActivoGrupo;

class ActivoAuxiliarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $listamenus = new Menulist;  
        $ActivoAuxiliar= ActivoAuxiliar::select("activo_auxiliars.*","activo_grupos.nomgrupo")
        ->join("activo_grupos","activo_grupos.idag","=","activo_auxiliars.idgrupo")
        ->where('activo_grupos.activo',1)
        ->where('activo_auxiliars.activo',1)
        ->orderBy('activo_auxiliars.idgrupo')
        ->orderBy('idauxiliar')
        ->paginate(10);   
  
          $idactivolast = ActivoAuxiliar::where('activo',1)->latest()->first();
       
        $grupo= ActivoGrupo::where('activo_grupos.activo',1)->orderBy('activo_grupos.nomgrupo') 
        ->get();  
        return Inertia::render('Empresa/Auxciliar', [
            'menus' => $listamenus->Getmenus(empty($request->touch)?'0-0-0':$request->touch),
            'auxs' => $ActivoAuxiliar ,
            'grupos' => $grupo,
            'lastid'=>$idactivolast!=null?$idactivolast->idauxiliar+1:1,
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
        
        $ActivoAuxiliar = ActivoAuxiliar::create($request->input());  
        $ActivoAuxiliar->save();
        return redirect('Auxiliar');
    }

    /**
     * Display the specified resource.
     */
    public function show(ActivoAuxiliar $activoAuxiliar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ActivoAuxiliar $activoAuxiliar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ActivoAuxiliar $activoAuxiliar)
    {
        $ActivoAuxiliar = ActivoAuxiliar::findOrFail($request->idauxiliar); 
        $ActivoAuxiliar->nomauxiliar = $request->nomauxiliar;  
        $ActivoAuxiliar->idgrupo = $request->idgrupo;  
        // $ActivoAuxiliar->codauxiliar = $request->codauxiliar;  
        $ActivoAuxiliar->save(); 

        return redirect('Auxiliar');
    }
    public function desabilitar(Request $request)
    {
        $ActivoAuxiliar = ActivoAuxiliar::findOrFail($request->idauxiliar); 
        $ActivoAuxiliar->activo = 0; 
        $ActivoAuxiliar->save(); 
        return redirect('Auxiliar');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ActivoAuxiliar $activoAuxiliar)
    {
        //
    }
}
