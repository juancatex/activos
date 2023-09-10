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
use Illuminate\Support\Facades\Storage;
use App\Models\Activo;
use App\Models\User;
use App\Models\depre;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode; 

class ActivoAsignacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $listamenus = new Menulist; 
        $raw=DB::raw('(SELECT concat(u.name," ",u.ap," ",u.am)  FROM activo_asignacions a,users u where a.iduser=u.id and a.activo=1 and a.idactivo=activos.idactivo) as asig');
        $activos= Activo::select("activos.*","ambientes.nomambiente","activo_grupos.nomgrupo","activo_auxiliars.nomauxiliar","activo_asignacions.idasignacion",$raw)
        ->leftJoin('activo_asignacions', function($join) {
            $join->on('activo_asignacions.idactivo', '=', 'activos.idactivo')->where('activo_asignacions.activo',1);
          })
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

   
    public function reporte(Request $request)
    { 
        $raw=DB::raw('(SELECT concat(u.name," ",u.ap," ",u.am)  FROM activo_asignacions a,users u where a.iduser=u.id and a.activo=1 and a.idactivo=activos.idactivo) as asig');
        $activos= Activo::select("activos.*","ambientes.nomambiente","activo_grupos.nomgrupo","activo_auxiliars.nomauxiliar","activo_asignacions.idasignacion",$raw)
        ->join("activo_asignacions","activo_asignacions.idactivo","=","activos.idactivo")
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
        ->where('activo_asignacions.activo',1)
        ->where('activo_auxiliars.activo',1)
        ->where('activos.activo',1) ->orderBy('activos.idactivo')->get();  
        $pdf = PDF::loadView('reportes/activoAsig', ['data'=>$activos]); 
       
        return base64_encode($pdf->output());
        
    }
    public function reportesinasig(Request $request)
    { 
        $raw=DB::raw('(SELECT concat(u.name," ",u.ap," ",u.am)  FROM activo_asignacions a,users u where a.iduser=u.id and a.activo=1 and a.idactivo=activos.idactivo) as asig');
        $activos= Activo::select("activos.*","ambientes.nomambiente","activo_grupos.nomgrupo","activo_auxiliars.nomauxiliar","activo_asignacions.idasignacion",$raw)
        ->leftJoin('activo_asignacions', function($join) {
            $join->on('activo_asignacions.idactivo', '=', 'activos.idactivo')->where('activo_asignacions.activo',1);
          })
          ->whereNull('activo_asignacions.idactivo')
        // ->leftJoin("activo_asignacions","activo_asignacions.idactivo","=","activos.idactivo")
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
        ->where('activos.activo',1) ->orderBy('activos.idactivo')->get();  
        $pdf = PDF::loadView('reportes/activonoAsig', ['data'=>$activos]); 
       
        return base64_encode($pdf->output());
        
    }
    public function reporteid(Request $request)
    { 
        $raw=DB::raw('(SELECT concat(u.name," ",u.ap," ",u.am)  FROM activo_asignacions a,users u where a.iduser=u.id and a.activo=1 and a.idactivo=activos.idactivo) as responsable');
        $activos= Activo::select("activos.*","ambientes.nomambiente","activo_grupos.nomgrupo","activo_grupos.vida","activo_auxiliars.nomauxiliar","activo_asignacions.idasignacion","activo_asignacions.estadoini","activo_asignacions.fechaini",$raw)
        ->join("activo_asignacions","activo_asignacions.idactivo","=","activos.idactivo")
        ->join("ambientes","ambientes.idambiente","=","activos.idambiente")
        ->join("activo_grupos","activo_grupos.idag","=","activos.idgrupo")
        ->join("activo_auxiliars","activo_auxiliars.idauxiliar","=","activos.idauxiliar")  
        ->where('ambientes.activo',1)
        ->where('activo_grupos.activo',1)
        ->where('activo_auxiliars.activo',1)
        ->where('activo_asignacions.activo',1)
        ->where('activo_asignacions.idasignacion',$request->id)
        ->where('activos.activo',1)->latest()->first();  

        $depre= depre::where('idactivo',$activos->idactivo)->orderBy('gestion', 'desc')->first();
        
        // print_r( $activos);
        $pdf = PDF::loadView('reportes/activoId', ['activos'=>$activos,'depre'=>$depre,'qrval'=>
        QrCode::format('png')->style('round')->eye('circle')->
        // errorCorrection('H')->
        // mergeString(Storage::disk('public')->get('logo.png'), .3, true)->
        eyeColor(0, 32, 93, 157, 0, 157, 225)->
        eyeColor(1, 32, 93, 157, 0, 157, 225)->
        eyeColor(2, 32, 93, 157, 0, 157, 225)->
        color(32, 93, 157)->size(70)->generate($activos->idactivo.'|'.$activos->idambiente.'|'.$activos->idgrupo.'|'.$activos->idauxiliar)]); 
       
        return base64_encode($pdf->output());
        
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
