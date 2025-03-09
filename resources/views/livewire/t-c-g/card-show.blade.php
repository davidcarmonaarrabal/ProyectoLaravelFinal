<x-card cardTitle="Detalles de la Carta">
    <x-slot:cardTools>
        <a href="{{ route('card') }}" class="btn btn-primary">
            <i class="fas fa-arrow-circle-left"></i> Regresar a las Ofertas
        </a>
    </x-slot:cardTools>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ $card->image_url ?? 'https://pokexperto.net/cartadex/reverso.png' }}" class="img-fluid rounded" alt="Carta de Pokémon">
            </div>
            <div class="col-md-8">
                <h2>{{ $card->name }}</h2>
                <p><strong>Descripción:</strong> {{ $card->description ?? 'Sin descripción' }}</p>
                <p><strong>Precio:</strong> ${{ number_format($card->price, 2) }}</p>
                <p><strong>Estado:</strong> 
                    <span class="badge {{ $card->status === 'active' ? 'badge-success' : 'badge-danger' }}">
                        {{ ucfirst($card->status) }}
                    </span>
                </p>
                <p><strong>Vendedor:</strong> {{ $card->user->name ?? 'Desconocido' }}</p>
            </div>
        </div>
    </div>
</x-card>
