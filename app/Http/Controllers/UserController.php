<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Clases\Menulist;
use App\Models\User;
use App\Models\Rol;
use App\Models\Activo; 
use App\Models\Ambiente;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PDF;
use Carbon\Carbon;

class UserController extends Controller
{
   /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'ap' => 'required|string|max:255',
            'am' => 'required|string|max:255',
            'fecin' => 'required|string|max:255',
            'fecnac' => 'required|string|max:255',
            'dir' => 'required|string|max:1055',
            'ci' => 'required|numeric',
            'cel' => 'required|numeric',
            'idrol' => 'required|numeric',
            'idu' => 'required|numeric',
            'email' => 'required|string|email|max:255|unique:'.User::class, 
        ]);

        $user = User::create([
            'name' => $request->name,
            'ap' => $request->ap,
            'am' => $request->am,
            'ci' => $request->ci,
            'dir' => $request->dir,
            'cel' => $request->cel,
            'fecnac' => $request->fecnac,
            'fecin' => $request->fecin,
            'email' => $request->email, 
            'password' => Hash::make($request->ci),
            'idrol' => $request->idrol, 
            'idu' => $request->idu
        ]);  
        return redirect('User');
    }
    public function desabilitar(Request $request)
    {
        $user = User::findOrFail($request->id); 
        $user->activo = 0; 
        $user->save(); 
        return redirect('User');
    }
    function getanios($meses){
        $anios=0;
        $outmeses=$meses;
        while ($outmeses>=12) {
            $anios++;
            $outmeses-=12; 
        } 
          return $anios>0?($anios."años y ".$outmeses."meses"):$outmeses." meses"; 
       }
    public function reporte(Request $request){
       
        $activos= Activo::select("activos.*","ambientes.nomambiente","activo_grupos.nomgrupo","activo_grupos.vida",
        "activo_auxiliars.nomauxiliar","activo_asignacions.idasignacion","activo_asignacions.estadoini","activo_asignacions.fechaini")
         ->join("activo_asignacions","activo_asignacions.idactivo","=","activos.idactivo")
        ->join("ambientes","ambientes.idambiente","=","activos.idambiente")
        ->join("activo_grupos","activo_grupos.idag","=","activos.idgrupo")
        ->join("activo_auxiliars","activo_auxiliars.idauxiliar","=","activos.idauxiliar")  
        ->where('activos.activo',1)
        ->where('ambientes.activo',1)
        ->where('activo_grupos.activo',1)
        ->where('activo_auxiliars.activo',1)
        ->where('activo_asignacions.activo',1)
        ->where('activo_asignacions.iduser',$request->id)->get();

        foreach($activos as $act) { 
           
            if(is_null($act->getdepres)){
                $act->vidaft="No generado";
            }else{
                $act->getdepres->vidaft=$this->getanios($act->getdepres->vidaf);
            }
        }
        Carbon::setlocale(config('app.locale'));
        $date = Carbon::now();


        $user=User::where('id',$request->id)->first();
 
        $pdf = PDF::loadView('reportes/activouser', ['data'=>$activos,'user'=>$user ,'date'=>$date->translatedFormat('j \de F \de Y')]); 
       
        return base64_encode($pdf->output());
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'ap' => 'required|string|max:255',
            'am' => 'required|string|max:255',
            'fecin' => 'required|string|max:255',
            'fecnac' => 'required|string|max:255',
            'dir' => 'required|string|max:1055',
            'ci' => 'required|numeric',
            'cel' => 'required|numeric',
            'idrol' => 'required|numeric',
            'idu' => 'required|numeric',
            'email' => 'required|string|email|max:255', 
        ]);

        $user = User::findOrFail($request->id);
        $user->name = $request->name;
        $user->ap = $request->ap;
        $user->am = $request->am;
        $user->ci = $request->ci;
        $user->dir = $request->dir;
        $user->cel = $request->cel;
        $user->fecnac = $request->fecnac;
        $user->fecin = $request->fecin;
        $user->email = $request->email;
        $user->idrol = $request->idrol;
        $user->idu = $request->idu; 
        $user->save();
        return redirect('User');
    }
    public function ruta(Request $request)
    { 
        $request->validate([
            'touch' => 'required|string|max:255' 
        ]);
 
        $listamenus = new Menulist; 

        $users= User::select("users.id", 
        DB::raw("CONCAT(users.name,' ',users.ap,' ',users.am) as full_name"),
        "users.name",
        "users.ap",
        "users.am",
        "users.ci",
        "users.dir",
        "users.cel",
        "users.fecnac",
        "users.fecin",
        "users.email",
        "rols.idrol", 
        DB::raw("rols.name as nomrol"), 
        DB::raw("ambientes.idambiente as idu"),
        DB::raw("ambientes.nomambiente as nomuni"),
        )
        ->join("rols","rols.idrol","=","users.idrol")
        ->join("ambientes","ambientes.idambiente","=","users.idu")
        ->where('users.activo',1)
        ->where('rols.activo',1)
        ->where('ambientes.activo',1)
        ->orderBy('users.id')
        ->paginate(10);  
        $roles= Rol::where('rols.activo',1) 
        ->get();  

        // $unidades= Unidad::where('unidads.activo',1) 
        // ->get();  
        $unidades= Ambiente::where('ambientes.activo',1)->orderBy('ambientes.nomambiente')  
        ->get(); 

        return Inertia::render('Profile/Users', [
            'menus' => $listamenus->Getmenus($request->touch),
            'users' => $users,
            'roles' => $roles,
            'unidades' => $unidades,
            'status' => session('status'),
        ]);
    }
    public function index(Request $request)
    {  
 
        $listamenus = new Menulist; 

        $users= User::select("users.id", 
        DB::raw("CONCAT(users.name,' ',users.ap,' ',users.am) as full_name"),
        "users.name",
        "users.ap",
        "users.am",
        "users.ci",
        "users.dir",
        "users.cel",
        "users.fecnac",
        "users.fecin",
        "users.email",
        "rols.idrol", 
        DB::raw("rols.name as nomrol"),
        DB::raw("ambientes.idambiente as idu"),
        DB::raw("ambientes.nomambiente as nomuni"),
        )
        ->join("rols","rols.idrol","=","users.idrol")
        ->join("ambientes","ambientes.idambiente","=","users.idu")
        ->where('users.activo',1)
        ->where('rols.activo',1)
        ->where('ambientes.activo',1)
        ->orderBy('users.id')
        ->paginate(10);  
        $roles= Rol::where('rols.activo',1) 
        ->get();  

        // $unidades= Unidad::where('unidads.activo',1) 
        // ->get();  
        $unidades= Ambiente::where('ambientes.activo',1)->orderBy('ambientes.nomambiente')  
        ->get(); 

        return Inertia::render('Profile/Users', [
            'menus' => $listamenus->Getmenus('0-0-0'),
            'users' => $users,
            'roles' => $roles,
            'unidades' => $unidades,
            'status' => session('status'),
        ]);
    }
}
