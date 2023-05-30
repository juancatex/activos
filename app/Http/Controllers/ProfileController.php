<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function show(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'menus' => array( 
                array(
                "id"=> "1",
                "grupo"=> "Persona",
                "lista"=>array(
                            array(
                            "id"=> "1",
                            "menu"=>"Dasboard",
                            "routes"=>array(
                                     array(
                                        "id"=> "1",
                                        "nombre"=>"dashboard",
                                        "route"=>"dashboard"  
                                        ) ,
                                    array(
                                        "id"=> "2",
                                        "nombre"=>"profile",
                                        "route"=>"profile.edit"  
                                        ) 
                                     ) 
                                ), 
                            array(
                                "id"=> "2",
                                "menu"=>"Dasboard2",
                                "routes"=>array(
                                            array(
                                            "id"=> "1",
                                            "nombre"=>"dashboard2",
                                            "route"=>"dashboard"  
                                            ) ,
                                        array(
                                            "id"=> "2",
                                            "nombre"=>"profile2",
                                            "route"=>"profile.edit"  
                                            ) 
                                            ) 
                                ), 
                        )
               ),
               array(
                "id"=> "2",
                "grupo"=> "Persona2",
                "lista"=>array(
                            array(
                            "id"=> "1",
                            "menu"=>"Dasboard",
                            "routes"=>array(
                                     array(
                                        "id"=> "1",
                                        "nombre"=>"dashboard",
                                        "route"=>"dashboard"  
                                        ) ,
                                    array(
                                        "id"=> "2",
                                        "nombre"=>"profile",
                                        "route"=>"profile.edit"  
                                        ) 
                                     ) 
                                ), 
                            array(
                                "id"=> "2",
                                "menu"=>"Dasboard2",
                                "routes"=>array(
                                            array(
                                            "id"=> "1",
                                            "nombre"=>"dashboard2",
                                            "route"=>"dashboard"  
                                            ) ,
                                        array(
                                            "id"=> "2",
                                            "nombre"=>"profile2",
                                            "route"=>"profile.edit"  
                                            ) 
                                            ) 
                                ), 
                        )
               ),  
        ),
'status' => session('status'),
        ]);
    }
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
