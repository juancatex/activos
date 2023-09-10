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
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode; 

class ActivoDevolucionController extends Controller
{
    public function index(Request $request)
    {
        $listamenus = new Menulist; 
        $raw=DB::raw('(SELECT concat(u.name," ",u.ap," ",u.am)  FROM users u where u.id=activo_asignacions.iduser) as asig');
        $raw2=DB::raw('activo_asignacions.activo as asigactivo');
        $raw3=DB::raw('activo_asignacions.obs as obsini');
        $activos= Activo::select("activos.*","ambientes.nomambiente","activo_grupos.nomgrupo","activo_auxiliars.nomauxiliar",
        "activo_asignacions.fechaini","activo_asignacions.estadoini","activo_asignacions.fechafin","activo_asignacions.estadofin","activo_asignacions.idasignacion",
        "activo_asignacions.obsfin","activo_asignacions.codactivoasig",$raw,$raw2,$raw3)
        ->join("activo_asignacions","activo_asignacions.idactivo","=","activos.idactivo")
        ->join("ambientes","ambientes.idambiente","=","activos.idambiente")
        ->join("activo_grupos","activo_grupos.idag","=","activos.idgrupo")
        ->join("activo_auxiliars","activo_auxiliars.idauxiliar","=","activos.idauxiliar")
        // ->where('activo_asignacions.activo',1)
        ->where('ambientes.activo',1)
        ->where('activo_grupos.activo',1)
        ->where('activo_auxiliars.activo',1)
        ->where('activos.activo',1); 
        if(empty($request->search)){
            $activos= $activos->orderBy('activos.idactivo') ; 
        }else{
            $activos= $activos->where('activos.codactivo','like',"%$request->search%")
            ->orderBy('activos.idactivo') ; 
        }
        

        $activos= $activos->paginate(10); 
        
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

        return Inertia::render('Activos/DevActivo', [
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
    public function reporte(Request $request)
    {
        $listamenus = new Menulist; 
        $raw=DB::raw('(SELECT concat(u.name," ",u.ap," ",u.am)  FROM users u where u.id=activo_asignacions.iduser) as asig');
        $raw2=DB::raw('activo_asignacions.activo as asigactivo');
        $raw3=DB::raw('activo_asignacions.obs as obsini');
        $activos= Activo::select("activos.*","ambientes.nomambiente","activo_grupos.nomgrupo","activo_auxiliars.nomauxiliar",
        "activo_asignacions.fechaini","activo_asignacions.estadoini","activo_asignacions.fechafin","activo_asignacions.estadofin","activo_asignacions.idasignacion",
        "activo_asignacions.obsfin","activo_asignacions.codactivoasig",$raw,$raw2,$raw3)
        ->join("activo_asignacions","activo_asignacions.idactivo","=","activos.idactivo")
        ->join("ambientes","ambientes.idambiente","=","activos.idambiente")
        ->join("activo_grupos","activo_grupos.idag","=","activos.idgrupo")
        ->join("activo_auxiliars","activo_auxiliars.idauxiliar","=","activos.idauxiliar")
        // ->where('activo_asignacions.activo',1)
        ->where('ambientes.activo',1)
        ->where('activo_grupos.activo',1)
        ->where('activo_auxiliars.activo',1)
        ->where('activos.activo',1)
        ->where('activos.idactivo',$request->id) 
        ->latest()->first(); 
   
        $pdf = PDF::loadView('reportes/activoDevId', ['activos'=>$activos,'qrval'=>
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
        
    }

    /**
     * Display the specified resource.
     */
  


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([  
            'idasignacion' => 'required|numeric', 
            'fechafin' => 'required|string|max:255', 
            'estadofin' => 'required|numeric',  
            'obsfin' => 'required|string' 
        ]);
        $activoasig = ActivoAsignacion::findOrFail($request->idasignacion); 
        $activoasig->fechafin = $request->fechafin; 
        $activoasig->estadofin = $request->estadofin; 
        $activoasig->obsfin = $request->obsfin;   
        $activoasig->activo = 0;   
        $activoasig->save(); 

        return redirect('ActivoDev');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
