<div>
    <div class="card">
        <div class= "card-header">
            <h5>Movimentações</h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <input type= "text" wire:model.live ="search" placeholder="Pesquisar..." class="form-control">
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Usuario</th>
                        <th>Data Movimentacao</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movimentacoes as $m)
                        <tr>
                            <td>
                                @if ($m->tipo == 'entrada')
                                <span class ="badge bg-primary">Entrada</span>
                                @else
                                <span class="badge bg-danger">Saída</span>
                                @endif
                            </td>
                             <td>{{ $m->produto_id}} - {{ $m->produto->nome }}</td>
                            <td>{{ $m->quantidade }}</td>
                            <td>{{ $m->user_id}} - {{ $m->user->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($m->data_movimentacao)->format('d/m/Y') }}</td>
                            <td><button wire:click='delete({{ $m->id }})'
                                    class='btn btn-sm btn-danger'>Excluir</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>