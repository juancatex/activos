<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Clases\Menulist;
 

class MenuController extends Controller
{   
    public function dashboard(Request $request): Response
    {   $listamenus = new Menulist; 
        return Inertia::render('Dashboard', [
            'menus' => $listamenus->Getmenus(''),
            'status' => session('status'),
        ]);
    }
}
