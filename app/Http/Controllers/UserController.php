<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
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

    public function saveUserData(Request $request)
    {
        $resStatus = 200;
        $arrDetail = array();
        if(isset($request['id'])){
            if(isset($request['email'])){
                $arrDetail = array(
                    'email' => $request['email'],
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                    'phone' => $request['phone'],
                    'role' => $request['role'],
                    'status' => $request['status']
                );
            }else{
                $arrDetail = array(
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                    'phone' => $request['phone'],
                    'role' => $request['role'],
                    'status' => $request['status'],
                );
            }
            $user = User::where('id', $request['id'])->first();
            $user->update($arrDetail);
            $msg = "User has been updated";
        }else{
            $password = bcrypt(Str::random());
            $arrDetail = array(
                'email' => $request['email'],
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'password' => $password,
                'phone' => $request['phone'],
                'role' => $request['role'],
                'status' => 'active',
            );
            $users = User::create($arrDetail);
            $msg = "User has been added";
        }
        return response()->json([
            'message' => $msg
        ], $resStatus);
    }

    public function checkEmail(Request $request)
    {
        $user = User::where('email', $request['email'])->first();
        return response()->json([
            'type' => gettype($user),
            'email_existed' => isset($user->email) ? true : false
        ], 200);
    }
}
