<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MyProfile extends Component
{
    public $nama, $email, $username;
    #[Validate('nullable|string|confirmed|min:8')]
    public $password;
    public function mount()
    {
        $this->nama     = Auth::user()->name;
        $this->email    = Auth::user()->email;
        $this->username = Auth::user()->username;
    }
    public function updateProfile()
    {
        if($this->password){
            auth()->user()->update(['password' => Hash::make($this->password)]);
        }

        auth()->user()->update([
            'name' => $this->nama,
            'email' => $this->email,
        ]);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Profile successfully updated!',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 1500,
            'progbar' => true,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('profile.show', navigate: true);
    }
    #[Title('My Profile')]
    public function render()
    {
        return view('livewire.my-profile');
    }
}
