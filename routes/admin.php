<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FamilyController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CoverController;
use App\Http\Controllers\Admin\CompanyProfileController;
use App\Http\Controllers\Admin\CompanyServiceController;
use App\Http\Controllers\Admin\CompanySettingController;
use App\Http\Controllers\Admin\AppearanceSettingController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ShipmentController;
use Database\Seeders\OptionSeeder;

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');
Route::get('/estadisticas', [DashboardController::class, 'statistics'])
    ->name('estadisticas');

// =========================
// Resto de recursos admin
// =========================

Route::get('/options', [OptionController::class, 'index'])->name('options.index');
Route::get('/settings/footer', [CompanySettingController::class, 'edit'])->name('settings.footer.edit');
Route::put('/settings/footer', [CompanySettingController::class, 'update'])->name('settings.footer.update');
Route::get('/settings/appearance', [AppearanceSettingController::class, 'edit'])->name('settings.appearance.edit');
Route::put('/settings/appearance', [AppearanceSettingController::class, 'update'])->name('settings.appearance.update');
Route::get('/settings/company', [CompanyProfileController::class, 'edit'])->name('settings.company.edit');
Route::put('/settings/company', [CompanyProfileController::class, 'update'])->name('settings.company.update');
Route::get('/settings/company/location', [CompanyProfileController::class, 'editLocation'])
    ->name('settings.company.location.edit');
Route::put('/settings/company/location', [CompanyProfileController::class, 'updateLocation'])
    ->name('settings.company.location.update');
Route::resource('/settings/company/services', CompanyServiceController::class)
    ->names('settings.company.services')
    ->except(['show']);
Route::put('/settings/company/services/settings', [CompanyServiceController::class, 'updateSettings'])
    ->name('settings.company.services.settings');
Route::resource('/settings/company/faqs', FaqController::class)
    ->names('settings.company.faqs')
    ->except(['show']);
Route::put('/settings/company/faqs/settings', [FaqController::class, 'updateSettings'])
    ->name('settings.company.faqs.settings');

Route::resource('families', FamilyController::class);
Route::resource('categories', CategoryController::class);
Route::resource('subcategories', SubcategoryController::class);
Route::resource('products', ProductController::class);
Route::get('products/{product}/variants/{variant}', [ProductController::class, 'variants'])
    ->name('products.variants')
    ->scopeBindings();

Route::put('products/{product}/variants/{variant}', [ProductController::class, 'variantsUpdate'])
    ->name('products.variantsUpdate')
    ->scopeBindings();

Route::resource('covers', CoverController::class);
Route::resource('drivers', DriverController::class);

Route::get('shipments', [ShipmentController::class, 'index'])->name('shipments.index');
Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
