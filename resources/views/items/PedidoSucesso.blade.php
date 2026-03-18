<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body class="pb-24 bg-gradient-to-b from-black via-neutral-900 to-orange-950 text-white">
    <div class="min-h-screen pb-24 bg-gradient-to-b from-black via-neutral-900 to-orange-950 text-white"><script src="https://cdn.tailwindcss.com"></script>
<div class="min-h-screen pb-24 bg-gradient-to-b from-black via-neutral-900 to-green-950 text-white p-10">

    <div class="text-green-500 text-6xl mb-4">
        ✔
    </div>

    <h1 class="text-2xl font-bold text-gray-800 mb-2">
        Pedido realizado com sucesso!
    </h1>

    <p class="text-gray-600 mb-6">
        Seu pedido foi enviado para a cozinha.  
        Aguarde enquanto preparamos tudo para você 🍽️
    </p>

    <a href="{{ route('items.index') }}"
       class="bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-3 rounded-lg transition">
        Voltar para o cardápio
    </a>

</div>
</div>
</body>
</html>