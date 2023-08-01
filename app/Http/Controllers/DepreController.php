<?php

namespace App\Http\Controllers;

use App\Models\depre;
use App\Models\ActivoAsignacion;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Ambiente;
use App\Models\ActivoGrupo;
use App\Models\ActivoAuxiliar;  
use App\Clases\Menulist;
use Illuminate\Support\Facades\DB;
use App\Models\Activo;
use App\Models\User;
use App\Models\ufv;

class DepreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $listamenus = new Menulist; 
        $raw=DB::raw('YEAR(activos.fechaingreso) as anio');
        $raw2=DB::raw('YEAR(curdate()) as aniofin');
        $raw3=DB::raw('concat(round(100/activo_grupos.vida,1)," %") as coeficiente');
        $activos= Activo::select("activos.*","ambientes.nomambiente","activo_grupos.nomgrupo","activo_grupos.vida","activo_auxiliars.nomauxiliar","ufvs.valor",$raw,$raw2,$raw3)
        ->join("ambientes","ambientes.idambiente","=","activos.idambiente")
        ->join("activo_grupos","activo_grupos.idag","=","activos.idgrupo")
        ->join("activo_auxiliars","activo_auxiliars.idauxiliar","=","activos.idauxiliar")
        ->join('ufvs','ufvs.fecha','activos.fechaingreso');
        if(!empty($request->search)){ 
            $activos= $activos->where('activos.codactivo','like',"%$request->search%") ; 
        }
        if(!empty($request->searchambiente)){ 
            $activos= $activos->where('activos.idambiente','=',$request->searchambiente); 
        }
        if(!empty($request->searchfecha)){ 
            $activos= $activos->where('activos.fechaingreso','=',$request->searchfecha); 
        }
        
        $activos= $activos->where('ambientes.activo',1)
        ->where('activo_grupos.activo',1)
        ->where('activo_auxiliars.activo',1)
        ->where('activos.activo',1)->paginate(10); 
          
        $ufvini=ufv::select('valor')->where('fecha','like','%-01-01')->get();
        $ufvfin=ufv::select('valor')->where('fecha','like','%-12-31')->get();
        $ambiente= Ambiente::where('ambientes.activo',1)->orderBy('ambientes.nomambiente')  
        ->get();   
 
        return Inertia::render('Activos/DepreActivo', [
            'menus' => $listamenus->Getmenus(empty($request->touch)?'0-0-0':$request->touch),
            'activos' => $activos, 
            'ufvini' => $ufvini, 
            'ambiente' => $ambiente,
            'ufvfin' => $ufvfin, 
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(depre $depre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(depre $depre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, depre $depre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(depre $depre)
    {
        //
    }
}
