<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{ $title ?? config('app.name') }} </title>

    @include('components.layouts.partials.styles')
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="dist/img/logo.png" alt="AdminLTELogo" height="300"
                width="300">
        </div>

        @include('components.layouts.partials.navbar')

        @include('components.layouts.partials.sidebar')

        <div class="content-wrapper">

            @include('components.layouts.partials.content-header')

            <section class="content">
                <div class="container-fluid">

                    @livewire('messages')

                    {{ $slot }}

                </div>
            </section>
        </div>

        @include('components.layouts.partials.footer')
    </div>

    @include('components.layouts.partials.scripts')

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('close-modal', (idModal) => {
                $('#' + idModal).modal('hide');
            })
        });

        // Modal para editar
        document.addEventListener('livewire:init', () => {
            Livewire.on('open-modal', (idModal) => {
                $('#' + idModal).modal('show');
            })
        });

        // Modal para el sweetAlert
        document.addEventListener('livewire:init', () => {
            Livewire.on('delete', (e) => {
                // alert(e.id+'-'+e.eventname)
                Swal.fire({
                    title: "¿Estas seguro?",
                    text: "Esta acción no se puede revertir!!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, eliminar categoría!",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Emitimos evento para eliminar registro si se acepta
                        Livewire.dispatch(e.eventname, { id: e.id })
                    }
                });

            })
        });
    </script>

</body>

</html>
