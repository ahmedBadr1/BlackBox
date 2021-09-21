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

Route::group(['prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ],['middleware'=>['auth']]], function()
{

    Route::get('/', function (){
        return view('home');
    })->name('home');
    Route::get('/track', [App\Http\Controllers\HomeController::class, 'track']);
    Route::post('/track', [App\Http\Controllers\HomeController::class, 'trackgo'])->name('track');

    Route::get('/auth/redirect', function () {
         return Socialite::driver('google')
            ->with(['hd' => 'www.bagyexpress.com'])
            ->redirect();
    });

    Auth::routes();

    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/

        Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [App\Http\Controllers\DashboardController::class, 'profile'])->name('profile');
        Route::get('/profile/edit', [App\Http\Controllers\DashboardController::class, 'profileEdit'])->name('profile.edit');
        Route::put('/profile/', [App\Http\Controllers\DashboardController::class, 'profileUpdate'])->name('profile.update');
        Route::get('/sellers', [App\Http\Controllers\DashboardController::class, 'sellers'])->name('sellers');


        Route::get('/mybalance', [App\Http\Controllers\OrdersController::class, 'mybalance'])->name('mybalance');
        Route::get('/states', [App\Http\Controllers\AreaController::class, 'states'])->name('states');
        Route::post('/states/toggle/{id}', [\App\Http\Controllers\AreaController::class,'toggle']);
        Route::get('/export/orders/en', [App\Http\Controllers\ExcelController::class,'exportOrdersEN'])->name('export.orders.en');
        Route::get('/export/orders/ar', [App\Http\Controllers\ExcelController::class,'exportOrdersAR'])->name('export.orders.ar');

        Route::get('roles/permissions',[\App\Http\Controllers\RolesController::class,'permissions'])->name('roles.permissions');
        Route::post('roles/permissions',[\App\Http\Controllers\RolesController::class,'permissionsCreate']);
        Route::delete('permission/delete/{id}',[\App\Http\Controllers\RolesController::class,'permissionsDelete'])->name('permission.delete');

        Route::get('branches/assign/{id}',[\App\Http\Controllers\BranchController::class,'assign'])->name('branches.assign');
        Route::post('branches/assign/{id}',[\App\Http\Controllers\BranchController::class,'assignGo'])->name('branches.assign');

        Route::get('orders/assign',[\App\Http\Controllers\OrdersController::class,'assign'])->name('orders.assign');
        Route::post('orders/assign',[\App\Http\Controllers\OrdersController::class,'assignGo'])->name('orders.assign');

    Route::get('my-orders',[\App\Http\Controllers\DeliveryController::class,'myorders'])->name('myorders');
    Route::get('orders/status/{id}',[\App\Http\Controllers\DeliveryController::class,'status'])->name('orders.status');
    Route::post('orders/status/{id}/change',[\App\Http\Controllers\DeliveryController::class,'changeStatus'])->name('orders.changeStatus');

        Route::resource('users',\App\Http\Controllers\UserController::class);
        Route::resource('roles',\App\Http\Controllers\RolesController::class);
        Route::resource('branches',\App\Http\Controllers\BranchController::class);
        Route::resource('areas',\App\Http\Controllers\AreaController::class);
        Route::resource('zones',\App\Http\Controllers\ZoneController::class);
        Route::resource('orders',\App\Http\Controllers\OrdersController::class);
        Route::resource('receipts', App\Http\Controllers\ReceiptController::class);

        Route::get('/e', [App\Http\Controllers\MailController::class, 'index'])->name('email');
        Route::post('/e/s', [App\Http\Controllers\MailController::class, 'send'])->name('email.send');
        Route::post('/e', [App\Http\Controllers\MailController::class, 'index'])->name('emailto');
        Route::get('/welcome-email', [App\Http\Controllers\MailController::class, 'welcomeMail'])->name('welcome.email');

    });



