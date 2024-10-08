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
    'middleware' => ['auth'],
    'prefix' => '/financehub',
    'as' => 'financehub',
    ], function () {
        Route::get('/categories', [FinanceHub\CategoriesController::class, 'index'])->name('_categories');
        Route::post('/categories', [FinanceHub\CategoriesController::class, 'save'])->name('_categories_save');
        Route::get('/categories/add', [FinanceHub\CategoriesController::class, 'addOrUpdate'])->name('_categories_add');
        Route::get('/categories/delete/{id}', [FinanceHub\CategoriesController::class, 'delete'])->name('_categories_delete');
        Route::get('/categories/update/{id}', [FinanceHub\CategoriesController::class, 'addOrUpdate'])->name('_categories_update');

        Route::get('/transactions', [FinanceHub\TransactionController::class, 'index'])->name('_transactions');
        Route::post('/transactions', [FinanceHub\TransactionController::class, 'save'])->name('_transactions_save');
        Route::get('/transactions/add', [FinanceHub\TransactionController::class, 'addOrUpdate'])->name('_transactions_add');
        Route::get('/transactions/delete/{id}', [FinanceHub\TransactionController::class, 'delete'])->name('_transactions_delete');
        Route::get('/transactions/update/{id}', [FinanceHub\TransactionController::class, 'addOrUpdate'])->name('_transactions_update');

        Route::get('/budgets', [FinanceHub\BudgetController::class, 'index'])->name('_budgets');
        Route::get('/financial-insights', [FinanceHub\FinancialInsightController::class, 'index'])->name('_financial_insights');
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
    'middleware' => ['auth'],
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
    'middleware' => ['auth'],
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
    'middleware' => ['auth'],
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
        Route::get('/', [Admin\SettingController::class, 'index']);
        Route::get('/configuration', [Admin\SettingController::class, 'configuration'])->name('_configuration');
        Route::post('/configuration', [Admin\SettingController::class, 'configurationSave'])->name('_configuration_save');
        Route::get('/integration', [Admin\SettingController::class, 'integration'])->name('_integration');
        Route::get('/integration/add', [Admin\SettingController::class, 'integrationAddOrUpdate'])->name('_integration_add');
        Route::get('/integration/{id}', [Admin\SettingController::class, 'integrationAddOrUpdate'])->name('_integration_update');
        Route::post('/integration', [Admin\SettingController::class, 'integrationSave'])->name('_integration_save');
        Route::get('/cache-management', [Admin\CacheController::class, 'cache'])->name('_cache_management');
        Route::get('/cache-management/all', [Admin\CacheController::class, 'cacheAll'])->name('_cache_all');
        Route::get('/cache-management/config', [Admin\CacheController::class, 'cacheConfig'])->name('_cache_config');
        Route::get('/cache-management/route', [Admin\CacheController::class, 'cacheRoute'])->name('_cache_route');
        Route::get('/cache-management/view', [Admin\CacheController::class, 'cacheView'])->name('_cache_view');
});

Route::group([
    'middleware' => ['auth'],
    'prefix' => '/reports',
    'as' => 'reports',
    ], function () {
        Route::get('/admin-log', [Admin\AdminLogController::class, 'index'])->name('_adminlog');
        Route::get('/admin-log/{id}', [Admin\AdminLogController::class, 'adminLogDetail'])->name('_adminlog_detail');
});