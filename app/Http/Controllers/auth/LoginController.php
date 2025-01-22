<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\auth\LoginRequest;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }
    
    public function login(LoginRequest $request){
        $credentials = $request->validated();
        if (!Auth::validate($credentials)) {
            return redirect()->to('/login');
        }

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);
/*
        $user = Auth::user();


        if ($user && $user->role) {
            $userPermissions = $user->role->permissions->pluck('id');

            $routerConditions = [
                'mozo' => [5, 6],
            ];

            foreach ($routerConditions as $route => $requiredPermissions) {
                if ($userPermissions->intersect($requiredPermissions)->isNotEmpty()) {
                    return redirect()->route($route);
                }
            }
            return redirect('/user');

       
        } else {
            return redirect('/user');

        }
*/
        return redirect()->route('home');
    }
    public function logOut(){
            
        Auth::logout();
        return redirect('/login')->with('status', 'Sesión cerrada correctamente.');

    }
    
}
