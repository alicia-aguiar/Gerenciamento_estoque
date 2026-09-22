<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    // Propriedades vinculadas ao formulário via wire:model
    public $email;
    public $password;
    public $remember = false;

    // Regras de validação em tempo real do Laravel
    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    protected $messages = [
        'email.required' => 'O campo de e-mail é obrigatório.',
        'email.email' => 'Insira um formato de e-mail válido.',
        'password.required' => 'A senha é obrigatória.',
    ];

    // O método assíncrono que o formulário chama ao enviar os dados
    public function autenticar()
    {
        $this->validate();

        // Tenta realizar o login utilizando o sistema de autenticação nativo
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            // Se as credenciais estiverem corretas, redireciona para a gestão de estoque
            return redirect()->route('produto.index');
        }

        // Se falhar, emite uma mensagem flash capturada pelo Blade
        session()->flash('error', 'As credenciais informadas estão incorretas.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
