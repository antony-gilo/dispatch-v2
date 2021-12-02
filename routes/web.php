<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\CustomLoginController;
use App\Http\Controllers\SupervisorMediaController;
use App\Http\Controllers\SupervisorUsersController;
use App\Http\Controllers\DispatchAmbulanceController;
use App\Http\Controllers\DispatcherRedirectController;
use App\Http\Controllers\SupervisorRedirectController;
use App\Http\Controllers\SupervisorAmbulanceController;
use App\Http\Controllers\SupervisorLocationsController;

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
    Route::get('/supervisor', [SupervisorRedirectController::class, 'index'])->name('supervisor.index');
    Route::get('/dispatcher', [DispatcherRedirectController::class, 'index'])->name('dispatcher.index');
    Route::resource('/supervisor/media', SupervisorMediaController::class);
    Route::resource('/supervisor/users', SupervisorUsersController::class);
    Route::resource('/supervisor/ambulance', SupervisorAmbulanceController::class);
    Route::resource('/supervisor/location', SupervisorLocationsController::class);
    Route::resource('/dispatch-ambulance', DispatchAmbulanceController::class);
});


Route::middleware(['supervisor'])->group(function () {

    Route::get('/supervisor', [SupervisorRedirectController::class, 'index'])->name('supervisor.index');
    // EMAIL NOTIFICATIONS ROUTE
    Route::get('/supervisor/emails/dispatch-notification', function () {

        $driver_email = session('driver_email');
        $driver_name = session('driver_name');
        $victim_name = session('victim_name');
        $preferred_hospital = session('preferred_hospital');
        $caller_name = session('caller_name');
        $caller_phone = session('caller_phone');

        $dispatch_info = [
            'title' => 'AMBULANCE DISPATCH NOTIFICATION',
            'driver_name' => $driver_name,
            'driver_email' => $driver_email,
            'victim_name' => $victim_name,
            'preferred_hospital' => $preferred_hospital,
            'caller_name' => $caller_name,
            'caller_phone' => $caller_phone,
        ];

        Mail::send('supervisor.emails.dispatch-notification', $dispatch_info, function ($message) {

            $driver_email = session('driver_email');
            $driver_name = session('driver_name');

            $message->to($driver_email, $driver_name);
            $message->subject('[dispatch.io] EMERGENCY NOTIFICATION');
        });

        return view('supervisor.emails.dispatch-notification', $dispatch_info);
    })->name('dispatch-notification');
});

Route::middleware(['dispatcher'])->group(function () {
    Route::get('/dispatcher', [DispatcherRedirectController::class, 'index'])->name('dispatcher.index');
});
