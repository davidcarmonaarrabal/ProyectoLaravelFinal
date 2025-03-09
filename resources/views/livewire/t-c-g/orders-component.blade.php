<div>
    {{-- Llamamos al componente de mi card --}}
    <x-card cardTitle="Listado de Órdenes ({{ $totalRegistros }})" cardFooter="Card Footer">
        <x-slot:cardTools>
            <a href="#" class="btn btn-primary" wire:click="openCreateModal">
                Crear Orden
            </a>            
        </x-slot:cardTools>

        <x-table>
            <x-slot:thead>
                <th>ID de la Orden</th>
                <th>Estado</th>
                <th>Fecha de Creación</th>
                <th>Total</th>
                <th width="3%">Ver Detalles</th>
                <th width="3%">Cancelar</th>
            </x-slot>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>
                        <span class="badge badge-{{ $order->status === 'completed' ? 'success' : 'warning' }}">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>${{ number_format($order->total, 2) }}</td>
                    <td>
                        <a href="{{ route('order', $order->id) }}" title="Ver Detalles" class="btn btn-success btn-xs">
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