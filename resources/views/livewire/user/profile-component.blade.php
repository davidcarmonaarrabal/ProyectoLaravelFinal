<div>
    {{-- Llamamos al componente de mi card --}}
    <x-card cardTitle="Perfil de Usuario">
        <x-slot:cardTools>
            <a href="{{ route('dashboard') }}" class="btn btn-primary">
                <i class="fas fa-arrow-circle-left"></i> Volver al Dashboard
            </a>
        </x-slot:cardTools>

        <div class="row">
            <!-- Imagen de Perfil -->
            <div class="col-md-4 text-center">
                <img src="{{asset('dist/img/user.svg')}}"
                    class="img-fluid rounded-circle border shadow-sm" alt="Foto de perfil">
            </div>
            
            <!-- Información del Usuario -->
            <div class="col-md-8">
                <h2 class="text-primary">{{ $user->name }}</h2>
                <p><strong>Email:</strong> {{ $user->email }}</p>

                <!-- Formulario de Edición -->
                @if($canEdit)
                    <form wire:submit.prevent="updateProfile" class="mt-3">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="name">Nombre:</label>
                                <input type="text" id="name" class="form-control" wire:model="name">
                                @error('name')
                                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-12">
                                <label for="email">Correo Electrónico:</label>
                                <input type="email" id="email" class="form-control" wire:model="email">
                                @error('email')
                                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-12">
                                <label for="password">Nueva Contraseña (opcional):</label>
                                <input type="password" id="password" class="form-control" wire:model="password">
                                @error('password')
                                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary float-right">
                            <i class="fas fa-save"></i> Actualizar Perfil
                        </button>
                    </form>
                @else
                    <p class="text-muted mt-3">No puedes editar este perfil.</p>
                @endif
            </div>
        </div>
    </x-card>
</div>