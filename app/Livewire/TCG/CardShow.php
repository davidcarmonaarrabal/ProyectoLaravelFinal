<?php

namespace App\Livewire\TCG;

use App\Models\Card;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Detalles de la Carta')]
class CardShow extends Component
{
    public $card;

    public function mount($card)
    {
        $this->card = Card::findOrFail($card);
    }

    public function render()
    {
        return view('livewire.t-c-g.card-show', [
            'card' => $this->card
        ]);
    }
}
