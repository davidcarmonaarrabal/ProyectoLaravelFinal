<div>
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- Llamamos al componente de mi card --}}
    <x-card cardTitle="Listado de Transacciones ({{ $totalRegistros }})" cardFooter="Card Footer">
        <x-slot:cardTools>
                     
        </x-slot:cardTools>

        <x-table>
            <x-slot:thead>
                <th>Estado</th>
                <th>Fecha de Creación</th>
                <th>Monto</th>
                <th>Carta</th>
                <th>Estado de la Orden</th>
                <th width="3%">Pagar</th>
                <th width="3%">Cancelar</th>
            </x-slot>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>
                        <span class="badge badge-{{ $transaction->status === 'completed' ? 'success' : ($transaction->status === 'pending' ? 'warning' : 'danger') }}">
                            {{ ucfirst($transaction->status) }}
                        </span>
                    </td>
                    <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                    <td>${{ number_format($transaction->amount, 2) }}</td>
                    <td>
                        <a href="{{ route('card.show', $transaction->card_id) }}" class="badge badge-info">
                            Ver Carta
                        </a>
                    </td>
                    <td>
                        @if($transaction->order)
                            <span class="badge badge-{{ $transaction->order->status === 'completed' ? 'success' : ($transaction->order->status === 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($transaction->order->status) }}
                            </span>
                        @else
                            <span class="badge badge-secondary">Sin orden</span>
                        @endif
                    </td>
                    <td>
                        @if($transaction->status === 'pending')
                            <button wire:click="payTransaction({{ $transaction->id }})" title="Pagar" class="btn btn-success btn-xs">
                                <i class="fas fa-money-bill-wave"></i>
                            </button>
                        @else
                            <button title="No puedes pagar una transacción completada" class="btn btn-secondary btn-xs" disabled>
                                <i class="fas fa-money-bill-wave"></i>
                            </button>
                        @endif
                    </td>
                    <td>
                        @if($transaction->status === 'pending')
                            <button wire:click="cancelTransaction({{ $transaction->id }})" title="Cancelar" class="btn btn-danger btn-xs">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        @else
                            <button title="No puedes cancelar una transacción completada" class="btn btn-secondary btn-xs" disabled>
                                <i class="far fa-trash-alt"></i>
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </x-table>
        <x-slot:cardFooter>
            {{ $transactions->links() }}
        </x-slot>
    </x-card>
</div>