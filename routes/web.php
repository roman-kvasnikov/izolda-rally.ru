<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\CrewController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TechController;
use App\Http\Controllers\GoalsController;
use App\Http\Controllers\ContactsController;

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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', IndexController::class)->name('index');
Route::get('/crew', CrewController::class)->name('crew');
Route::get('/activity', ActivityController::class)->name('activity');
Route::get('/team', TeamController::class)->name('team');
Route::get('/tech', TechController::class)->name('tech');
Route::get('/goals', GoalsController::class)->name('goals');
Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts');