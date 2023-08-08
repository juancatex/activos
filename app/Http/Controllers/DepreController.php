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
    public function trunn(){
          depre::truncate(); 
     }
    public function getdepre(Request $request){
        $raw=DB::raw('round(ufvini,5) as ufvi');
        $raw2=DB::raw('round(ufvfin,5) as ufvf');
        return depre::select('depres.*', $raw, $raw2)->where('idactivo',$request->id)->orderBy('gestion', 'asc')->get();
    }
    public function depre(Request $request)
    {
        $raw=DB::raw('YEAR(activos.fechaingreso) as punteroanioreg');
        $raw3=DB::raw('(12-MONTH(activos.fechaingreso))+1 as mesprimer');
        $raw2=DB::raw('YEAR(curdate()) as anioactual');
        $activos= Activo::select("activos.costo","activos.fechaingreso","activos.residual","activo_grupos.vida", $raw, $raw2,$raw3) 
        ->join("activo_grupos","activo_grupos.idag","=","activos.idgrupo")  
        ->where('activo_grupos.activo',1) 
        ->where('activos.activo',1)
        ->where('activos.idactivo',$request->id)
        ->first(); 
        $coeficiente=round((100/$activos->vida)/100,4,PHP_ROUND_HALF_UP);
        $totalmeses=(int) round($activos->vida*12); 
        $residual=$activos->residual; 
       
        
        for ($anios=$activos->punteroanioreg; $anios < $activos->anioactual; $anios++) { 
            $ia=0;
            $vc=0;
            $suma_vc=0;
            $sum_ida=0;
            $sum_dp=0;
            $daan=0; 
              
            $vc=depre::where('idactivo',$request->id)->where('gestion', '<',$anios)->sum('ia');
            $sum_ida=depre::where('idactivo',$request->id)->where('gestion', '<',$anios)->sum('ida');
            $sum_dp=depre::where('idactivo',$request->id)->where('gestion', '<',$anios)->sum('pd');
            $mesestomados=depre::where('idactivo',$request->id)->where('gestion', '<',$anios)->sum('vidat');

            $suma_vc=round($vc+$activos->costo,2,PHP_ROUND_HALF_UP);   
            $daan=round($sum_ida+$sum_dp,2,PHP_ROUND_HALF_UP); 
            $mesin=(int)$totalmeses-$mesestomados;
            if($activos->punteroanioreg==$anios){  
               $mestom=$activos->mesprimer;  
               $ufv_ini_data=ufv::where('fecha',$activos->fechaingreso)->first(); 
               $ufv_fin_data=ufv::where('fecha',$anios.'-12-31')->first();
               $ufv_ini=$ufv_ini_data->valor;
               $ufv_fin=$ufv_fin_data->valor;

            }else{ 
                
                if($mesin>12){ 
                    $mestom=12;
                    $fechafineva=$anios.'-12-31';
                }else{
                    $mestom=$mesin;  
                    $feaux=$anios.'-'.$mesin.'-01';
                    $fechafineva = date("Y-m-t", strtotime($feaux));
                }
               $ufv_ini_data=ufv::where('fecha',$anios.'-01-01')->first(); 
               $ufv_fin_data=ufv::where('fecha',$fechafineva)->first();

               $ufv_ini=$ufv_ini_data->valor;
               $ufv_fin=$ufv_fin_data->valor;
            }
            $mesfin=(int) $mesin-$mestom; 
               
            $ia=round((($ufv_fin/$ufv_ini)-1)*$suma_vc,2,PHP_ROUND_HALF_UP);
           
            $va=round($ia+$suma_vc,2,PHP_ROUND_HALF_UP); 
            
            if($residual>0){
                $dp=round(((($va-($residual))*$coeficiente)/12)*$mestom,2,PHP_ROUND_HALF_UP); 
            }else{
                $dp=round(((($va)*$coeficiente)/12)*$mestom,2,PHP_ROUND_HALF_UP);
            }
            
          
            $ida=0;
            if($daan==0){
                $ida=0;
            }else{
                $ida=round((($ufv_fin/$ufv_ini)-1)*$daan,2,PHP_ROUND_HALF_UP); 
            }
            $acumulado=round(($daan+$ida+$dp),2,PHP_ROUND_HALF_UP);   
            $valorneto=round($va-($acumulado),2,PHP_ROUND_HALF_UP);   
            $depre =new depre();
            $depre->idactivo = $request->id;
            $depre->idufvini = $ufv_ini_data->idufv;
            $depre->idufvfin = $ufv_fin_data->idufv;
            $depre->ufvini = $ufv_ini_data->valor;
            $depre->ufvfin = $ufv_fin_data->valor;
            $depre->vidai = (int)$totalmeses-$mesfin;
            $depre->vidat = $mestom;
            $depre->vidaf = $mesfin;
            $depre->gestion = $anios;
            $depre->periodo = 12;
            $depre->vc = $suma_vc;
            $depre->va = $va;
            $depre->ia = $ia;
            $depre->daan = $daan;
            $depre->ida = $ida;
            $depre->pd = $dp;
            $depre->acu = $acumulado;
            $depre->valor = $valorneto;
            $depre->save(); 
  
           if($mesfin<=0){
            break;
           }  
           
        }
        
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
