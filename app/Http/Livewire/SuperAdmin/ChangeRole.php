<?php

namespace App\Http\Livewire\SuperAdmin;

use App\Models\User;
use Livewire\Component;

class ChangeRole extends Component
{
    public $user_id;
    public $role;
    public $rules = [
        'role' => 'required'
    ];

    public function updated()
    {

        $user = User::find($this->user_id);
        if ($user) {

            $user->syncRoles(explode(',',$this->role));
            $this->emit('alert', ['tipe' => 'success', 'body' => 'Hak akses berhasil diubah.']);
        } else {
            $this->emit('alert', ['tipe' => 'warning', 'body' => 'User tidak ditemukan.']);

        }

    }

    public function render()
    {
        return view('livewire.super-admin.change-role');
    }

    public function mount()
    {
        $this->role = User::find($this->user_id)->getRoleNames()->implode('', '.');
    }
}
