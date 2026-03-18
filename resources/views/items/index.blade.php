<!DOCTYPE html>
<html lang="pt-BR">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Food Premium</title>

<script src="https://cdn.tailwindcss.com"></script>

<style>

body{
background:#0b0b0b;
color:white;
font-family:sans-serif;
}

/* luz suave */

.luz{
position:fixed;
width:300px;
height:300px;
background:#ff7a18;
filter:blur(150px);
opacity:0.3;
top:-100px;
left:-100px;
}

/* animação */

.card{
transition:0.4s;
}

.card:active{
transform:scale(0.96);
}

</style>

</head>

<body class="pb-24">

<div class="luz"></div>

<!-- HEADER -->

<header class="flex justify-between items-center p-4">

<h1 class="text-lg font-bold">
🍴 FOOD PREMIUM
</h1>

<button class="text-sm bg-red-600 px-3 py-1 rounded-lg">
<a href="{{route('cart.index')}}">🛒carrinho</a>
</button>

</header>

<!-- HERO -->

<section class="text-center mt-6 px-6">

<h2 class="text-3xl font-bold mb-4">

Experiência Gastronômica

</h2>

<p class="text-gray-400 text-sm">

Escolha sua refeição e faça seu pedido online.

</p>

</section>

<!-- CARDÁPIO -->

<section class="mt-8 px-4 space-y-5">

<!-- café -->

<a href="{{route('cardapioManha')}}" class="card block bg-neutral-900 rounded-xl overflow-hidden shadow-lg">

<img src="https://images.unsplash.com/photo-1499636136210-6f4ee915583e"
class="w-full h-36 object-cover">

<div class="p-4">

<h3 class="text-lg font-bold">
☕ Café da manhã
</h3>

<p class="text-gray-400 text-sm">
Comece seu dia com energia
</p>

</div>

</a>

<!-- almoço -->

<a href="{{route('cardapioAlmoço')}}" class="card block bg-neutral-900 rounded-xl overflow-hidden shadow-lg">

<img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38"
class="w-full h-36 object-cover">

<div class="p-4">

<h3 class="text-lg font-bold">
🍔 Almoço
</h3>

<p class="text-gray-400 text-sm">
Pratos completos e saborosos
</p>

</div>

</a>

<!-- tarde -->

<a href="{{route('cardapioTarde')}}" class="card block bg-neutral-900 rounded-xl overflow-hidden shadow-lg">

<img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085"
class="w-full h-36 object-cover">

<div class="p-4">

<h3 class="text-lg font-bold">
🍰 Café da tarde
</h3>

<p class="text-gray-400 text-sm">
Doces e cafés especiais
</p>

</div>

</a>

<!-- janta -->

<a href="{{route('cardapioNoite')}}" class="card block bg-neutral-900 rounded-xl overflow-hidden shadow-lg">

<img src="https://images.unsplash.com/photo-1544025162-d76694265947"
class="w-full h-36 object-cover">

<div class="p-4">

<h3 class="text-lg font-bold">
🍝 Jantar
</h3>

<p class="text-gray-400 text-sm">
Refeições especiais da noite
</p>

</div>

</a>

</section>

<!-- BOTÃO CARRINHO -->


<!-- FINAL -->

<footer class="mt-10 py-6 text-center border-t border-neutral-800">

<h2 class="text-xl font-bold text-red-500">
🍔 Pousada Iramaia
</h2>

<p class="text-gray-400 text-sm mt-2">
 O Sabor Que Conquista 🍟
</p>

<p class="text-gray-500 text-xs mt-2">
© 2026 Todos os direitos reservados
</p>

</footer>
</body>
</html>