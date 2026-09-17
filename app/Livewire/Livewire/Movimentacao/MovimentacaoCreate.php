<?php

namespace App\Livewire\Movimentacao;

use App\Models\Movimentacao;
use App\Models\Produto;
use Livewire\Component;

class MovimentacaoCreate extends Component
{
    public $produtos;
    public $idProdutoSelecionado;
    public $tipo = 'saida';
    public $quantidade_movimentacao;
    public $data_movimentacao;
    public $alertaEstoqueBaixo;
    
    public function mount(){
        $this->produtos = Produto::orderBy('nome')->get();
        $this->data_movimentacao = now()->format('Y-m-d');  
    }

    public function render()
    {
        return view('livewire.movimentacao.movimentacao-create');
    }

    public function store (){
        $produto = Produto::find($this->idProdutoSelecionado);
        
        if($produto->qtd_estoque < $this->quantidade_movimentacao && $this->tipo == 'saida'){
            $this->addError('quantidade_movimentacao', 'Quantidade em estoque insuficiente');
            return;
        }
        
        //Entrada de produtos
        if($this->tipo == 'entrada'){
            //$produto->qtd_estoque = $produto->qtd_estoque + $this->quantidade_movimentacao;
            $produto->qtd_estoque += $this->quantidade_movimentacao;
            //$produto->increment('qtd_estoque', $this->quantidade_movimentacao);
        }else{
            //$produto->qtd_estoque = $produto->qtd_estoque - $this->quantidade_movimentacao;
            $produto->qtd_estoque -= $this->quantidade_movimentacao;
            //$produto->decrement('qtd_estoque', $this->quantidade_movimentacao);
        }

        //Registrar movimentação
        Movimentacao::create([
            'quantidade'=> $this->quantidade_movimentacao,
            'data_movimentacao'=>$this->data_movimentacao,
            'tipo'=> $this->tipo,
            'produto_id'=> $this->idProdutoSelecionado,
            'user_id'=> 1
        ]);

        $produto->update();

        //Verificar estoque baixo
        $produto->refresh();
        if($produto->qtd_estoque < $produto->qtd_minima){
            $this->alertaEstoqueBaixo = "ALERTA: Estoque baixo para {$produto->nome}. Quantidade atual: {$produto->qtd_estoque}";

        }else{
            $this->alertaEstoqueBaixo = "";
        }

        session()->flash('message', 'Movimentação registrada com sucesso!');
        $this->reset(['quantidade_movimentacao', 'tipo']);
        $this->produtos = Produto::orderBy('nome')->get();
    }
}