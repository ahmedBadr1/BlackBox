<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:dashboard');
    }

    /**
     * Show the application dashboard.
     *
     * @return View
     */
    public function index()
    {

        return view('dashboard');
    }
    public function dashboard()
    {
        $this->middleware('permission:dashboard');
        $users = User::all();
        $areas = Area::all();

        return view('dashboard', compact('users','areas'));
    }

    public function profile()
    {
        $user = Auth::user();

        return view('profile', compact('user'));
    }

    public function clients()
    {
        $clients =Role::where('name', 'client')->first()->users()->get();

        return view('admin.clients', compact('clients'));
    }
}
