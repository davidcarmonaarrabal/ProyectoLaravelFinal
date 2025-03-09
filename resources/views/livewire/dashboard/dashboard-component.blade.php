<div class="container mt-4">
    <div class="row">
        <!-- Total de Cartas -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Total de Ofertas</div>
                <div class="card-body">
                    <h3>{{ $totalCards }}</h3>
                    <p>Este es el número total de cartas ofertadas.</p>
                </div>
            </div>
        </div>

        <!-- Cartas del Usuario -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Mis Ofertas</div>
                <div class="card-body">
                    <h3>{{ $userCardsCount }}</h3>
                    <p>Este es el número de cartas que has ofertado.</p>
                </div>
            </div>
        </div>

        <!-- Orders del Usuario -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Mis Compras</div>
                <div class="card-body">
                    <h3>{{ $userOrdersCount }}</h3>
                    <p>Este es el número de cartas que has comprado.</p>
                </div>
            </div>
        </div>
    </div>
</div>