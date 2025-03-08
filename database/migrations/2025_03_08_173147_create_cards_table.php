<?php

namespace App\Livewire\TCG;

use App\Models\Card;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Cartas')]
class CardComponent extends Component
{
    public $totalRegistros = 0;
    public $name;
    public $description;
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
        $this->user_id = auth()->id(); // Asignar el ID del usuario autenticado
    }

    public function store()
    {
        $rules = [
            'name' => 'required|min:5|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|url',
            'status' => 'required|in:active,inactive',
        ];

        $messages = [
            'name.required' => 'El nombre es requerido',
            'name.min' => 'El nombre debe tener mínimo 5 caracteres',
            'name.max' => 'El nombre no debe superar 255 caracteres',
            'price.required' => 'El precio es requerido',
            'price.numeric' => 'El precio debe ser un número',
            'price.min' => 'El precio no puede ser negativo',
            'image_url.url' => 'La URL de la imagen no es válida',
            'status.required' => 'El estado es requerido',
            'status.in' => 'El estado debe ser "active" o "inactive"',
        ];

        $this->validate($rules, $messages);

        $card = new Card();
        $card->name = $this->name;
        $card->description = $this->description;
        $card->price = $this->price;
        $card->image_url = $this->image_url;
        $card->status = $this->status;
        $card->user_id = $this->user_id; // Asignar el ID del usuario autenticado
        $card->save();

        $this->dispatch('close-modal', 'modalCard');
        $this->dispatch('msg', 'Carta creada correctamente');

        $this->reset(['name', 'description', 'price', 'image_url', 'status']);
    }
}