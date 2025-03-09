<?php

namespace App\Livewire\TCG;

use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Detalles de la Orden')]
class OrderShow extends Component
{
    public $order;

    public function mount($order)
    {
        // Obtén la orden por su ID
        $this->order = Order::findOrFail($order);
    }

    public function render()
    {
        return view('livewire.t-c-g.order-show', [
            'order' => $this->order
        ]);
    }
}