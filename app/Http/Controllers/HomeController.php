<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ambulance;

class HomeController extends Controller
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
    public function index()
    {
        $user = Auth::user();
        $driver_name = $user->name;
        $driver_id = $user->id;

        $ambulance = Ambulance::where('driver_id', $driver_id)->get();
        $status = $ambulance[0]['status'];

        return view('home', compact('driver_name', 'status'));
    }

    public function changeMode()
    {
        $user = Auth::user();
        $driver_id = $user->id;

        $ambulance = Ambulance::where('driver_id', $driver_id)->get();
        $ambulance_id = $ambulance[0]['id'];

        $assigned_ambulance = Ambulance::findOrFail($ambulance_id);

        $assigned_ambulance->update(['status' => 0]);

        return redirect()->route('home');
    }
}
