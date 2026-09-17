<?php

namespace App\Livewire\Produto;

use App\Models\Produto;
use Livewire\Component;

class ProdutoIndex extends Component
{
    public $search='';

public function delete($id){
    $produto = Produto::find($id);

    if($produto != null){
        $produto->delete();
        session()->flash('success', 'Excluído');
    }
}
    public function render()
    {
        $produtos = Produto::where('nome', 'like', '%'.$this->search. '%')->get();

        return view('livewire.produto.produto-index', compact('produtos'));
    }
}