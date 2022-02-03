<?php

use App\Models\Dispatch;
use App\Models\Location;
use App\Models\Ambulance;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomLoginController;
use App\Http\Controllers\DispatcherMediaController;
use App\Http\Controllers\SupervisorMediaController;
use App\Http\Controllers\SupervisorUsersController;
use App\Http\Controllers\DispatchAmbulanceController;
use App\Http\Controllers\DispatcherRedirectController;
use App\Http\Controllers\SupervisorRedirectController;
use App\Http\Controllers\DispatcherAmbulanceController;
use App\Http\Controllers\DispatcherLocationsController;
use App\Http\Controllers\SupervisorAmbulanceController;
use App\Http\Controllers\SupervisorLocationsController;
use App\Http\Controllers\DispatcherDispatchAmbulanceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::post('/login/custom', [CustomLoginController::class, 'login'])->name('login.custom');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/home/change-status', [HomeController::class, 'changeMode'])->name('ambulance.status');
    Route::get('/supervisor', [SupervisorRedirectController::class, 'index'])->name('supervisor.index');
    Route::resource('/supervisor/media', SupervisorMediaController::class, ['as' => 'supervisor']);
    Route::resource('/supervisor/users', SupervisorUsersController::class, ['as' => 'supervisor']);
    Route::resource('/supervisor/ambulance', SupervisorAmbulanceController::class, ['as' => 'supervisor']);
    Route::resource('/supervisor/location', SupervisorLocationsController::class, ['as' => 'supervisor']);
    Route::resource('/supervisor/dispatch-ambulance', DispatchAmbulanceController::class);

    Route::get('/dispatcher', [DispatcherRedirectController::class, 'index'])->name('dispatcher.index');
    Route::resource('/dispatcher/ambulance', DispatcherAmbulanceController::class, ['as' => 'dispatcher']);
    Route::resource('/dispatcher/location', DispatcherLocationsController::class, ['as' => 'dispatcher']);
    Route::resource('/dispatcher/media', DispatcherMediaController::class, ['as' => 'dispatcher']);
    Route::resource('/dispatcher/dispatch-ambulance', DispatcherDispatchAmbulanceController::class, ['as' => 'dispatcher']);
});


Route::middleware(['supervisor'])->group(function () {

    Route::get('/supervisor', [SupervisorRedirectController::class, 'index'])->name('supervisor.index');
    // EMAIL NOTIFICATIONS ROUTE
    Route::get('/supervisor/emails/{insert_id}/dispatch-notification', function ($insert_id) {

        $GLOBALS['dispatch'] = Dispatch::findOrFail($insert_id);
        $GLOBALS['ambulance'] = Ambulance::findOrFail($GLOBALS['dispatch']->ambulance_id);

        $GLOBALS['location'] = $GLOBALS['dispatch']->location_id;
        $GLOBALS['preferred_hospital'] = Location::findOrFail($GLOBALS['location'])->hospital;
        $GLOBALS['caller_name'] = $GLOBALS['dispatch']->name;
        $GLOBALS['driver_name'] = $GLOBALS['ambulance']->driver->name;
        $GLOBALS['driver_email'] = $GLOBALS['ambulance']->driver->email;
        $GLOBALS['victim_name'] = $GLOBALS['dispatch']->victim_name;
        $GLOBALS['caller_phone'] = $GLOBALS['dispatch']->caller_phone;

        $GLOBALS['dispatch_info'] = [
            'title' => 'AMBULANCE DISPATCH NOTIFICATION',
            'driver_name' => $GLOBALS['driver_name'],
            'driver_email' => $GLOBALS['driver_email'],
            'victim_name' => $GLOBALS['victim_name'],
            'preferred_hospital' => $GLOBALS['preferred_hospital'],
            'caller_name' => $GLOBALS['caller_name'],
            'caller_phone' => $GLOBALS['caller_phone'],
        ];

        Mail::send('supervisor.emails.dispatch-notification', $GLOBALS['dispatch_info'], function ($message) {

            $dispatch_info = [
                'title' => 'AMBULANCE DISPATCH NOTIFICATION',
                'driver_name' => $GLOBALS['driver_name'],
                'driver_email' => $GLOBALS['driver_email'],
                'victim_name' => $GLOBALS['victim_name'],
                'preferred_hospital' => $GLOBALS['preferred_hospital'],
                'caller_name' => $GLOBALS['caller_name'],
                'caller_phone' => $GLOBALS['caller_phone'],
            ];

            $driver_email = $dispatch_info['driver_email'];
            $driver_name = $dispatch_info['driver_name'];

            $message->to($driver_email, $driver_name);
            $message->subject('[st.john-ambulance] EMERGENCY NOTIFICATION');
        });

        return view('supervisor.emails.dispatch-notification', $GLOBALS['dispatch_info']);
    })->name('supervisor.dispatch-notification');
});

Route::middleware(['dispatcher'])->group(function () {

    Route::get('/dispatcher', [DispatcherRedirectController::class, 'index'])->name('dispatcher.index');
    Route::resource('/dispatcher/ambulance', DispatcherAmbulanceController::class, ['as' => 'dispatcher']);
    // EMAIL NOTIFICATIONS ROUTE
    Route::get('/dispatcher/emails/{insert_id}/dispatch-notification', function ($insert_id) {

        $GLOBALS['dispatch'] = Dispatch::findOrFail($insert_id);
        $GLOBALS['ambulance'] = Ambulance::findOrFail($GLOBALS['dispatch']->ambulance_id);

        $GLOBALS['location'] = $GLOBALS['dispatch']->location_id;
        $GLOBALS['preferred_hospital'] = Location::findOrFail($GLOBALS['location'])->hospital;
        $GLOBALS['caller_name'] = $GLOBALS['dispatch']->name;
        $GLOBALS['driver_name'] = $GLOBALS['ambulance']->driver->name;
        $GLOBALS['driver_email'] = $GLOBALS['ambulance']->driver->email;
        $GLOBALS['victim_name'] = $GLOBALS['dispatch']->victim_name;
        $GLOBALS['caller_phone'] = $GLOBALS['dispatch']->caller_phone;

        $GLOBALS['dispatch_info'] = [
            'title' => 'AMBULANCE DISPATCH NOTIFICATION',
            'driver_name' => $GLOBALS['driver_name'],
            'driver_email' => $GLOBALS['driver_email'],
            'victim_name' => $GLOBALS['victim_name'],
            'preferred_hospital' => $GLOBALS['preferred_hospital'],
            'caller_name' => $GLOBALS['caller_name'],
            'caller_phone' => $GLOBALS['caller_phone'],
        ];

        Mail::send('dispatcher.emails.dispatch-notification', $GLOBALS['dispatch_info'], function ($message) {

            $dispatch_info = [
                'title' => 'AMBULANCE DISPATCH NOTIFICATION',
                'driver_name' => $GLOBALS['driver_name'],
                'driver_email' => $GLOBALS['driver_email'],
                'victim_name' => $GLOBALS['victim_name'],
                'preferred_hospital' => $GLOBALS['preferred_hospital'],
                'caller_name' => $GLOBALS['caller_name'],
                'caller_phone' => $GLOBALS['caller_phone'],
            ];

            $driver_email = $dispatch_info['driver_email'];
            $driver_name = $dispatch_info['driver_name'];

            $message->to($driver_email, $driver_name);
            $message->subject('[st.john-ambulance] EMERGENCY NOTIFICATION');
        });

        return view('dispatcher.emails.dispatch-notification', $GLOBALS['dispatch_info']);
    })->name('dispatcher.dispatch-notification');
});
