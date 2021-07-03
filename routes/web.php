<?php

use App\Http\Controllers\LopHocController;
use App\Http\Controllers\SinhVienController;
use App\Http\Controllers\DiemController;
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
    return view('welcome');
});

Route::get('/test', function () {
    echo "đâsdasdasdasdasdasd";
});

Route::resource('/sinhvien', SinhVienController::class);
Route::resource('/lophoc', LopHocController::class);
Route::resource('/diem', DiemController::class);
