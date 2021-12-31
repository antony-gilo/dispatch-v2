<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLocationRequest;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DispatcherLocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        $user = Auth::user();
        $locations = Location::all();
        return view('dispatcher.location.index', compact('user', 'users', 'locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::all();
        $user = Auth::user();
        return view('dispatcher.location.create', compact('user', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLocationRequest $request)
    {
        //
        $location_details = $request->all();
        $coordinates = explode(",", $location_details['co-ordinates']);

        $location_details['latitude'] = trim($coordinates[0]);
        $location_details['longitude'] = trim($coordinates[1]);

        Location::create($location_details);
        return redirect()->route('dispatcher.location.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $location = Location::findOrFail($id);
        $users = User::all();
        $user = Auth::user();

        return view('dispatcher.location.show', compact('location', 'users', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $location = Location::findOrFail($id);
        $users = User::all();
        $user = Auth::user();

        return view('dispatcher.location.edit', compact('location', 'users', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $location = Location::findOrFail($id);

        if (trim($request['co-ordinates']) == '') {
            $location_details = $request->except('co-ordinates');
        } else {
            $location_details = $request->all();
        }

        $coordinates = explode(",", $location_details['co-ordinates']);

        $location_details['latitude'] = trim($coordinates[0]);
        $location_details['longitude'] = trim($coordinates[1]);

        $location->update($location_details);
        return redirect()->route('dispatcher.location.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $location = Location::findOrFail($id);
        $location->delete();

        return redirect()->route('dispatcher.location.index');
    }
}
