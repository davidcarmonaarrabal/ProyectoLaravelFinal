<div>
    {{-- llamamos al componente de mi card --}}
    <x-card cardTitle="Listado Categorias" cardFooter="Card Footer">
        <x-slot:cardTools>
            <a href="#" class="btn btn-primary" wire:click='create'>
                Crear categoria</a>
        </x-slot:cardTools>

        <x-table>
            <x-slot:thead>
                <th>Nombre</th>
                <th>Price</th>
                <th width="3%">...</th>
                <th width="3%">...</th>
                <th width="3%">...</th>
            </x-slot>
                <tr>
                    <td>...</td>
                    <td>...</td>
                    <td>
                        <a href="#" title="ver" class="btn btn-success btn-xs">
                            <i class="far fa-eye"></i>
                        </a>
                    </td>

                    <td>
                        <a href="#" title="editar"
                            class="btn btn-primary btn-xs">
                            <i class="far fa-edit"></i>
                        </a>
                    </td>

                    <td>
                        <a href="#"
                            title="eliminar" class="btn btn-danger btn-xs">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
        </x-table>

    </x-card>
</div>