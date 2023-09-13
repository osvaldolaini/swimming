<?php

use App\Http\Livewire\AllStats;
use App\Http\Livewire\Athlete;
use App\Http\Livewire\Category;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\GenerateTeams;
use App\Http\Livewire\Modality;
use App\Http\Livewire\Relay;
use App\Http\Livewire\Team;
use App\Http\Livewire\Team\Absoluto;
use App\Http\Livewire\Team\Base;
use App\Http\Livewire\Team\Master;
use App\Http\Livewire\TeamsList;
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
    Route::get('/atletas-por-categoria', TeamsList::class)->name('teamsList');
    Route::get('/modalidades', Modality::class)->name('modality');
    Route::get('/times', Team::class)->name('team');
    Route::get('/revezamentos', Relay::class)->name('relay');
    Route::get('/tempos', Time::class)->name('times');
    Route::get('/gerar-equipe', GenerateTeams::class)->name('generateTeam');
    Route::get('/evolução-do-atleta', AllStats::class)->name('allStats');


    Route::get('/equipe-de-base', Base::class)->name('generateBaseTeam');
    Route::get('/equipe-absoluto', Absoluto::class)->name('generateAbsolutoTeam');
    Route::get('/equipe-master', Master::class)->name('generateMasterTeam');
});
