<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $msg = "";

        // Validate username and email for duplicate
        $validated = $request->validate([
            'username' => 'unique:users,username,'.$request['id'],
            'email' => 'unique:users,email,'.$request['id'],
            'password' => 'sometimes|confirmed|min:9',
        ]);

        // Setup array
        $arrDetail = array(
            'password' => bcrypt($request['password']),
            'username' => $request['username'],
            'email' => $request['email'],
            'full_name' => $request['full_name'],
            'phone' => $request['phone'],
            'role' => $request['role'],
            'status' => $request['status'],
        );

        if(isset($request['id'])){
            // update user if has ID
            array_splice($arrDetail, 0, 1); // remove password
            $user = User::where('id', $request['id'])->update($arrDetail);
            $msg = "User has been updated";
        }else{
            // create user
            array_merge($arrDetail, array('password' => bcrypt($request['password'])));
            // array_merge($arrDetail, array('password' => Hash::make($request['password'])));
            array_values($arrDetail);
            $user = User::create($arrDetail);
            $msg = "User has been created";
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

    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'password' => 'required|confirmed|min:9',
        ]);
        $user = User::where('id', $request['id'])->first();
        if($user){
            $user->update([
                'password' => Hash::make($request['password'])
            ]);
        }
        return response()->json([
            'message' => "Password has been updated"
        ], 200);
    }
}
