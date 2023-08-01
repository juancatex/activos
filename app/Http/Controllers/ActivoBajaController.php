<?php

namespace App\Http\Controllers;
use App\Models\Activo;
use Inertia\Inertia;
use App\Models\Ambiente;
use App\Models\ActivoMotivos;
use App\Models\ActivoGrupo;
use App\Models\ActivoAuxiliar;
use App\Models\User;
use Illuminate\Http\Request;
use App\Clases\Menulist;
use Illuminate\Support\Facades\DB;

class ActivoBajaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $listamenus = new Menulist; 

        $raw2=DB::raw('activo_asignacions.activo as asigactivo');
        $raw=DB::raw('(SELECT concat(u.name," ",u.ap," ",u.am)  FROM activo_asignacions a,users u where a.iduser=u.id and a.activo=1 and a.idactivo=activos.idactivo) as asig');
        $activos= Activo::select("activos.*","ambientes.nomambiente","activo_grupos.nomgrupo","activo_auxiliars.nomauxiliar","activo_asignacions.idasignacion",$raw,$raw2)
        // ->leftJoin("activo_asignacions","activo_asignacions.idactivo","=","activos.idactivo")
        ->leftJoin('activo_asignacions', function($join) {
            $join->on('activo_asignacions.idactivo', '=', 'activos.idactivo')->where('activo_asignacions.activo',1);
          })
        ->join("ambientes","ambientes.idambiente","=","activos.idambiente")
        ->join("activo_grupos","activo_grupos.idag","=","activos.idgrupo")
        ->join("activo_auxiliars","activo_auxiliars.idauxiliar","=","activos.idauxiliar");
        if(!empty($request->search)){ 
            $activos= $activos->where('activos.codactivo','like',"%$request->search%") ; 
        }
        if(!empty($request->searchambiente)){ 
            $activos= $activos->where('activos.idambiente','=',$request->searchambiente); 
        } 
       

        $activos= $activos->where('ambientes.activo',1)
        ->where('activo_grupos.activo',1)
        ->where('activo_auxiliars.activo',1)
        // ->where('activos.activo',1)
        // ->where('activo_asignacions.activo',1)
        ->orderBy('activos.idactivo')
        ->paginate(10); 
        
        
       $ambiente= Ambiente::where('ambientes.activo',1)->orderBy('ambientes.nomambiente')  
        ->get();   
        $grupo= ActivoGrupo::where('activo_grupos.activo',1)->orderBy('activo_grupos.nomgrupo') 
        ->get();   
        $aux= ActivoAuxiliar::where('activo_auxiliars.activo',1)->orderBy('activo_auxiliars.nomauxiliar')  
        ->get(); 
        $motivo= ActivoMotivos::where('activo',1)->orderBy('nommotivo')  
        ->get(); 

        $idactivolast = Activo::latest()->first();

        return Inertia::render('Activos/BajaActivo', [ 
            'menus' => $listamenus->Getmenus(empty($request->touch)?'0-0-0':$request->touch),
            'activos' => $activos,
            'ambiente' => $ambiente,
            'grupo' => $grupo,
            'motivos' => $motivo,
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function desabilitar(Request $request)
    {
        $request->validate([  
            'idactivo' => 'required|numeric', 
            'fechabaja' => 'required|string|max:255', 
            'nrordenbaja' => 'required|string|max:255', 
            'idmotivobaja' => 'required|numeric',  
            'obsbaja' => 'required|string' 
        ]);
        $activo = Activo::findOrFail($request->idactivo);  
        $activo->fechabaja = $request->fechabaja; 
        $activo->nrordenbaja = $request->nrordenbaja; 
        $activo->idmotivobaja = $request->idmotivobaja; 
        $activo->obsbaja = $request->obsbaja; 
        $activo->activo = 0;
        $activo->save(); 
        return redirect('ActivoBaja');
    }
}
