<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Clases\Menulist;
use App\Models\Activo;
use Illuminate\Support\Facades\DB;
use App\Models\depre;
 

class MenuController extends Controller
{   
    public function dashboard(Request $request): Response
    {   $listamenus = new Menulist; 
        $anio= date("Y");
        $mesini=(int) date("m"); 
        $arrayaltas = array();
        $arraybajas = array();
for ($mes=1; $mes <=$mesini ; $mes++) {  
        $fechainicio=$anio."-".($mes<=9?'0'.$mes:$mes)."-01"; 
        $fechafin = date("Y-m-t", strtotime($fechainicio));
        $cca=Activo::where('activo',1)->whereBetween('fechaingreso', [$fechainicio, $fechafin])->count(); 
        $ccb=Activo::where('activo',0)->whereBetween('fechabaja', [$fechainicio, $fechafin])->count(); 
        array_push($arrayaltas, $cca); 
        array_push($arraybajas,$ccb);    
} 

        $total=Activo::where('activo',1)->count(); 
        $totala=Activo::where('activo',1)->where('fechaingreso', '>=',$anio.'-01-01')->count(); 
        $totalb=Activo::where('activo',0)->where('fechabaja', '>=',$anio.'-01-01')->count(); 
        $sumatotal=Activo::where('activo',1)->where('fechaingreso', '>=',$anio.'-01-01')->sum('costo');
       
        $totalasig= Activo::join("activo_asignacions","activo_asignacions.idactivo","=","activos.idactivo")
        ->where('activo_asignacions.activo',1) 
        ->where('activos.activo',1)->count(); 

       
        $sinasig=0;
        $activossin= Activo::select("activo_asignacions.idasignacion")
        ->leftJoin('activo_asignacions', function($join) {
            $join->on('activo_asignacions.idactivo', '=', 'activos.idactivo')->where('activo_asignacions.activo',1);
          }) 
        ->where('activos.activo',1)->get(); 
        foreach($activossin as $grupo) {
            if(is_null($grupo->idasignacion)){
                $sinasig++;
            }
        }
        $activosporbaja=0;
        $activos=Activo::where('activo',1)->where('fechaingreso', '<=',($anio-1).'-12-31')->get(); 
        foreach($activos as $act) {
            $countdepre=depre::where('idactivo',$act->idactivo)->orderBy('gestion', 'desc')->count(); 
           if( $countdepre>0){
            $depre=depre::where('idactivo',$act->idactivo)->orderBy('gestion', 'desc')->first();
            if($depre->vidaf<=12){
                $activosporbaja++; 
            }
           }
            
        }
       
        return Inertia::render('Dashboard', [
            'menus' => $listamenus->Getmenus(''),
            'status' => session('status'),
            'totalasig' =>  $totalasig,
            'totalasigp' => $total>0? round(($totalasig*100)/ $total):0,
            'sinasigp' => $total>0?  round(($sinasig*100)/ $total):0, 
            'sinasig' =>  $sinasig,
            'anio' =>  $anio,
            'sumatotal' =>   $sumatotal,
            'totala' =>   $totala,
            'totalb' =>   $totalb,
            'activosporbaja' =>   $activosporbaja,
            'activosporbajap' => sizeof($activos)>0? round(($activosporbaja*100)/ sizeof($activos)):0,
            'arrayaltas'=>$arrayaltas,
            'arraybajas'=> $arraybajas 
        ]);
    }
}
