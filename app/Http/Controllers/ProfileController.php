<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function saveProfile(Request $request)
    {
        $profile = Profile::where('user_id', $request['user_id'])->update([
            'full_name' => $request['full_name'],
            'ecode' => $request['ecode']
        ]);

        return response()->json([
            'message' => "Profile has been updated"
        ], 200);
    }
}
