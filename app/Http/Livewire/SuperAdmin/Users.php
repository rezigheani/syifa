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
    public $user_id;
    // modal edit
    public $editable = false;


    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
        $this->editable = !$this->editable;
        if (!$this->editable) {
            $this->redirect('#');
        }
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

    public function resetPassword(UserRepository $user, $user_id)
    {
        if (($isReset = $user->resetPassword($user_id))){
            $this->emit('alert', ['tipe' => 'success', 'body' => 'User : <b>' . $isReset->name . '</b> berhasil tereset <br> Password:'.$user->defaultPassword]);
        }else{
            $this->emit('alert', ['tipe' => 'warning', 'body' => 'User tidak ditemukan.']);
        }

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
