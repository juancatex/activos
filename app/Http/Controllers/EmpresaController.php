<?php

namespace App\Http\Controllers;

use App\Models\empresa;
use Illuminate\Http\Request;
use App\Clases\Menulist;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $listamenus = new Menulist;  
        $empresa= empresa::get()->first();   
        return Inertia::render('Empresa/DatosEmpresa', [
            'menus' => $listamenus->Getmenus(empty($request->touch)?'0-0-0':$request->touch),
            'datosempresa' => $empresa 
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
    public function show(empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(empresa $empresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, empresa $empresa)
    {
        $empresa = empresa::findOrFail($request->idempresa);
        $empresa->nombre = $request->nombre; 
        $empresa->direccion = $request->direccion; 
        $empresa->nit = $request->nit; 
        $empresa->telefono1 = $request->telefono1; 
        $empresa->telefono2 = $request->telefono2; 
        $empresa->telefono3 = $request->telefono3; 
        $empresa->telefono4 = $request->telefono4; 
        $empresa->ciudad = $request->ciudad; 
        $empresa->web = $request->web; 
        $empresa->email = $request->email;  
        $empresa->save(); 

        return redirect('/EmpresaDatos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(empresa $empresa)
    {
        //
    }
}
