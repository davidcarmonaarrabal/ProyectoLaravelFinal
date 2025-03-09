<?php

namespace App\Livewire\TCG;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrdersComponent extends Component
{
    use WithPagination;

    public $totalRegistros = 0;
    public $search = "";
    public $cant = 10;

    public function render()
    {
        // Obtén el ID del usuario autenticado
        $userId = Auth::id();

        // Filtra las órdenes del usuario autenticado
        $orders = Order::where('user_id', $userId)
            ->where(function ($query) {
                $query->where('id', 'like', '%' . $this->search . '%')
                    ->orWhere('status', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->cant);

        // Total de registros
        $this->totalRegistros = Order::where('user_id', $userId)->count();

        return view('livewire.t-c-g.orders-component', [
            'orders' => $orders,
        ]);
    }
}