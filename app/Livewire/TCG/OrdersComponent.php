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

    public function cancelOrder($orderId)
{
    // Obtén la orden por su ID
    $order = Order::find($orderId);

    // Verifica que la orden exista y esté en estado "pending"
    if ($order && $order->status === 'pending') {
        // Cambia el estado de la orden a "canceled"
        $order->update(['status' => 'cancelled']);

        // Muestra un mensaje de éxito
        session()->flash('message', 'Orden cancelada correctamente.');
    } else {
        // Muestra un mensaje de error si la orden no se puede cancelar
        session()->flash('error', 'No puedes cancelar esta orden.');
    }
}
}