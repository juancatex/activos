<?php

namespace App\Http\Controllers;

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

class ActivoAsignacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $listamenus = new Menulist; 
        $raw=DB::raw('(SELECT concat(u.name," ",u.ap," ",u.am)  FROM activo_asignacions a,users u where a.iduser=u.id and a.activo=1 and a.idactivo=activos.idactivo) as asig');
        $activos= Activo::select("activos.*","ambientes.nomambiente","activo_grupos.nomgrupo","activo_auxiliars.nomauxiliar",$raw)
        ->join("ambientes","ambientes.idambiente","=","activos.idambiente")
        ->join("activo_grupos","activo_grupos.idag","=","activos.idgrupo")
        ->join("activo_auxiliars","activo_auxiliars.idauxiliar","=","activos.idauxiliar")  ; 
        if(!empty($request->search)){ 
            $activos= $activos->where('activos.codactivo','like',"%$request->search%") ; 
        }
        if(!empty($request->searchambiente)){ 
            $activos= $activos->where('activos.idambiente','=',$request->searchambiente); 
        }
        if(!empty($request->searchfecha)){ 
            $activos= $activos->where('activos.fechaingreso','=',$request->searchfecha); 
        }
        $activos= $activos ->where('ambientes.activo',1)
        ->where('activo_grupos.activo',1)
        ->where('activo_auxiliars.activo',1)
        ->where('activos.activo',1) ->orderBy('activos.idactivo')->paginate(10); 
        
        $ambiente= Ambiente::where('ambientes.activo',1)->orderBy('ambientes.nomambiente')  
        ->get();   
        $grupo= ActivoGrupo::where('activo_grupos.activo',1)->orderBy('activo_grupos.nomgrupo') 
        ->get();   
        $aux= ActivoAuxiliar::where('activo_auxiliars.activo',1)->orderBy('activo_auxiliars.nomauxiliar') 
        ->get(); 
        
        $users= User::select("users.id",  
        "users.name",
        "users.ap",
        "users.am", 
        "users.idu",  
        DB::raw("ambientes.nomambiente as nomuni")
        ) 
        ->join("ambientes","ambientes.idambiente","=","users.idu")
        ->where('users.activo',1) 
        ->where('ambientes.activo',1)
        ->orderBy('users.id')
        ->get(); 


        $idactivolast = Activo::latest()->first();

        return Inertia::render('Activos/AsigActivo', [
            'menus' => $listamenus->Getmenus(empty($request->touch)?'0-0-0':$request->touch),
            'activos' => $activos,
            'users' =>  $users,
            'ambiente' => $ambiente,
            'grupo' => $grupo,
            'aux' => $aux,
            'lastid'=>$idactivolast!=null?$idactivolast->idactivo+1:1,
            'status' => session('status'),
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
            'idactivo' => 'required|numeric',
            'iduser' => 'required|numeric',  
            'fechaini' => 'required|string|max:255', 
            'codactivo' => 'required|string|max:255', 
            'estadoini' => 'required|numeric',  
            'obs' => 'required|string' 
        ]);
        $Activo = ActivoAsignacion::create([
            'idactivo' => $request->idactivo,
            'codactivoasig' => $request->codactivo,
            'iduser' => $request->iduser,
            'fechaini' => $request->fechaini,
            'estadoini' => $request->estadoini,
            'obs' => $request->obs 
        ]);  
        return redirect('ActivoAsig');
    }

    /**
     * Display the specified resource.
     */
  

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
