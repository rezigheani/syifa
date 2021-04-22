<?php

namespace App\Http\Livewire\SuperAdmin;

use App\Models\User;
use App\Repository\SuperAdmin\User\UserRepository;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $role;
    public $name;

    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->name . '%')
            ->paginate(10);
        return view('livewire.super-admin.users', [
            'table' => $users
        ]);
    }

    public function mount(UserRepository $user)
    {
        $this->user = $user;
    }

    public function removeUser(UserRepository $user, $user_id)
    {
        $isDeleted = $user->remove($user_id);
        if ($isDeleted) {
            $this->emit('alert', ['tipe' => 'success', 'body' => 'User : <b>' . $isDeleted->name . '</b> berhasil terhapus']);
        } else {
            $this->emit('alert', ['tipe' => 'warning', 'body' => 'User tidak ditemukan.']);

        }

    }
}
