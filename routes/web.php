<?php

use App\Http\Livewire\Athlete;
use App\Http\Livewire\Category;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\GenerateTeams;
use App\Http\Livewire\Modality;
use App\Http\Livewire\Teams;
use App\Http\Livewire\Time;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/atletas', Athlete::class)->name('athlete');
    Route::get('/atletas-por-categoria', Teams::class)->name('teams');
    Route::get('/modalidades', Modality::class)->name('modality');
    Route::get('/categorias', Category::class)->name('category');
    Route::get('/tempos', Time::class)->name('times');
    Route::get('/gerar-equipe', GenerateTeams::class)->name('generateTeam');
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
});
