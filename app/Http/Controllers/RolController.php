<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;
use App\Clases\Menulist;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $listamenus = new Menulist;  
        $roles= Rol::where('activo',1)
        ->orderBy('name')
        ->paginate(10);   
        return Inertia::render('Empresa/Cargos', [
            'menus' => $listamenus->Getmenus(empty($request->touch)?'0-0-0':$request->touch),
            'roles' => $roles 
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
            'name' => 'required|string|max:255', 
            'descripcionrol' => 'required|string' 
        ]);
        
        $Rol = Rol::create($request->input());  
        $Rol->save();
        return redirect('Roles');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rol $rol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rol $rol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rol $rol)
    {
        $Rol = Rol::findOrFail($request->idrol);
        $Rol->name = $request->name; 
        $Rol->descripcionrol = $request->descripcionrol;  
        $Rol->save(); 

        return redirect('Roles');
    }
    public function desabilitar(Request $request)
    {
        $Rol = Rol::findOrFail($request->idrol); 
        $Rol->activo = 0; 
        $Rol->save(); 
        return redirect('Roles');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rol $rol)
    {
        //
    }
}
