<?php

use Illuminate\Support\Facades\Route;

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
    return view('home');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware'=>['auth']],function (){
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [App\Http\Controllers\DashboardController::class, 'profile'])->name('profile');
    Route::get('/clients', [App\Http\Controllers\DashboardController::class, 'clients'])->name('clients');

    Route::get('roles/permissions',[\App\Http\Controllers\RolesController::class,'permissions'])->name('roles.permissions');
    Route::post('roles/permissions',[\App\Http\Controllers\RolesController::class,'permissionsCreate']);
    Route::delete('permission/delete/{id}',[\App\Http\Controllers\RolesController::class,'permissionsDelete'])->name('permission.delete');

    Route::resource('users',\App\Http\Controllers\UserController::class);
    Route::resource('roles',\App\Http\Controllers\RolesController::class);
    Route::resource('areas',\App\Http\Controllers\AreaController::class);
    Route::post('/areas/add-zone',[\App\Http\Controllers\AreaController::class,'addzone'])->name('areas.add-zone');


    Route::get('/e', [App\Http\Controllers\MailController::class, 'index'])->name('email');
    Route::post('/e/s', [App\Http\Controllers\MailController::class, 'send'])->name('email.send');
    Route::post('/e', [App\Http\Controllers\MailController::class, 'index'])->name('emailto');
    Route::get('/welcome-email', [App\Http\Controllers\MailController::class, 'welcomeMail'])->name('welcome.email');


});
