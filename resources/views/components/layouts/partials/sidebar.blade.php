<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('inicio') }}" class="brand-link">
        <img src="{{ asset('dist/img/logo.png') }}" alt="Logo" class="brand-image img-circle elevation-3"
            >
        <span class="brand-text font-weight-light">TCGL MARKET</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user.svg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                @if(Auth::check())  <!-- Verifica si el usuario está autenticado -->
                    <a href="{{ route('profile', Auth::id()) }}" class="d-block">{{ Auth::user()->name }}</a>
                @else
                    <a href="#" class="d-block">Invitado</a>
                @endif
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                
                <li class="nav-item">
                    <a href="{{ route('inicio') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Inicio
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('card') }}" class="nav-link">
                        <i class="nav-icon fas fa-store"></i>
                        <p>
                            Ofertas de Cartas
                        </p>
                    </a>
                </li>
                
                
                <li class="nav-item">
                    <a href="{{ route('order') }}" class="nav-link">
                        <i class="nav-icon fas fa-money-bill"></i>
                        <p>
                            Mis compras
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('transaction') }}" class="nav-link">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>
                            Mis transacciones
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
