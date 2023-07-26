<?php

namespace App\Http\Controllers;

use App\Models\Activo;
use Inertia\Inertia;
use App\Models\Ambiente;
use App\Models\ActivoGrupo;
use App\Models\ActivoAuxiliar;
use App\Models\User;
use Illuminate\Http\Request;
use App\Clases\Menulist;
use Illuminate\Support\Facades\DB;

class ActivoController extends Controller
{
    
    public function index(Request $request)
    {
        $listamenus = new Menulist; 
        $raw=DB::raw('(SELECT concat(u.name," ",u.ap," ",u.am)  FROM activo_asignacions a,users u where a.iduser=u.id and a.activo=1 and a.idactivo=activos.idactivo) as asig');
        $activos= Activo::select("activos.*","ambientes.nomambiente","activo_grupos.nomgrupo","activo_auxiliars.nomauxiliar",$raw)
        ->join("ambientes","ambientes.idambiente","=","activos.idambiente")
        ->join("activo_grupos","activo_grupos.idag","=","activos.idgrupo")
        ->join("activo_auxiliars","activo_auxiliars.idauxiliar","=","activos.idauxiliar")
        ->where('ambientes.activo',1)
        ->where('activo_grupos.activo',1)
        ->where('activo_auxiliars.activo',1)
        ->where('activos.activo',1)
        ->orderBy('activos.idactivo')
        ->paginate(10); 
        
        
        $ambiente= Ambiente::where('ambientes.activo',1)->orderBy('ambientes.nomambiente')  
        ->get();   
        $grupo= ActivoGrupo::where('activo_grupos.activo',1)->orderBy('activo_grupos.nomgrupo') 
        ->get();   
        $aux= ActivoAuxiliar::where('activo_auxiliars.activo',1)->orderBy('activo_auxiliars.nomauxiliar')  
        ->get(); 

        $idactivolast = Activo::latest()->first();

        return Inertia::render('Activos/Activo', [
            'menus' => $listamenus->Getmenus('0-0-0'),
            'activos' => $activos,
            'ambiente' => $ambiente,
            'grupo' => $grupo,
            'aux' => $aux,
            'lastid'=>$idactivolast!=null?$idactivolast->idactivo+1:1,
            'status' => session('status'),
        ]);
    }
    public function ruta(Request $request)
    {
        $request->validate([
            'touch' => 'required|string|max:255' 
        ]);
 
        $listamenus = new Menulist; 
        $raw=DB::raw('(SELECT concat(u.name," ",u.ap," ",u.am)  FROM activo_asignacions a,users u where a.iduser=u.id and a.activo=1 and a.idactivo=activos.idactivo) as asig');
        $activos= Activo::select("activos.*","ambientes.nomambiente","activo_grupos.nomgrupo","activo_auxiliars.nomauxiliar",$raw)
        ->join("ambientes","ambientes.idambiente","=","activos.idambiente")
        ->join("activo_grupos","activo_grupos.idag","=","activos.idgrupo")
        ->join("activo_auxiliars","activo_auxiliars.idauxiliar","=","activos.idauxiliar")
        ->where('ambientes.activo',1)
        ->where('activo_grupos.activo',1)
        ->where('activo_auxiliars.activo',1)
        ->where('activos.activo',1)
        ->orderBy('activos.idactivo')
        ->paginate(10); 
        
        
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
        DB::raw("ambientes.nomambiente as nomuni")
        ) 
        ->join("ambientes","ambientes.idambiente","=","users.idu")
        ->where('users.activo',1) 
        ->where('ambientes.activo',1)
        ->orderBy('users.id')
        ->get(); 




        $idactivolast = Activo::latest()->first();

        return Inertia::render('Activos/Activo', [
            'menus' => $listamenus->Getmenus($request->touch),
            'activos' => $activos,
            'ambiente' => $ambiente,
            'grupo' => $grupo,
            'users' =>  $users,
            'aux' => $aux,
            'lastid'=>$idactivolast!=null?$idactivolast->idactivo+1:1,
            'status' => session('status'),
        ]);
    }
   
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
            'codactivo' => 'required|string|max:255',
            'idambiente' => 'required|numeric',
            'idgrupo' => 'required|numeric',
            'idauxiliar' => 'required|numeric', 
            'fechaingreso' => 'required|string|max:255', 
            'costo' => 'required|numeric', 
            'descripcion' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'serie' => 'required|string|max:255',
            'imagen' => 'required|string' 
        ]);
        
        $Activo = Activo::create($request->input());  
        $Activo->save();
        return redirect('Activo');
    }

    /**
     * Display the specified resource.
     */
    public function show(Activo $activo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activo $activo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activo $activo)
    {  

        $activo = Activo::findOrFail($request->idactivo);
        $activo->codactivo = $request->codactivo; 
        $activo->idambiente = $request->idambiente; 
        $activo->idgrupo = $request->idgrupo; 
        $activo->idauxiliar = $request->idauxiliar; 
        $activo->fechaingreso = $request->fechaingreso; 
        $activo->costo = $request->costo; 
        $activo->descripcion = $request->descripcion; 
        $activo->marca = $request->marca; 
        $activo->serie = $request->serie; 
        $activo->imagen = $request->imagen; 
        $activo->obs = $request->obs;   
        $activo->save(); 

        return redirect('Activo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function desabilitar(Request $request)
    {
        $activo = Activo::findOrFail($request->idactivo); 
        $activo->activo = 0; 
        $activo->save(); 
        return redirect('Activo');
    }
}
