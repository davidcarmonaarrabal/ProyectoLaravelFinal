<?php

use App\Livewire\Dashboard\DashboardComponent;
use App\Livewire\Home\Inicio;
use App\Livewire\TCG\CardComponent;
use App\Livewire\TCG\CardShow;
use App\Livewire\TCG\OrdersComponent;
use App\Livewire\TCG\OrderShow;
use App\Livewire\TCG\TransactionComponent;
use App\Livewire\User\ProfileComponent;
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
    Route::get('/dashboardd', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/dashboard', DashboardComponent::class)->name('inicio');
    Route::get('/cards', CardComponent::class)->name('card');
    Route::get('/cards/{card}', CardShow::class)->name('card.show');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile/{userId}', ProfileComponent::class)->name('profile');
    Route::get('/orders', OrdersComponent::class)->name('order');
    Route::get('/orders/{order}', OrderShow::class)->name('order.show');
    Route::get('/transactions', TransactionComponent::class)->name('transaction');
});

Auth::routes();

Route::get('/dashboardd', function () {
    return redirect()->route('inicio');
})->name('dashboard');
