<div>
    {{-- Llamamos al componente de mi card --}}
    <x-card cardTitle="Listado de Cartas ({{ $totalRegistros }})" cardFooter="Card Footer">
        <x-slot:cardTools>
            <a href="#" class="btn btn-primary" wire:click="openCreateModal">
                Crear Carta
            </a>            
        </x-slot:cardTools>

        <x-table>
            <x-slot:thead>
                <th>Nombre de la Carta</th>
                <th>Usuario que oferta</th>
                <th>Precio de la Carta</th>
                <th width="3%">Comprar Carta</th>
                <th width="3%">Ver Oferta</th>
                <th width="3%">Editar Oferta</th>
                <th width="3%">Borrar Oferta</th>
            </x-slot>
            @foreach ($cards as $card)
                <tr>
                    <td>{{ $card->name }}</td>
                    {{-- <td>{{ $card->user->name }}</td> --}}
                    <td>
                        <a class="badge badge-secondary" href="{{ route('profile', $card->user->id) }}">
                            {{ $card->user->name }}
                        </a>
                    </td>
                    <td>{{ $card->price }}</td>
                    <td>
                        @if($card->status === 'inactive' || $card->user_id === auth()->id())
                            <button title="No disponible por inactividad o ser tu propia venta" class="btn btn-secondary btn-xs" disabled>
                                <i class="nav-icon fas fa-store"></i>
                            </button>
                        @else
                            <button wire:click="buyCard({{ $card->id }})" title="Comprar" class="btn btn-success btn-xs">
                                <i class="nav-icon fas fa-store"></i>
                            </button>
                        @endif
                    </td>          
                    <td>
                        @if($card->status === 'inactive')
                            <button title="No puedes ver una oferta inactiva" class="btn btn-secondary btn-xs" disabled>
                                <i class="far fa-eye"></i>
                            </button>
                        @else
                            <a href="{{ route('card.show', $card->id) }}" title="Ver" class="btn btn-success btn-xs">
                                <i class="far fa-eye"></i>
                            </a>
                        @endif
                    </td>                                  
                    <td>
                        @if($card->user_id === auth()->id())
                            <button wire:click="edit({{ $card->id }})" title="Editar" class="btn btn-primary btn-xs">
                                <i class="far fa-edit"></i>
                            </button>
                        @else
                            <button title="No puedes editar una oferta que no es tuya" class="btn btn-secondary btn-xs" disabled>
                                <i class="far fa-edit"></i>
                            </button>
                        @endif
                    </td>                     
                    <td>
                        @if($card->user_id === auth()->id() && $card->status !== 'inactive')
                            <button wire:click="delete({{ $card->id }})" title="Eliminar" class="btn btn-danger btn-xs">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        @else
                            <button title="No puedes eliminar una oferta que no es tuya o que está inactiva" class="btn btn-secondary btn-xs" disabled>
                                <i class="far fa-trash-alt"></i>
                            </button>
                        @endif
                    </td>                      
                </tr>
            @endforeach
        </x-table>
        <x-slot:cardFooter>
            {{ $cards->links() }}
        </x-slot>
    </x-card>

    <x-modal modalId="modalCard" modalTitle="{{ $cardIdToEdit ? 'Editar Carta' : 'Crear Carta' }}">
        <form wire:submit.prevent="{{ $cardIdToEdit ? 'update' : 'store' }}">
            <div class="form-row">
                <div class="form-group col-12">
                    <label for="name">Nombre:</label>
                    <input wire:model="name" id="name" type="text" class="form-control" placeholder="Nombre de la carta">
                    @error('name')
                        <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                    @enderror
                </div>
    
                <div class="form-group col-12">
                    <label for="description">Descripción:</label>
                    <textarea wire:model="description" id="description" class="form-control" placeholder="Descripción de la carta"></textarea>
                    @error('description')
                        <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                    @enderror
                </div>
    
                <div class="form-group col-12">
                    <label for="price">Precio:</label>
                    <input wire:model="price" id="price" type="number" step="0.01" class="form-control" placeholder="Precio de la carta">
                    @error('price')
                        <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                    @enderror
                </div>
    
                <div class="form-group col-12">
                    <label for="image_url">URL de la imagen:</label>
                    <input wire:model="image_url" id="image_url" type="text" class="form-control" placeholder="URL de la imagen (Puedes no poner una)">
                    @error('image_url')
                        <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                    @enderror
                </div>
    
                <div class="form-group col-12">
                    <label for="status">Estado:</label>
                    <select wire:model="status" id="status" class="form-control">
                        <option value="active">Activa</option>
                        <option value="inactive">Inactiva</option>
                    </select>
                    @error('status')
                        <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary float-right">
                {{ $cardIdToEdit ? 'Actualizar' : 'Guardar' }}
            </button>
        </form>
    </x-modal>
</div>