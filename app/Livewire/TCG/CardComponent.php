<?php

namespace App\Livewire\TCG;

use App\Models\Card;
use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

#[Title('Cartas')]
class CardComponent extends Component
{
    use WithPagination;

    public $totalRegistros = 0;
    public $name;
    public $description;
    public $price;
    public $image_url;
    public $status = 'active';
    public $user_id;
    public $search = "";
    public $cant = 10;
    public $Id;

    public $cardIdToEdit;

    public function render()
    {
        if ($this->search != '') {
            $this->resetPage();
        }

        $this->totalRegistros = Card::count();

        $cards = Card::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate($this->cant);

        return view('livewire.t-c-g.card-component', [
            'cards' => $cards
        ]);
    }

    public function mount()
    {
        $this->totalRegistros = Card::count();
    }

    public function store()
    {
        $rules = [
            'name' => 'required|min:5|max:255|unique:cards',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|url',
            'status' => 'required|in:active,inactive',
        ];

        $messages = [
            'name.required' => 'El nombre es requerido.',
            'name.min' => 'El nombre debe tener mínimo 5 caracteres.',
            'name.max' => 'El nombre no debe superar 255 caracteres.',
            'name.unique' => 'El nombre de la carta ya está en uso.',
            'price.required' => 'El precio es requerido.',
            'price.numeric' => 'El precio debe ser un número.',
            'price.min' => 'El precio no puede ser negativo.',
            'image_url.url' => 'La URL de la imagen no es válida.',
            'status.required' => 'El estado es requerido.',
            'status.in' => 'El estado debe ser "active" o "inactive".',
        ];

        $this->validate($rules, $messages);

        $userId = Auth::id();

        if (!$userId) {
            $this->dispatch('msg', 'Error: No se ha encontrado un usuario autenticado.', 'error');
            return;
        }

        Card::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'image_url' => $this->image_url,
            'status' => $this->status,
            'user_id' => $userId,
        ]);

        $this->dispatch('close-modal', 'modalCard');
        $this->dispatch('msg', 'Carta creada correctamente');

        $this->reset(['name', 'description', 'price', 'image_url', 'status']);
    }

    // Método para cargar los datos de la carta a editar
    public function edit($cardId)
    {
        $this->reset(['name', 'description', 'price', 'image_url', 'status', 'cardIdToEdit']); // Limpia valores previos

        $card = Card::find($cardId);
        if ($card) {
            if ($card->user_id !== Auth::id()) {
                $this->dispatch('msg', 'No tienes permiso para editar esta carta.', 'error');
                return;
            }
            $this->cardIdToEdit = $card->id;
            $this->name = $card->name;
            $this->description = $card->description;
            $this->price = $card->price;
            $this->image_url = $card->image_url;
            $this->status = $card->status;

            // Emitir evento para abrir el modal
            $this->dispatch('open-modal', 'modalCard');
        } else {
            $this->dispatch('msg', 'Error: Carta no encontrada.', 'error');
        }
    }

    public function update()
    {
        $rules = [
            'name' => 'required|min:5|max:255|unique:cards,name,' . $this->cardIdToEdit,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|url',
            'status' => 'required|in:active,inactive',
        ];

        $messages = [
            'name.required' => 'El nombre es requerido.',
            'name.min' => 'El nombre debe tener mínimo 5 caracteres.',
            'name.max' => 'El nombre no debe superar 255 caracteres.',
            'name.unique' => 'El nombre de la carta ya está en uso.',
            'price.required' => 'El precio es requerido.',
            'price.numeric' => 'El precio debe ser un número.',
            'price.min' => 'El precio no puede ser negativo.',
            'image_url.url' => 'La URL de la imagen no es válida.',
            'status.required' => 'El estado es requerido.',
            'status.in' => 'El estado debe ser "active" o "inactive".',
        ];

        $this->validate($rules, $messages);

        $card = Card::find($this->cardIdToEdit);

        if ($card) {
            $card->update([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'image_url' => $this->image_url,
                'status' => $this->status,
            ]);

            $this->dispatch('close-modal', 'modalCard');
            $this->dispatch('msg', 'Carta actualizada correctamente.');

            // Resetear las propiedades
            $this->reset(['name', 'description', 'price', 'image_url', 'status', 'cardIdToEdit']);
        } else {
            $this->dispatch('msg', 'Error: Carta no encontrada.', 'error');
        }
    }

    public function openCreateModal()
    {
        $this->reset(['name', 'description', 'price', 'image_url', 'status', 'cardIdToEdit']); // Asegurar que sea creación
        $this->dispatch('open-modal', 'modalCard');
    }

    #[On('destroyCard')]
    public function destroy($id)
    {
        $card = Card::findOrfail($id);

        $card->delete();

        $this->dispatch('msg', 'Categoría borrada correctamente.');
    }

    public function delete($id)
    {
        $card = Card::find($id);

        if ($card && $card->user_id === Auth::id()) {
            $card->delete();
            $this->dispatch('msg', 'Carta eliminada correctamente.');
        } else {
            $this->dispatch('msg', 'Error: No tienes permiso para eliminar esta carta.', 'error');
        }
    }

    public function buyCard($cardId)
    {
        // Obtén la carta
        $card = Card::find($cardId);

        if (!$card) {
            $this->dispatch('msg', 'Error: Carta no encontrada.', 'error');
            return;
        }

        // Verifica que la carta esté activa y no sea del usuario autenticado
        if ($card->status === 'inactive' || $card->user_id === Auth::id()) {
            $this->dispatch('msg', 'No puedes comprar esta carta.', 'error');
            return;
        }

        // Obtén el ID del usuario autenticado
        $userId = Auth::id();

        // Crea la orden
        Order::create([
            'user_id' => $userId,
            'total_amount' => $card->price, 
            'status' => 'pending', 
        ]);

        // Cambia el estado de la carta a "inactiva"
        $card->update(['status' => 'inactive']);

        // Muestra un mensaje de éxito
        $this->dispatch('msg', 'Carta comprada correctamente.');
    }
}
