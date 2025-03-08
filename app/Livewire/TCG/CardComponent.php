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

        // Obtener las cartas paginadas
        $cards = Card::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate($this->cant);

        // Pasar las cartas a la vista
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
            'name' => 'required | min:5 | max:255 | unique:categories',
        ];
        $messages = [
            'name.required' => 'El nombre es requerido',
            'name.min' => 'El nombre debe tener mínimo 5 caracteres',
            'name.max' => 'El nombre no debe superar 255 caracteres',
            'name.unique' => 'El nombre de la categoría ya está en uso'
        ];

        $this->validate($rules, $messages);

        $category = new Card();
        $category->name = $this->name;
        $category->save();

        $this->dispatch('close-modal', 'modalCategory');
        $this->dispatch('msg', 'Categoria creada correctamente');

        $this->reset(['name']);
    }
}
