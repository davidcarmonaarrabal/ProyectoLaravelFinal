<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileComponent extends Component
{
    public $user;
    public $name;
    public $email;
    public $password;
    public $canEdit = false;

    public function mount($userId)
    {
        $this->user = User::findOrFail($userId);

        $this->name = $this->user->name;
        $this->email = $this->user->email;

        if (Auth::id() === $this->user->id) {
            $this->canEdit = true;
        }
    }

    public function updateProfile()
    {
        if (!$this->canEdit) {
            session()->flash('error', 'No tienes permiso para editar este perfil.');
            return;
        }

        $this->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'password' => 'nullable|min:6',
        ]);

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password ? Hash::make($this->password) : $this->user->password,
        ]);

        session()->flash('message', 'Perfil actualizado con éxito.');
    }

    public function render()
    {
        return view('livewire.user.profile-component');
    }
}
