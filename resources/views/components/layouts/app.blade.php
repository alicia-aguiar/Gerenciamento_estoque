<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almoxarifado</title>
    
    <!-- Link Oficial do Bootstrap 5 (Aqui ele carrega globalmente) -->
    <link href="https://jsdelivr.net" rel="stylesheet">
    
    @livewireStyles
</head>
<body class="bg-body-tertiary">

    <!-- O Livewire vai injetar o formulário exatamente aqui dentro -->
    {{ $slot }}

    <!-- Script Oficial do Bootstrap -->
    <script src="https://jsdelivr.net"></script>
    
    @livewireScripts
</body>
</html>
