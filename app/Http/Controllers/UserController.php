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

    public function getAllUsers()
    {
        // Fetch All Users
        $users = User::all();
        return response()->json($users, 200);
    }

    public function getSingleUser($id)
    {
        $user = User::where('id', $id)->firstOrFail();
        return response()->json($user, 200);
    }

    public function updateUserStatus(Request $request)
    {
        $user = User::where('id', $request['id'])->update(['status' => $request['status']]);
        return response()->json($user, 200);
    }
}
