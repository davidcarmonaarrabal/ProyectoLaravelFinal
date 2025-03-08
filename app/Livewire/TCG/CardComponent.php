<?php

namespace App\Livewire\TCG;

use App\Models\Card;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth; // Asegurar la importación

#[Title('Cartas')]
class CardComponent extends Component
{
    public $totalRegistros = 0;
    public $name;
    public $description; // Declarar la propiedad description
    public $price;
    public $image_url;
    public $status = 'active';
    public $user_id; // Asignar automáticamente el ID del usuario autenticado
    use WithPagination;
    public $search = "";
    public $cant = 10;
    public $Id;

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
            'name.required' => 'El nombre es requerido',
            'name.min' => 'El nombre debe tener mínimo 5 caracteres',
            'name.max' => 'El nombre no debe superar 255 caracteres',
            'name.unique' => 'El nombre de la carta ya está en uso',
            'price.required' => 'El precio es requerido',
            'price.numeric' => 'El precio debe ser un número',
            'price.min' => 'El precio no puede ser negativo',
            'image_url.url' => 'La URL de la imagen no es válida',
            'status.required' => 'El estado es requerido',
            'status.in' => 'El estado debe ser "active" o "inactive"',
        ];
    
        $this->validate($rules, $messages);
    
        // Asignar el ID del usuario autenticado
        $userId = Auth::id(); // O bien auth()->id();
    
        if (!$userId) {
            $this->dispatch('msg', 'Error: No se ha encontrado un usuario autenticado', 'error');
            return;
        }
    
        Card::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'image_url' => $this->image_url,
            'status' => $this->status,
            'user_id' => $userId, // Ahora se asigna correctamente
        ]);
    
        $this->dispatch('close-modal', 'modalCard');
        $this->dispatch('msg', 'Carta creada correctamente');
    
        $this->reset(['name', 'description', 'price', 'image_url', 'status']);
    }
    
}