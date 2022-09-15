<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Home extends Component
{
    public $username, $email, $password, $password_confirmation;
    public $checkPassword;
    protected $rules = [
        'email' => 'required|min:3|email|unique:users,email',
        'password' => 'required|min:6|alpha_num',
        'username' => 'unique:users,username|min:6|required|alpha_num',

    ];
    public function render()
    {
        return view('livewire.home')->layout('layouts.apps');
    }

    public function registerHandler()
    {

        $this->validate();
        if ($this->password == $this->password_confirmation) {
            $user = User::create([
                'email' => $this->email,
                'username' => $this->username,
                'password' => Hash::make($this->password),
            ]);
            Auth::login($user);
            return redirect()->route('dashboard');
        }
    }

    public function loginHandler()
    {
        $attr =  $this->validate([
            'password' => 'required',
            'email' => 'required|email',
        ]);
        if (Auth::attempt($attr)) {
            redirect()->route('dashboard');
        }
        // dd('hy');
        throw ValidationException::withMessages([
            'email' => 'Mungkin Email Yang Anda Masukkan Salah?',
            'password' => 'Pasword anda salah'
        ]);
    }
    public function typePassword()
    {

        if ($this->password == $this->password_confirmation) {
            $this->checkPassword = true;
        } else {
            $this->checkPassword = false;
        }
    }
}