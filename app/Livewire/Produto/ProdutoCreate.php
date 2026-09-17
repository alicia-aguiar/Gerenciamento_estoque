<?php

namespace App\Livewire\Produto;

use App\Models\Produto;
use Livewire\Component;

class ProdutoCreate extends Component
{

    public $nome;
    public $valor;
    public $caracteristicas;
    public $observacao;
    public $aplicacao;
    public $qtd_estoque;
    public $qtd_minima;

    public function store(){
        Produto::create([
            'nome' => $this->nome,
            'valor' => $this->valor,
            'caracteristicas' => $this->caracteristicas,
            'observacao' => $this->observacao,
            'aplicacao' => $this->aplicacao,
            'qtd_estoque' => $this->qtd_estoque,
            'qtd_minima' => $this->qtd_minima

        ]);

        session()->flash('sucess', 'Cadastrado');
        return redirect()->route('produto.index');
    }
    public function render()
    {
        return view('livewire.produto.produto-create');
    }
}
