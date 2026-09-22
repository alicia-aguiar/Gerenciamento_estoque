<?php

namespace App\Livewire\Produto;

use App\Models\Produto;
use Livewire\Component;

class ProdutoCreate extends Component
{
    // Variáveis que já estão na sua classe (vistas na imagem)
    public $nome;
    public $valor;
    public $caracteristicas;
    public $observacao;
    public $aplicacao;
    public $qtd_estoque = 0; // Começa zerado por padrão
    public $qtd_minima;

    public function store()
    {
        // 1. Validação usando os nomes exatos das suas variáveis
        $this->validate([
            'nome' => 'required|min:3',
            'aplicacao' => 'required',
            'qtd_minima' => 'required|numeric',
        ]);

        // 2. Inserção no banco mapeando as colunas reais da sua tabela (vistas no INSERT do erro)
        Produto::create([
            'nome'            => $this->nome,
            'valor'           => $this->valor ?: 0,
            'caracteristicas' => $this->caracteristicas,
            'observacao'      => $this->observacao,
            'aplicacao'       => $this->aplicacao,
            'qtd_estoque'     => $this->qtd_estoque ?: 0,
            'qtd_minima'      => $this->qtd_minima,
        ]);

        // 3. Mensagem flash e redirecionamento para a listagem
        session()->flash('message', 'Material cadastrado com sucesso!');
        return redirect()->route('produto.index');
    }

    public function render()
    {
        return view('livewire.produto.produto-create');
    }
}
