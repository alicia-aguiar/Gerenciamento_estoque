<div style="min-height: 100vh; width: 100vw; background-color: #f4f7fc; position: absolute; top: 0; left: 0; padding: 40px; box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
    
    <!-- BARRA SUPERIOR (HEADER) -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 1px solid #e2e8f0; padding-bottom: 20px;">
        <div>
            <h2 style="margin: 0; font-size: 1.8rem; font-weight: 700; color: #1e293b;">🏗️ Almoxarifado Central</h2>
            <p style="margin: 5px 0 0 0; color: #64748b; font-size: 0.95rem;">Controle de Entrada, Saída e Monitoramento Rígido de Materiais</p>
        </div>
        <a href="{{ route('produto.create') }}" style="background-color: #0091ff; color: #ffffff; text-decoration: none; padding: 12px 24px; border-radius: 10px; font-weight: 500; font-size: 0.95rem; box-shadow: 0 4px 12px rgba(0, 145, 255, 0.15);">
            + Cadastrar Novo Material
        </a>
    </div>

    <!-- ⚠️ MECANISMO DE ALERTA AUTOMÁTICO DE ESTOQUE MÍNIMO -->
    @if(isset($produtos))
        @foreach($produtos as $prod)
            @if(($prod->quantidade_atual ?? 0) <= ($prod->estoque_minimo ?? 0))
                <div style="background-color: #fff1f2; border-left: 6px solid #f43f5e; color: #9f1239; padding: 16px 20px; border-radius: 12px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 6px rgba(0,0,0,0.02);">
                    <div>
                        <strong style="display: block; font-size: 1rem; margin-bottom: 2px;">⚠️ Alerta de Estoque Mínimo Atingido!</strong>
                        <span style="font-size: 0.9rem;">O material <strong style="text-decoration: underline;">{{ $prod->nome }}</strong> possui apenas <strong>{{ $prod->quantidade_atual ?? 0 }} {{ $prod->unidade_medida }}</strong> em estoque (Limite mínimo configurado: {{ $prod->estoque_minimo }}).</span>
                    </div>
                    <span style="background-color: #ffe4e6; color: #b91c1c; padding: 6px 12px; border-radius: 6px; font-size: 0.8rem; font-weight: 700; text-transform: uppercase;">Repor Urgente</span>
                </div>
            @endif
        @endforeach
    @endif

    <!-- CONTEÚDO EM DUAS COLUNAS -->
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
        
        <!-- COLUNA DA ESQUERDA: LISTAGEM E CADASTRO -->
        <div style="background-color: #ffffff; border-radius: 20px; padding: 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.02); box-sizing: border-box;">
            <h3 style="margin: 0 0 20px 0; font-size: 1.3rem; font-weight: 600; color: #1e293b;">Materiais Cadastrados</h3>
            
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="border-bottom: 2px solid #f1f5f9; color: #64748b; font-size: 0.85rem; text-transform: uppercase; font-weight: 600;">
                        <th style="padding: 12px 10px;">Material</th>
                        <th style="padding: 12px 10px;">Aplicação</th>
                        <th style="padding: 12px 10px;">Quantidade</th>
                        <th style="padding: 12px 10px;">Especificações</th>
                        <th style="padding: 12px 10px;">Validade</th>
                        <th style="padding: 12px 10px; text-align: center;">Ações</th>
                    </tr>
                </thead>
                <tbody style="font-size: 0.95rem; color: #334155;">
                    @if(isset($produtos) && count($produtos) > 0)
                        @foreach($produtos as $prod)
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="padding: 16px 10px; font-weight: 600; color: #0f172a;">{{ $prod->nome }}</td>
                                <td style="padding: 16px 10px;"><span style="background-color: #f1f5f9; color: #475569; padding: 4px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: 500;">{{ $prod->categoria }}</span></td>
                                <td style="padding: 16px 10px; font-weight: 700; color: {{ ($prod->quantidade_atual ?? 0) <= ($prod->estoque_minimo ?? 0) ? '#dc2626' : '#16a34a' }};">
                                    {{ $prod->quantidade_atual ?? 0 }} {{ $prod->unidade_medida }}
                                </td>
                                <td style="padding: 16px 10px; color: #64748b; font-size: 0.85rem;">{{ $prod->cor ?? 'Padrão' }} | {{ $prod->textura ?? 'N/A' }}</td>
                                <td style="padding: 16px 10px; font-size: 0.85rem; color: #475569;">{{ $prod->data_validade ? date('d/m/Y', strtotime($prod->data_validade)) : 'Sem vencimento' }}</td>
                                <td style="padding: 16px 10px; text-align: center;">
                                    <button style="background: none; border: 1px solid #e2e8f0; color: #0091ff; padding: 6px 14px; border-radius: 6px; font-size: 0.85rem; font-weight: 500; cursor: pointer;">Lançar</button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" style="padding: 40px text-align: center; color: #94a3b8; font-style: italic;">
                                Nenhum material cadastrado no sistema do almoxarifado.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- COLUNA DA DIREITA: HISTÓRICO RECENTE (RASTREABILIDADE) -->
        <div style="background-color: #ffffff; border-radius: 20px; padding: 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.02); box-sizing: border-box; height: fit-content;">
            <h3 style="margin: 0; font-size: 1.3rem; font-weight: 600; color: #1e293b;">Histórico de Movimentações</h3>
            <p style="margin: 4px 0 25px 0; color: #64748b; font-size: 0.85rem;">Rastreabilidade completa de auditoria do estoque</p>

            <div style="border-left: 2px solid #e2e8f0; padding-left: 20px; margin-left: 10px;">
                @if(isset($movimentacoes) && count($movimentacoes) > 0)
                    @foreach($movimentacoes as $mov)
                        <div style="margin-bottom: 25px; position: relative;">
                            <span style="position: absolute; width: 10px; height: 10px; border-radius: 50%; background-color: {{ $mov->tipo == 'entrada' ? '#16a34a' : '#dc2626' }}; left: -26px; top: 5px; box-shadow: 0 0 0 4px #ffffff;"></span>
                            <div style="display: flex; justify-content: space-between; font-size: 0.85rem; font-weight: 600; color: #334155; margin-bottom: 4px;">
                                <span style="text-transform: capitalize;">{{ $mov->tipo }} - {{ $mov->produto->nome ?? 'Material' }}</span>
                                <span style="color: #94a3b8; font-weight: 400;">{{ date('d/m H:i', strtotime($mov->created_at)) }}</span>
                            </div>
                            <p style="margin: 0; font-size: 0.85rem; color: #64748b;">
                                Qtd: <strong>{{ $mov->quantidade }}</strong> <br>
                                Responsável: <span style="color: #0f172a; font-family: monospace;">{{ $mov->user->name ?? 'Sistema' }}</span>
                            </p>
                        </div>
                    @endforeach
                @else
                    <p style="color: #94a3b8; font-style: italic; font-size: 0.9rem; margin: 0;">Nenhuma movimentação lançada até o momento.</p>
                @endif
            </div>
        </div>

    </div>
</div>
