<div class="flex h-screen bg-gray-50">
    <aside class="w-64 bg-slate-800 text-white p-6">
        <h1 class="text-xl font-bold mb-8">ConstruTech</h1>
        <nav class="space-y-4">
            <a href="#" class="block py-2 px-4 rounded bg-slate-700">Painel Principal</a>
            <a href="#" class="block py-2 px-4 rounded hover:bg-slate-700">Cadastrar Produto</a>
            <a href="#" class="block py-2 px-4 rounded hover:bg-slate-700">Movimentações</a>
        </nav>
    </aside>

    <main class="flex-1 p-8 overflow-y-auto">
        @foreach($products as $product)
            @if($product->current_stock <= $product->minimum_stock)
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded shadow-sm" role="alert">
                    <p class="font-bold">⚠️ Alerta de Estoque Crítico!</p>
                    <p>O produto <strong>{{ $product->name }}</strong> está com apenas {{ $product->current_stock }} unidades em estoque (Mínimo configurado: {{ $product->minimum_stock }}).</p>
                </div>
            @endif
        @endforeach
        
        <div class="bg-white p-6 rounded-lg shadow-sm border mb-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Materiais em Estoque</h2>
                <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">+ Novo Produto</button>
            </div>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 text-sm uppercase">
                        <th class="p-3">Produto</th>
                        <th class="p-3">Categoria</th>
                        <th class="p-3">Quantidade Atual</th>
                        <th class="p-3">Validade</th>
                        <th class="p-3">Ações</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @foreach($products as $product)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3 font-medium">{{ $product->name }}</td>
                        <td class="p-3">{{ $product->category }}</td>
                        <td class="p-3">
                            <span class="{{ $product->current_stock <= $product->minimum_stock ? 'text-red-600 font-bold' : '' }}">
                                {{ $product->current_stock }} {{ $product->unit_of_measure }}
                            </span>
                        </td>
                        <td class="p-3">{{ $product->expiration_date ? $product->expiration_date->format('d/m/Y') : 'N/A' }}</td>
                        <td class="p-3 space-x-2">
                            <button class="text-blue-600 hover:underline">Lançar Entrada/Saída</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</div>
