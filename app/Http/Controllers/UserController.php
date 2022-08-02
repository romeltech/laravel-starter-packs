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
        /**
         * Get the user object
         */
        if(!Auth::guest()){
            $user = auth()->user()->load(['profile']); // add the related model here}
        }
        return response()->json([
            'user' => isset($user) ? $user : null,
        ], 200);
    }

    public function getAllUsers()
    {
        // Fetch All Users
        $users = User::with('profile')->get();
        return response()->json($users, 200);
    }

    public function getSingleUser($id)
    {
        $user = User::where('id', $id)->with('profile')->firstOrFail();
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
            'account_phone' => $request['account_phone'],
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
            $user->profile()->create([
                'full_name' => $request['full_name'],
                'ecode' => $request['ecode'],
            ]);
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
