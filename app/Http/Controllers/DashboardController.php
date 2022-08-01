<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        return view('layouts.dashboard');
    }

    public function home()
    {
        $role = Auth::user()->role;
        if($role == 'admin' || $role == 'editor'){
            return redirect('d/users');
        }else{
            // other roles
        }
    }
}
