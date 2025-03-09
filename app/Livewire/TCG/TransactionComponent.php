<?php

namespace App\Livewire\TCG;

use App\Models\Transaction; // Asegúrate de importar el modelo Transaction
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class TransactionComponent extends Component
{
    use WithPagination;

    public $totalRegistros = 0;
    public $search = "";
    public $cant = 10;

    public function render()
    {
        // Obtén el ID del usuario autenticado
        $userId = Auth::id();

        // Filtra las transacciones del usuario autenticado usando buyer_id
        $transactions = Transaction::where('buyer_id', $userId)
            ->where(function ($query) {
                $query->where('id', 'like', '%' . $this->search . '%')
                    ->orWhere('status', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->cant);

        // Total de registros
        $this->totalRegistros = Transaction::where('buyer_id', $userId)->count();

        return view('livewire.t-c-g.transaction-component', [
            'transactions' => $transactions,
        ]);
    }

    public function payTransaction($transactionId)
{
    // Obtén la transacción por su ID
    $transaction = Transaction::find($transactionId);

    // Verifica que la transacción exista y esté en estado "pending"
    if ($transaction && $transaction->status === 'pending') {
        // Cambia el estado de la transacción a "completed"
        $transaction->update(['status' => 'completed']);

        // Cambia el estado de la orden asociada a "completed"
        if ($transaction->order) {
            $transaction->order->update(['status' => 'completed']);
        }

        // Muestra un mensaje de éxito
        session()->flash('message', 'Transacción pagada correctamente.');
    } else {
        // Muestra un mensaje de error si la transacción no se puede pagar
        session()->flash('error', 'No puedes pagar esta transacción.');
    }
}

public function cancelTransaction($transactionId)
{
    // Obtén la transacción por su ID
    $transaction = Transaction::find($transactionId);

    // Verifica que la transacción exista y esté en estado "pending"
    if ($transaction && $transaction->status === 'pending') {
        // Cambia el estado de la transacción a "cancelled"
        $transaction->update(['status' => 'cancelled']);

        // Cambia el estado de la orden asociada a "cancelled"
        if ($transaction->order) {
            $transaction->order->update(['status' => 'cancelled']);
        }

        // Muestra un mensaje de éxito
        session()->flash('message', 'Transacción cancelada correctamente.');
    } else {
        // Muestra un mensaje de error si la transacción no se puede cancelar
        session()->flash('error', 'No puedes cancelar esta transacción.');
    }
}
    
}