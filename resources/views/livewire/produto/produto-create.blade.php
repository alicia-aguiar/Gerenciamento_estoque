<div style="min-height: 100vh; width: 100vw; background-color: #eef4fc; position: absolute; top: 0; left: 0; padding: 40px; box-sizing: border-box; display: flex; justify-content: center; align-items: center; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
    
    <div style="background-color: #ffffff; border-radius: 24px; max-width: 700px; width: 100%; padding: 40px; box-shadow: 0 12px 40px rgba(0,0,0,0.04); box-sizing: border-box;">
        
        <div style="border-bottom: 1px solid #edf2f7; padding-bottom: 20px; margin-bottom: 30px; text-align: left;">
            <h2 style="margin: 0; font-size: 1.5rem; font-weight: 700; color: #1a202c;">Novo Material de Construção</h2>
            <p style="margin: 5px 0 0 0; color: #718096; font-size: 0.9rem;">Insira as especificações do lote, controle de validade e gatilhos mínimos.</p>
        </div>

        <!-- Mensagens Visuais de Erro da Validação do Livewire -->
        @if ($errors->any())
            <div style="background-color: #f8d7da; color: #842029; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c2c7; text-align: left;">
                <strong style="display: block; margin-bottom: 5px;">⚠️ Por favor, corrija os seguintes campos:</strong>
                <ul style="margin: 0; padding-left: 20px; font-size: 0.9rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form wire:submit.prevent="store" style="margin: 0; padding: 0; text-align: left;">
            @csrf

            <!-- Linha 1: Nome do Produto -->
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 0.95rem; font-weight: 600; color: #2d3748; margin-bottom: 8px;">Nome do Produto</label>
                <input type="text" wire:model="nome" style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e0; border-radius: 8px; font-size: 0.95rem; box-sizing: border-box; outline: none;" placeholder="Ex: Cimento CP II Votoran 50kg" required>
            </div>

            <!-- Linha 2: Duas Colunas (Categoria/Aplicação e Observação como Unidade) -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; font-size: 0.95rem; font-weight: 600; color: #2d3748; margin-bottom: 8px;">Categoria / Aplicação</label>
                    <select wire:model="aplicacao" style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e0; border-radius: 8px; font-size: 0.95rem; box-sizing: border-box; background-color: white;" required>
                        <option value="">Selecione...</option>
                        <option value="Fundação">Fundação (Ex: Cimento, Areia)</option>
                        <option value="Acabamento">Acabamento (Ex: Tintas, Argamassa)</option>
                        <option value="Estrutura">Estrutura (Ex: Ferragens, Vigas)</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 0.95rem; font-weight: 600; color: #2d3748; margin-bottom: 8px;">Unidade de Medida</label>
                    <input type="text" wire:model="observacao" style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e0; border-radius: 8px; font-size: 0.95rem; box-sizing: border-box;" placeholder="Ex: Saco, KG, Litro, Unidade" required>
                </div>
            </div>

            <!-- Linha 3: Duas Colunas (Estoque Mínimo e Valor fictício para casar com a tabela) -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                <div>
                    <label style="display: block; font-size: 0.95rem; font-weight: 600; color: #2d3748; margin-bottom: 8px;">Estoque Mínimo (Gatilho Alerta)</label>
                    <input type="number" wire:model="qtd_minima" style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e0; border-radius: 8px; font-size: 0.95rem; box-sizing: border-box;" min="0" placeholder="Ex: 10" required>
                </div>
                <div>
                    <label style="display: block; font-size: 0.95rem; font-weight: 600; color: #2d3748; margin-bottom: 8px;">Preço Estimado (R$)</label>
                    <input type="number" step="0.01" wire:model="valor" style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e0; border-radius: 8px; font-size: 0.95rem; box-sizing: border-box;" placeholder="Ex: 35.50">
                </div>
            </div>

            <!-- CARD INTERNO: CARACTERÍSTICAS COMPLEXAS (Mapeado para a coluna 'caracteristicas') -->
            <div style="background-color: #f7fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; margin-bottom: 30px;">
                <h4 style="margin: 0 0 15px 0; font-size: 0.95rem; color: #4a5568; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Características & Variações Complexas</h4>
                <div style="display: grid; grid-template-columns: 1fr; gap: 15px;">
                    <div>
                        <label style="display: block; font-size: 0.85rem; color: #718096; margin-bottom: 6px;">Descrição Detalhada das Variações (Cor, Textura, Peso)</label>
                        <input type="text" wire:model="caracteristicas" style="width: 100%; padding: 12px; border: 1px solid #cbd5e0; border-radius: 6px; font-size: 0.9rem; box-sizing: border-box;" placeholder="Ex: Cor Cinza, Textura Fina, Peso 50kg">
                    </div>
                </div>
            </div>

            <!-- BOTÕES DE AÇÃO -->
            <div style="display: flex; justify-content: flex-end; gap: 15px; border-top: 1px solid #edf2f7; padding-top: 20px;">
                <a href="{{ route('produto.index') }}" style="background-color: #f7fafc; color: #4a5568; text-decoration: none; border: 1px solid #cbd5e0; padding: 12px 24px; border-radius: 10px; font-weight: 500; font-size: 0.95rem;">Cancelar</a>
                <button type="submit" style="background-color: #0091ff; color: #ffffff; border: none; padding: 12px 30px; border-radius: 10px; font-weight: 600; font-size: 0.95rem; cursor: pointer; box-shadow: 0 4px 12px rgba(0, 145, 255, 0.15);">Salvar Material</button>
            </div>

        </form>
    </div>
</div>
