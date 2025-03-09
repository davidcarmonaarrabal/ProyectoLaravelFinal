<?php

namespace App\Livewire\Dashboard;

use App\Models\Animal;
use App\Models\Cultivo;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;
#[Title('Inicio')]
class DashboardComponent extends Component
{
    public function mount()
    {

    }

    public function render()
    {
        return view('livewire.dashboard.dashboard-component');
    }
}
