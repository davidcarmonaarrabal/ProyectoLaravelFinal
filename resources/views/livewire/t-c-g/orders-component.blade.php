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
    <x-card cardTitle="Listado de Compras ({{ $totalRegistros }})" cardFooter="Card Footer">
        <x-slot:cardTools>
            <a href="#" class="btn btn-primary" wire:click="openCreateModal">
                Crear Orden
            </a>            
        </x-slot:cardTools>

        <x-table>
            <x-slot:thead>
                <th>Estado</th>
                <th>Fecha de Creación</th>
                <th>Total</th>
                <th width="3%">Ver Detalles</th>
                <th width="3%">Cancelar</th>
            </x-slot>
            @foreach ($orders as $order)
                <tr>
                    <td>
                        <span class="badge badge-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'danger') }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>${{ number_format($order->total_amount, 2) }}</td>
                    <td>
                        <a href="{{ route('order.show', $order->id) }}" title="Ver Detalles" class="btn btn-success btn-xs">
                            <i class="far fa-eye"></i>
                        </a>
                    </td>
                    <td>
                        @if($order->status === 'pending')
                            <button wire:click="cancelOrder({{ $order->id }})" title="Cancelar" class="btn btn-danger btn-xs">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        @else
                            <button title="No puedes cancelar una orden completada" class="btn btn-secondary btn-xs" disabled>
                                <i class="far fa-trash-alt"></i>
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </x-table>
        <x-slot:cardFooter>
            {{ $orders->links() }}
        </x-slot>
    </x-card>
</div>