<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getAuthenticatedUser()
    {
        $access = "";
        if(Auth::guest()){
            $access = "guest";
        }else{
            $user = User::where('id', auth()->user()->id)->first();

            if(isset($user)){
                if($user->role == 'admin'){
                    $access = "admin";
                }else{
                    $access = "employee";
                }
            }
        }
        return response()->json([
            'user' => isset($user) ? $user : null,
            'user_access' => $access,
        ], 200);
    }
}
