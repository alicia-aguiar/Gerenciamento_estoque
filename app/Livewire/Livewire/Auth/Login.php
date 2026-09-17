<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{

    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' =>'required'
    ];

    protected $messages = [
        'email.required' => 'campo email obrigatório',
        'email.email' => 'formato de email incorreto',
        'password.required' => 'campo senha obrigatório'
    ];
    
    public function login(){
        $this->validate();

        if(Auth::attempt([
            'email' =>$this->email,
            'password' =>$this->password
        ])){
            session()->regenerate();

            return redirect()->route('movimentacao.index');
        }

        session()->flash('error', 'email ou senha incorretos');
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}