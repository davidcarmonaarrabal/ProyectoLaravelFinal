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
                <th>Nombre</th>
                <th>Precio</th>
                <th>Estado</th>
                <th width="3%">...</th>
                <th width="3%">...</th>
                <th width="3%">...</th>
            </x-slot>
            @foreach ($cards as $card)
                <tr>
                    <td>{{ $card->name }}</td>
                    <td>{{ $card->price }}</td>
                    <td>{{ $card->status }}</td>
                    <td>
                        <a href="#" title="ver" class="btn btn-success btn-xs">
                            <i class="far fa-eye"></i>
                        </a>
                    </td>
                    <td>
                        @if($card->user_id === auth()->id())
                            <button wire:click="edit({{ $card->id }})" title="Editar" class="btn btn-primary btn-xs">
                                <i class="far fa-edit"></i>
                            </button>
                        @else
                            <button title="No tienes permiso para editar" class="btn btn-secondary btn-xs" disabled>
                                <i class="far fa-edit"></i>
                            </button>
                        @endif
                    </td>  
                    <td>
                        @if($card->user_id === auth()->id())
                            <button wire:click="delete({{ $card->id }})" title="Eliminar" class="btn btn-danger btn-xs">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        @else
                            <button title="No tienes permiso para eliminar" class="btn btn-secondary btn-xs" disabled>
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
        <form wire:submit={{ $Id == 0 ? "store" : "update($Id)" }}>
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
                    <input wire:model="image_url" id="image_url" type="text" class="form-control" placeholder="URL de la imagen">
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