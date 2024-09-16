<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\FinanceHub;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group([
    'middleware' => ['auth','role_validate:financehub'],
    'prefix' => '/financehub',
    'as' => 'financehub',
    ], function () {
        Route::group(['middleware' => ['role_validate:financehub_categories'], 'prefix' => 'categories', 'as' => '_categories'], function () {
            Route::get('/', [FinanceHub\CategoriesController::class, 'index']);
            Route::post('/', [FinanceHub\CategoriesController::class, 'save'])->name('_save');
            Route::get('/add', [FinanceHub\CategoriesController::class, 'addOrUpdate'])->name('_add');
            Route::get('/delete/{id}', [FinanceHub\CategoriesController::class, 'delete'])->name('_delete');
            Route::get('/update/{id}', [FinanceHub\CategoriesController::class, 'addOrUpdate'])->name('_update');
        });

        Route::group(['middleware' => ['role_validate:financehub_transactions'], 'prefix' => 'transactions', 'as' => '_transactions'], function () {
            Route::get('/', [FinanceHub\TransactionController::class, 'index']);
            Route::post('/', [FinanceHub\TransactionController::class, 'save'])->name('_save');
            Route::get('/add', [FinanceHub\TransactionController::class, 'addOrUpdate'])->name('_add');
            Route::get('/delete/{id}', [FinanceHub\TransactionController::class, 'delete'])->name('_delete');
            Route::get('/update/{id}', [FinanceHub\TransactionController::class, 'addOrUpdate'])->name('_update');
        });

        Route::group(['middleware' => ['role_validate:financehub_budgets'], 'prefix' => 'budgets', 'as' => '_budgets'], function () {
            Route::get('/', [FinanceHub\BudgetController::class, 'index']);
        });

        Route::group(['middleware' => ['role_validate:financehub_budgets'], 'prefix' => 'financial-insights', 'as' => '_financial_insights'], function () {
            Route::get('/', [FinanceHub\FinancialInsightController::class, 'index']);
        });
});

Route::group([
    'prefix' => '/',
    'as' => '',
    ], function () {
        Route::get('/', [Admin\AuthController::class, 'index']);
        Route::get('login', [Admin\AuthController::class, 'index']);
        Route::post('login', [Admin\AuthController::class, 'login'])->name('login');
        Route::get('logout', [Admin\AuthController::class, 'logout'])->name('logout');
});

Route::group([
    'middleware' => ['auth'],
    'prefix' => '/dashboard',
    'as' => 'dashboard',
    ], function () {
        Route::get('/', [Admin\DashboardController::class, 'index']);
});

Route::group([
    'middleware' => ['auth','role_validate:users'],
    'prefix' => '/users',
    'as' => 'users',
    ], function () {
        Route::get('/', [Admin\UserController::class, 'index']);
        Route::post('/', [Admin\UserController::class, 'save'])->name('_save');
        Route::get('/add', [Admin\UserController::class, 'addOrUpdate'])->name('_add');
        Route::get('/delete/{id}', [Admin\UserController::class, 'delete'])->name('_delete');
        Route::get('/update/{id}', [Admin\UserController::class, 'addOrUpdate'])->name('_update');
});

Route::group([
    'middleware' => ['auth'],
    'prefix' => '/profile',
    'as' => 'profile',
    ], function () {
        Route::get('/', [Admin\ProfileController::class, 'index']);
        Route::post('/save', [Admin\ProfileController::class, 'save'])->name('_save');
        Route::post('/change-password', [Admin\ProfileController::class, 'changePassword'])->name('_change_password');
});

Route::group([
    'middleware' => ['auth','role_validate:roles'],
    'prefix' => '/roles',
    'as' => 'roles',
    ], function () {
        Route::get('/', [Admin\RoleController::class, 'index']);
        Route::post('/', [Admin\RoleController::class, 'save'])->name('_save');
        Route::get('/add', [Admin\RoleController::class, 'addOrUpdate'])->name('_add');
        Route::get('/delete/{id}', [Admin\RoleController::class, 'delete'])->name('_delete');
        Route::get('/update/{id}', [Admin\RoleController::class, 'addOrUpdate'])->name('_update');
});

Route::group([
    'middleware' => ['auth','role_validate:menus'],
    'prefix' => '/menus',
    'as' => 'menus',
    ], function () {
        Route::get('/', [Admin\MenuController::class, 'index']);
        Route::post('/', [Admin\MenuController::class, 'save'])->name('_save');
        Route::get('/add', [Admin\MenuController::class, 'addOrUpdate'])->name('_add');
        Route::get('/delete/{id}', [Admin\MenuController::class, 'delete'])->name('_delete');
        Route::get('/update/{id}', [Admin\MenuController::class, 'addOrUpdate'])->name('_update');
});

Route::group([
    'middleware' => ['auth'],
    'prefix' => '/settings',
    'as' => 'settings',
    ], function () {
        Route::get('/', [Admin\DashboardController::class, 'index']);

        Route::group(['middleware' => ['role_validate:settings_configuration'], 'prefix' => 'configuration', 'as' => '_configuration'], function () {
            Route::get('/', [Admin\SettingController::class, 'configuration']);
            Route::post('/', [Admin\SettingController::class, 'configurationSave'])->name('_save');
        });

        Route::group(['middleware' => ['role_validate:settings_integration'], 'prefix' => 'integration', 'as' => '_integration'], function () {
            Route::get('/', [Admin\SettingController::class, 'integration']);
            Route::get('/add', [Admin\SettingController::class, 'integrationAddOrUpdate'])->name('_add');
            Route::get('/{id}', [Admin\SettingController::class, 'integrationAddOrUpdate'])->name('_update');
            Route::post('/', [Admin\SettingController::class, 'integrationSave'])->name('_save');
        });

        Route::group(['middleware' => ['role_validate:settings_cache_management'], 'prefix' => 'cache-management', 'as' => '_cache'], function () {
            Route::get('/', [Admin\CacheController::class, 'cache'])->name('_management');
            Route::get('/all', [Admin\CacheController::class, 'cacheAll'])->name('_all');
            Route::get('/config', [Admin\CacheController::class, 'cacheConfig'])->name('_config');
            Route::get('/route', [Admin\CacheController::class, 'cacheRoute'])->name('_route');
            Route::get('/view', [Admin\CacheController::class, 'cacheView'])->name('_view');
        });
});

Route::group([
    'middleware' => ['auth','role_validate'],
    'prefix' => '/reports',
    'as' => 'reports',
    ], function () {
        Route::get('/admin-log', [Admin\AdminLogController::class, 'index'])->name('_adminlog');
        Route::get('/admin-log/{id}', [Admin\AdminLogController::class, 'adminLogDetail'])->name('_adminlog_detail');
});