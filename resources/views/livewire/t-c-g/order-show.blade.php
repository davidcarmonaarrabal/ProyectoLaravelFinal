<x-card cardTitle="Detalles de la Orden">
    <x-slot:cardTools>
        <a href="{{ route('order') }}" class="btn btn-primary">
            <i class="fas fa-arrow-circle-left"></i> Regresar a las Órdenes
        </a>
    </x-slot:cardTools>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <h2>Orden #{{ $order->id }}</h2>
                <p><strong>Estado:</strong> 
                    <span class="badge {{ $order->status === 'completed' ? 'badge-success' : ($order->status === 'pending' ? 'badge-warning' : 'badge-danger') }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </p>
                <p><strong>Fecha de Creación:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Total:</strong> ${{ number_format($order->total_amount, 2) }}</p>
                <p><strong>Comprador:</strong> {{ $order->user->name ?? 'Desconocido' }}</p>
                <p><strong>Vendedor:</strong> {{ $order->card->user->name ?? 'Desconocido' }}</p>

                <!-- Detalles de la Carta (si existe relación con Card) -->
                @if($order->card)
                    <hr>
                    <h4>Detalles de la Carta</h4>
                    <p><strong>Nombre de la Carta:</strong> {{ $order->card->name }}</p>
                    <p><strong>Descripción:</strong> {{ $order->card->description ?? 'Sin descripción' }}</p>
                    <p><strong>Precio:</strong> ${{ number_format($order->card->price, 2) }}</p>
                    <p><strong>Estado de la Carta:</strong> 
                        <span class="badge {{ $order->card->status === 'active' ? 'badge-success' : 'badge-danger' }}">
                            {{ ucfirst($order->card->status) }}
                        </span>
                    </p>
                    <p><strong>Vendedor:</strong> {{ $order->card->user->name ?? 'Desconocido' }}</p>
                @endif
            </div>
        </div>
    </div>
</x-card>