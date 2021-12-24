<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ambulance;
use App\Models\Dispatch;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SupervisorRedirectController extends Controller
{
    public function __construct()
    {
        $this->middleware('supervisor');
    }

    public function index()
    {
        $users = User::all();
        $user = Auth::user();
        $drivers = User::where('role_id', 3)->count();
        $dispatchers = User::where('role_id', [1, 2])->count();

        $ambulances = Ambulance::all();
        $on_duty = $ambulances->where('status', 1)->count();
        $stand_by = $ambulances->where('status', 0)->count();

        $dispatches = Dispatch::all()->count();
        $current_month = Carbon::now()->month();
        $monthly_dispatch = Dispatch::whereMonth('created_at', '=', $current_month)->get()->count();

        $locations = Location::all();

        return view('supervisor.index', compact('users', 'user', 'ambulances', 'dispatches', 'monthly_dispatch', 'stand_by', 'on_duty', 'drivers', 'dispatchers', 'locations'));
    }
}
