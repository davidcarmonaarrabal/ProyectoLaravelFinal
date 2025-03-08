<?php

namespace App\Livewire\TCG;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Cartas')]
class CardComponent extends Component
{
    public function render()
    {
        return view('livewire.t-c-g.card-component');
    }
}
