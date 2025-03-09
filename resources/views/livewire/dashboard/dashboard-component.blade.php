<div class="container mt-4">
    <div class="row">
        <!-- Total de Cartas -->
        <div class="col-md-4">
            <a href="{{ route('card') }}">
                <div class="card">
                    <div class="card-header">Total de Ofertas</div>
                    <div class="card-body">
                        <h3>{{ $totalCards }}</h3>
                        <p>Este es el número total de cartas ofertadas.</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('order') }}">
                <div class="card">
                    <div class="card-header">Mis Compras</div>
                    <div class="card-body">
                        <h3>{{ $userOrdersCount }}</h3>
                        <p>Este es el número de cartas que has comprado.</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Mis Ofertas</div>
                <div class="card-body">
                    <h3>{{ $userCardsCount }}</h3>
                    <p>Este es el número de cartas que has ofertado.</p>
                </div>
            </div>
        </div>

        <!-- Órdenes Pagadas -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Órdenes Pagadas</div>
                <div class="card-body">
                    <h3>{{ $paidOrdersCount }}</h3>
                    <p>Este es el número de órdenes que has pagado.</p>
                </div>
            </div>
        </div>

        <!-- Órdenes Canceladas -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Órdenes Canceladas</div>
                <div class="card-body">
                    <h3>{{ $cancelledOrdersCount }}</h3>
                    <p>Este es el número de órdenes que has cancelado.</p>
                </div>
            </div>
        </div>

        <!-- Órdenes Pendientes -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Órdenes Pendientes</div>
                <div class="card-body">
                    <h3>{{ $pendingOrdersCount }}</h3>
                    <p>Este es el número de órdenes que están pendientes.</p>
                </div>
            </div>
        </div>
    </div>
</div>