<?php

namespace App\Livewire\Users;

use Hash;
use App\Models\User;
use App\Models\Company;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Spatie\Permission\Models\Role;

class UserCreate extends Component
{
    public $userId='', $password='', $name, $company, $email, $phone, $position;
    public function create()
    {
        $this->userId = (string) Str::orderedUuid();
        $this->password = Hash::make('Test1234!');
        $user = User::create([
            'userId'=> $this->userId,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);
        $user->assignRole($this->position);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'User created Successfully!',
            'toast' => false,
            'position' => 'center',
            'timer' => 1500,
            'showConfirmButton' => false,
        ]);

        return $this->redirectRoute('users.index', navigate:true);
    }
    #[Title('Create New User')]
    public function render()
    {
        return view('livewire.users.user-create',[
            'roles' => Role::all(),
        ]);
    }
}
