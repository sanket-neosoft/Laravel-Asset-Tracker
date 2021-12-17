<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetTypeController;
use App\Models\AssetType;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// AssetType 
Route::get('/asset-type', [AssetTypeController::class, 'asset_type'])->name('asset-type');
Route::get('/asset-type/add', [AssetTypeController::class, 'add_asset_type']);
Route::post('/asset-type/add/insert', [AssetTypeController::class, 'insert_asset_type'])->name('asset-type');
Route::get('/asset-type/edit/{id}', [AssetTypeController::class, 'get_asset_type']);
Route::post('/asset-type/update', [AssetTypeController::class, 'update_asset_type']);
Route::post('/asset-type/delete/{id}', [AssetTypeController::class, 'delete_asset_type']);

// Asset
Route::get('/asset',[AssetController::class, 'asset'])->name('asset');
Route::get('/asset/add', [AssetController::class, 'add_asset']);
Route::post('/asset/add/insert', [AssetController::class, 'insert_asset']);
Route::post('/asset/delete/{id}', [AssetController::class, 'delete_asset']);
Route::get('/asset/edit/{id}', [AssetController::class, 'get_asset']);
Route::post('/asset/update', [AssetController::class, 'update_asset']);

// AssetImages
Route::get('/asset/images/{uuid}', [AssetController::class, 'show_images'])->name('image');
Route::post('/asset/images/delete/{id}', [AssetController::class, 'delete_image']);

Route::get('file-import-export', [AssetController::class, 'fileImportExport']);
Route::post('file-import', [AssetController::class, 'fileImport'])->name('file-import');
Route::get('file-export', [AssetController::class, 'fileExport'])->name('file-export');