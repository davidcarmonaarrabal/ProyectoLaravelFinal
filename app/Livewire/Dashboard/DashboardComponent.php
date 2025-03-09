<?php

namespace App\Livewire\Dashboard;

use App\Models\Card; // Asegúrate de importar el modelo Card
use App\Models\Order; // Asegúrate de importar el modelo Order
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

#[Title('Dashboard')]
class DashboardComponent extends Component
{
    public $totalCards;          // Total de cartas
    public $userCardsCount;      // Número de cartas del usuario
    public $userOrdersCount;     // Número de Orders del usuario

    public function mount()
    {
        // Obtén el ID del usuario autenticado
        $userId = Auth::id();

        // Calcula las métricas
        $this->totalCards = Card::count(); // Total de cartas
        $this->userCardsCount = Card::where('user_id', $userId)->count(); // Cartas del usuario
        $this->userOrdersCount = Order::where('user_id', $userId)->count(); // Orders del usuario
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard-component');
    }
}