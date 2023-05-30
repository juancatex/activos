<?php

namespace App\Clases;
 
use Illuminate\Support\Facades\DB;  
use App\Models\RolVista;
use Illuminate\Support\Facades\Auth;

Class Menulist
{
     
    public function Getmenus($guias)
    {    $buscararray = explode("-",$guias);

        $rolvistagrupo= RolVista::select("rol_vistas.idg","grupos.nomgrupo") 
        ->join("grupos","grupos.idg","=","rol_vistas.idg")
        ->where('rol_vistas.idrol',Auth::user()->idrol)
        ->where('grupos.activo',1)
        ->orderBy('rol_vistas.idg')
        ->groupBy('rol_vistas.idg','grupos.nomgrupo')
        ->get(); 
        $grupos = array();
        foreach($rolvistagrupo as $grupo) 
        {    
            $rolvistamenus= RolVista::select("rol_vistas.idm","menus.nommenu") 
            ->join("menus","menus.idm","=","rol_vistas.idm")
            ->where('rol_vistas.idrol',Auth::user()->idrol)
            ->where('rol_vistas.idg',$grupo->idg)
            ->where('menus.activo',1)
            ->orderBy('rol_vistas.idm')
            ->groupBy('rol_vistas.idm','menus.nommenu')
            ->get(); 
            $menusarray = array();
            foreach($rolvistamenus as $menus) 
            {    
                $rolvistavistas= RolVista::select("rol_vistas.idv","vistas.nomvista","vistas.ruta") 
                ->join("vistas","vistas.idv","=","rol_vistas.idv")
                ->where('rol_vistas.idrol',Auth::user()->idrol)
                ->where('rol_vistas.idg',$grupo->idg)
                ->where('rol_vistas.idm',$menus->idm)
                ->where('vistas.activo',1)
                ->orderBy('rol_vistas.idv')
                ->groupBy('rol_vistas.idv',"vistas.nomvista","vistas.ruta")
                ->get(); 
                $vistasarray = array();
                foreach($rolvistavistas as $vistas) 
                {      
                    array_push($vistasarray,array("id"=> $vistas->idv,"nombre"=>$vistas->nomvista,"active"=>($grupo->idg==$buscararray[0]&&$menus->idm==$buscararray[1]&&$vistas->idv==$buscararray[2]?true:false),"route"=>$vistas->ruta ));
                }

                array_push($menusarray,array( "id"=>$menus->idm, "menu"=>$menus->nommenu,"active"=>($grupo->idg==$buscararray[0]&&$menus->idm==$buscararray[1]?true:false), "routes"=>$vistasarray )); 
            }
            
            array_push($grupos,array( "id"=>$grupo->idg, "grupo"=>$grupo->nomgrupo,"active"=>($grupo->idg==$buscararray[0]?true:false), "lista"=>$menusarray )); 
        } 
        return   $grupos;
    }
}