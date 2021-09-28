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
        Route::get('/trash', [App\Http\Controllers\DashboardController::class, 'trash'])->name('trash');



        Route::get('/states', [App\Http\Controllers\Admin\AreaController::class, 'states'])->name('states');
        Route::post('/states/toggle/{id}', [\App\Http\Controllers\Admin\AreaController::class,'toggle']);
        Route::get('/export/orders/en', [App\Http\Controllers\ExcelController::class,'exportOrdersEN'])->name('export.orders.en');
        Route::get('/export/orders/ar', [App\Http\Controllers\ExcelController::class,'exportOrdersAR'])->name('export.orders.ar');
    Route::post('/import/orders', [App\Http\Controllers\ExcelController::class,'importOrders'])->name('import.orders');

        Route::get('roles/permissions',[\App\Http\Controllers\Admin\RolesController::class,'permissions'])->name('roles.permissions');
        Route::post('roles/permissions',[\App\Http\Controllers\Admin\RolesController::class,'permissionsCreate']);
        Route::delete('permission/delete/{id}',[\App\Http\Controllers\Admin\RolesController::class,'permissionsDelete'])->name('permission.delete');

        Route::get('branches/assign/{id}',[\App\Http\Controllers\Admin\BranchController::class,'assign'])->name('branches.assign');
        Route::post('branches/assign/{id}',[\App\Http\Controllers\Admin\BranchController::class,'assignGo'])->name('branches.assign');

        Route::get('orders/assign',[\App\Http\Controllers\DashboardController::class,'assign'])->name('orders.assign');
        Route::post('orders/assign',[\App\Http\Controllers\DashboardController::class,'assignGo'])->name('orders.assign');

    Route::get('tasks/archive',[\App\Http\Controllers\TaskController::class,'archive'])->name('tasks.archive');
    Route::post('tasks/{id}/done',[\App\Http\Controllers\TaskController::class,'done'])->name('tasks.done');
    Route::post('tasks/{id}/undone',[\App\Http\Controllers\TaskController::class,'undone'])->name('tasks.undone');
    Route::get('tasks/assign',[\App\Http\Controllers\TaskController::class,'assign'])->name('tasks.assign');
    Route::post('tasks/assign',[\App\Http\Controllers\TaskController::class,'assignGo'])->name('tasks.assign');
    Route::get('tasks/trash',[\App\Http\Controllers\TaskController::class,'trash'])->name('tasks.trash');

    Route::get('orders/trash',[\App\Http\Controllers\OrdersController::class,'trash'])->name('orders.trash');

    Route::get('inventory',[\App\Http\Controllers\SellerController::class,'inventory'])->name('orders.inventory');
    Route::get('orders/inline',[\App\Http\Controllers\SellerController::class,'inline'])->name('orders.inline');
    Route::post('orders/inline/{id}',[\App\Http\Controllers\SellerController::class,'inlinego'])->name('orders.inlinego');
    Route::post('orders/wait/{id}',[\App\Http\Controllers\SellerController::class,'wait'])->name('orders.wait');
    Route::post('orders/pickup',[\App\Http\Controllers\SellerController::class,'pickup'])->name('orders.pickup');
    Route::get('/mybalance', [App\Http\Controllers\SellerController::class, 'mybalance'])->name('mybalance');
    Route::get('myorders',[\App\Http\Controllers\SellerController::class,'myorders']);


    Route::get('my-orders',[\App\Http\Controllers\DeliveryController::class,'myorders'])->name('myorders');
    Route::get('my-tasks',[\App\Http\Controllers\DeliveryController::class,'mytasks'])->name('my-tasks');

    Route::get('orders/status/{id}',[\App\Http\Controllers\DeliveryController::class,'status'])->name('orders.status');
    Route::post('orders/status/{id}/change',[\App\Http\Controllers\DeliveryController::class,'changeStatus'])->name('orders.changeStatus');



        Route::resource('users',\App\Http\Controllers\Admin\UserController::class);
        Route::resource('roles',\App\Http\Controllers\Admin\RolesController::class);
        Route::resource('branches',\App\Http\Controllers\Admin\BranchController::class);
        Route::resource('areas',\App\Http\Controllers\Admin\AreaController::class);
        Route::resource('zones',\App\Http\Controllers\Admin\ZoneController::class);
        Route::resource('orders',\App\Http\Controllers\OrdersController::class);
        Route::resource('receipts', App\Http\Controllers\ReceiptController::class);
        Route::resource('tasks', App\Http\Controllers\TaskController::class);

        Route::get('/e', [App\Http\Controllers\Admin\MailController::class, 'index'])->name('email');
        Route::post('/e/s', [App\Http\Controllers\Admin\MailController::class, 'send'])->name('email.send');
        Route::post('/e', [App\Http\Controllers\Admin\MailController::class, 'index'])->name('emailto');
        Route::get('/welcome-email', [App\Http\Controllers\Admin\MailController::class, 'welcomeMail'])->name('welcome.email');

    });



