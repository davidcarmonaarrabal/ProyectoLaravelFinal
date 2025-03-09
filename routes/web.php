<?php

use App\Livewire\Dashboard\DashboardComponent;
use App\Livewire\Home\Inicio;
use App\Livewire\TCG\CardComponent;
use App\Livewire\TCG\CardShow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rutas protegidas por autenticación
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/dashboard/component', DashboardComponent::class)->name('inicio');
    Route::get('/cards', CardComponent::class)->name('card');
    Route::get('/cards/{card}', CardShow::class)->name('card.show');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Auth::routes();

Route::get('/dashboard', function () {
    return redirect()->route('inicio');
})->name('dashboard');
