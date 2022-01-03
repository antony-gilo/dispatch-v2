<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Ambulance;
use App\Models\Dispatch;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DispatcherRedirectController extends Controller
{
    public function __construct()
    {
        $this->middleware(['dispatcher', 'auth']);
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

        $dispatches = Dispatch::all();
        $dispatches_count = Dispatch::all()->count();
        $current_month = Carbon::now()->month();
        $monthly_dispatch = Dispatch::whereMonth('created_at', '=', $current_month)->get()->count();

        $locations = Location::all();
        $common_location = DB::table('dispatches')
            ->select('location_id', DB::raw('COUNT(location_id) as count'))
            ->groupBy('location_id')
            ->orderBy('count')
            ->get();

        if ($common_location !== null) {

            foreach ($common_location as $location) {
                $hospital_id = $location->location_id;
            }

            $common_hospital = Location::findOrFail($hospital_id)->hospital;
        }

        $dispatch_percentage = $monthly_dispatch / $dispatches_count * 100;
        $dispatch_percentage = number_format((float)$dispatch_percentage, 2, '.', '');


        return view('supervisor.index', compact('users', 'user', 'ambulances', 'dispatches', 'dispatches_count', 'monthly_dispatch', 'stand_by', 'on_duty', 'drivers', 'dispatchers', 'locations', 'common_hospital', 'dispatch_percentage'));
    }
}
