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
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function()
{
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::get('/', function (){
        return view('main.home');
    })->name('home');
    Route::get('/track', [\App\Http\Controllers\Main\HomeController::class, 'track']);
    Route::post('/track', [\App\Http\Controllers\Main\HomeController::class, 'trackgo'])->name('track');



    Route::get('/auth/redirect', function () {
         return Socialite::driver('google')
            ->with(['hd' => 'www.bagyexpress.com'])
            ->redirect();
    });

    Auth::routes(['verify' => true]);


    Route::group(['middleware'=>['auth','verified','IsActive']],function (){

        Route::get('/dashboard', function () {
            if (auth()->user()->hasRole('seller')){
                return redirect()->route('seller.dashboard');
            }elseif(auth()->user()->hasRole('delivery')){
                return redirect()->route('delivery.dashboard');
            }else{
                return redirect()->route('admin.dashboard');
            }
        })->name('dashboard');
        Route::group([
            'middleware' => ['role:seller']
        ], function () {
        Route::get('home',[\App\Http\Controllers\Seller\DashboardController::class,'index'])->name('seller.dashboard');
        Route::get('help', [App\Http\Controllers\Admin\DashboardController::class, 'help'])->name('help');
        Route::get('notifications', [App\Http\Controllers\Admin\DashboardController::class, 'notifications'])->name('notifications');
        Route::get('profile', [App\Http\Controllers\Seller\DashboardController::class, 'profile'])->name('profile');
        Route::get('profile/edit', [App\Http\Controllers\Seller\DashboardController::class, 'profileEdit'])->name('profile.edit');
            Route::put('profile/', [App\Http\Controllers\Seller\DashboardController::class, 'profileUpdate'])->name('profile.update');
        Route::get('inventory',[\App\Http\Controllers\Seller\SellerController::class,'inventory'])->name('orders.inventory');
        Route::get('orders/inline',[\App\Http\Controllers\Seller\SellerController::class,'inline'])->name('orders.inline');
        Route::post('orders/inline/{id}',[\App\Http\Controllers\Seller\SellerController::class,'inlinego'])->name('orders.inlinego');
        Route::post('orders/wait/{id}',[\App\Http\Controllers\Seller\SellerController::class,'wait'])->name('orders.wait');
        Route::post('orders/pickup',[\App\Http\Controllers\Seller\TaskController::class,'pickup'])->name('orders.pickup');
        Route::get('/mybalance', [\App\Http\Controllers\Seller\DashboardController::class, 'mybalance'])->name('mybalance');
        Route::get('myorders',[\App\Http\Controllers\Seller\OrdersController::class,'myorders']);
        Route::get('mytrash',[\App\Http\Controllers\Seller\OrdersController::class,'mytrash']);
        Route::get('/export/orders/en', [App\Http\Controllers\Main\ExcelController::class,'exportOrdersEN'])->name('export.orders.en');
        Route::get('/export/orders/ar', [App\Http\Controllers\Main\ExcelController::class,'exportOrdersAR'])->name('export.orders.ar');
        Route::post('/import/orders', [App\Http\Controllers\Main\ExcelController::class,'importOrders'])->name('import.orders');
        Route::get('areas',[\App\Http\Controllers\Seller\SellerController::class,'areas'])->name('areas');
        Route::get('areas/{id}',[\App\Http\Controllers\Seller\SellerController::class,'areasShow'])->name('areas.show');

            Route::get('branches',[\App\Http\Controllers\Seller\SellerController::class,'branches'])->name('branches');
            Route::get('branches/{id}',[\App\Http\Controllers\Seller\SellerController::class,'branchesShow'])->name('branches.show');
        Route::resource('orders',\App\Http\Controllers\Seller\OrdersController::class);

        }); // end seller group middleware
        Route::group([
            'prefix' => 'admin',
            'as' => 'admin.',
            'middleware' => ['auth']
        ], function () {

            /** ADD ALL auth ROUTES INSIDE THIS GROUP **/
            Route::get('setting', [App\Http\Controllers\Admin\DashboardController::class, 'setting'])->middleware(['role:admin|Feedback'])->name('setting');
            Route::post('/setting', [App\Http\Controllers\Admin\DashboardController::class, 'saveSetting'])->name('setting');
            Route::group(['middleware'=>'System'],function (){
                /** ADD ALL System ROUTES INSIDE THIS GROUP **/

                Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

                Route::get('help', [App\Http\Controllers\Admin\DashboardController::class, 'help'])->name('help');
                Route::get('notifications', [App\Http\Controllers\Admin\DashboardController::class, 'notifications'])->name('notifications');

                Route::get('profile', [App\Http\Controllers\Admin\DashboardController::class, 'profile'])->name('profile');
                Route::get('profile/edit', [App\Http\Controllers\Admin\DashboardController::class, 'profileEdit'])->name('profile.edit');
                Route::put('profile/', [App\Http\Controllers\Admin\DashboardController::class, 'profileUpdate'])->name('profile.update');
                Route::get('sellers', [App\Http\Controllers\Admin\DashboardController::class, 'sellers'])->name('sellers');
                Route::get('trash', [App\Http\Controllers\Admin\DashboardController::class, 'trash'])->name('trash');

                Route::get('financials', [App\Http\Controllers\Admin\FinancialController::class, 'index'])->name('financials');
                Route::get('/invoice', [\App\Http\Controllers\Admin\FinancialController::class, 'invoice']);
                Route::get('statics', [App\Http\Controllers\Admin\StaticsController::class, 'index'])->name('statics');


                Route::get('/states', [App\Http\Controllers\Admin\AreaController::class, 'states'])->name('states');
                Route::post('/states/toggle/{id}', [\App\Http\Controllers\Admin\AreaController::class,'toggle']);
                Route::get('/export/orders/en', [App\Http\Controllers\Main\ExcelController::class,'exportOrdersEN'])->name('export.orders.en');
                Route::get('/export/orders/ar', [App\Http\Controllers\Main\ExcelController::class,'exportOrdersAR'])->name('export.orders.ar');
               Route::post('/import/orders', [App\Http\Controllers\Main\ExcelController::class,'importOrders'])->name('import.orders');
              //  Route::post('/parse/import', [App\Http\Controllers\Main\ExcelController::class,'parseImport'])->name('parse.import');

                Route::get('roles/permissions',[\App\Http\Controllers\Admin\RolesController::class,'permissions'])->name('roles.permissions');
                Route::post('roles/permissions',[\App\Http\Controllers\Admin\RolesController::class,'permissionsCreate']);
                Route::delete('permission/delete/{id}',[\App\Http\Controllers\Admin\RolesController::class,'permissionsDelete'])->name('permission.delete');

                Route::get('branches/assign/{id}',[\App\Http\Controllers\Admin\BranchController::class,'assign'])->name('branches.assign');
                Route::post('branches/assign/{id}',[\App\Http\Controllers\Admin\BranchController::class,'assignGo'])->name('branches.assign');

                Route::get('orders/assign',[\App\Http\Controllers\Admin\DashboardController::class,'assign'])->name('orders.assign');
                Route::post('orders/assign',[\App\Http\Controllers\Admin\DashboardController::class,'assignGo'])->name('orders.assign');
                Route::get('orders/track', [App\Http\Controllers\Admin\OrdersController::class, 'track']);
                Route::post('orders/track', [App\Http\Controllers\Admin\OrdersController::class, 'trackgo'])->name('track');

                Route::get('tasks/archive',[\App\Http\Controllers\Admin\TaskController::class,'archive'])->name('tasks.archive');
                Route::post('tasks/{id}/done',[\App\Http\Controllers\Admin\TaskController::class,'done'])->name('tasks.done');
                Route::post('tasks/{id}/undone',[\App\Http\Controllers\Admin\TaskController::class,'undone'])->name('tasks.undone');
                Route::get('tasks/assign',[\App\Http\Controllers\Admin\TaskController::class,'assign'])->name('tasks.assign');
                Route::post('tasks/assign',[\App\Http\Controllers\Admin\TaskController::class,'assignGo'])->name('tasks.assign');

                Route::get('orders/trash',[\App\Http\Controllers\Admin\OrdersController::class,'trash'])->name('orders.trash');
                Route::get('tasks/trash',[\App\Http\Controllers\Admin\TaskController::class,'trash'])->name('tasks.trash');
                Route::post('orders/{id}/restore', [App\Http\Controllers\Admin\OrdersController::class, 'restore'])->name('orders.restore');
                Route::post('tasks/{id}/restore', [App\Http\Controllers\Admin\TaskController::class, 'restore'])->name('tasks.restore');

                Route::get('/export/orders/en', [App\Http\Controllers\Admin\OrdersController::class,'adminExportOrdersEn'])->name('export.orders.en');
                Route::get('/export/orders/ar', [App\Http\Controllers\Admin\OrdersController::class,'adminExportOrdersAr'])->name('export.orders.ar');
                Route::get('receipts/print',[\App\Http\Controllers\Admin\ReceiptController::class,'print'])->name('receipts.print');

                Route::get('/features',[\App\Http\Controllers\Admin\PlanController::class,'features'])->name('features');
                Route::get('/features/{id}',[\App\Http\Controllers\Admin\PlanController::class,'featuresShow'])->name('features.show');
                Route::get('/packing',[\App\Http\Controllers\Admin\OrdersController::class,'packing'])->name('packing');



            Route::resource('users',\App\Http\Controllers\Admin\UserController::class);
            Route::resource('roles',\App\Http\Controllers\Admin\RolesController::class);
            Route::resource('branches',\App\Http\Controllers\Admin\BranchController::class);
            Route::resource('areas',\App\Http\Controllers\Admin\AreaController::class);
            Route::resource('zones',\App\Http\Controllers\Admin\ZoneController::class);
            Route::resource('orders',\App\Http\Controllers\Admin\OrdersController::class);
            Route::resource('receipts', App\Http\Controllers\Admin\ReceiptController::class);
            Route::resource('tasks', App\Http\Controllers\Admin\TaskController::class);
            Route::resource('plans', App\Http\Controllers\Admin\PlanController::class);
            Route::resource('locations', App\Http\Controllers\Admin\LocationsControllers::class);


            Route::get('/e', [App\Http\Controllers\Admin\MailController::class, 'index'])->name('email');
            Route::post('/e/s', [App\Http\Controllers\Admin\MailController::class, 'send'])->name('email.send');
            Route::post('/e', [App\Http\Controllers\Admin\MailController::class, 'index'])->name('emailto');
            Route::get('/welcome-email', [App\Http\Controllers\Admin\MailController::class, 'welcomeMail'])->name('welcome.email');
            }); // end System group middleware
        }); // end admin group prefix



        Route::group([
            'prefix' => 'delivery',
            'as' => 'delivery.',
            'middleware' => ['role:delivery']
        ], function () {
            Route::get('dashboard',[\App\Http\Controllers\Delivery\DashboardController::class,'index'])->name('dashboard');
            Route::get('profile', [\App\Http\Controllers\Delivery\DashboardController::class, 'profile'])->name('profile');
            Route::get('profile/edit', [\App\Http\Controllers\Delivery\DashboardController::class, 'profileEdit'])->name('profile.edit');
            Route::put('profile/', [\App\Http\Controllers\Delivery\DashboardController::class, 'profileUpdate'])->name('profile.update');
            Route::get('my-orders',[\App\Http\Controllers\Delivery\OrdersController::class,'myorders'])->name('my-orders');
            Route::get('my-tasks',[\App\Http\Controllers\Delivery\OrdersController::class,'mytasks'])->name('my-tasks');
            Route::post('tasks/{id}/done',[\App\Http\Controllers\Delivery\OrdersController::class,'done'])->name('tasks.done');
            Route::post('tasks/{id}/undone',[\App\Http\Controllers\Delivery\OrdersController::class,'undone'])->name('tasks.undone');

            Route::get('orders/status/{id}',[\App\Http\Controllers\Delivery\OrdersController::class,'status'])->name('orders.status');
            Route::post('orders/status/{id}/change',[\App\Http\Controllers\Delivery\OrdersController::class,'changeStatus'])->name('orders.changeStatus');
        });

    }); // end auth group middleware

}); // end localization en\ar



