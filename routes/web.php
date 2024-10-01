<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Tasks;
use App\Http\Livewire\Storyblock;
use App\Http\Livewire\InProgress;
use App\Http\Livewire\TaskList;
use App\Http\Livewire\Users;
use App\Http\Livewire\Detail;
use App\Http\Livewire\Api;
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
    return redirect('/users');
})->middleware(['auth','role']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/users', Users::class)->name('users')->middleware(['auth','role']);
Route::get('/task', Tasks::class)->middleware(['auth','role']);
Route::get('/task-list', TaskList::class)->middleware(['auth']);
Route::get('/task-detail/{id}', Detail::class)->middleware(['auth']);
Route::get('/in_progress/{id}', InProgress::class)->middleware(['auth']);
Route::get('/settings', Api::class)->middleware(['auth']);
Route::get('/storyblok/{slug?}', Storyblock::class);


