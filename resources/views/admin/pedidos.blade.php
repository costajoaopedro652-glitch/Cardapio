<!DOCTYPE html>
<html lang="pt-BR">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Pedidos </title>

<script src="https://cdn.tailwindcss.com"></script>

<style>

body{
background:#0b0b0b;
color:white;
font-family:sans-serif;
}

.luz{
position:fixed;
width:350px;
height:350px;
background:#ff7a18;
filter:blur(160px);
opacity:0.25;
top:-120px;
left:-120px;
}

.card{
transition:0.3s;
}

.card:hover{
transform:scale(1.02);
}

@keyframes slideOut {
from {
opacity: 1;
transform: translateX(0);
}
to {
opacity: 0;
transform: translateX(120px);
}
}

.animate-slideOut {
animation: slideOut 0.5s ease forwards;
}

</style>

</head>

<body class="pb-24">

<div class="luz"></div>

<header class="flex justify-between items-center p-4 border-b border-neutral-800">

<h1 class="text-lg font-bold">
📦 Pedidos da Cozinha
</h1>

<a href="{{route('items.index')}}"
class="bg-orange-600 hover:bg-orange-700 px-3 py-1 rounded-lg text-sm">

⬅ Cardápio

</a>
<a href="{{route('admin')}}"
class="bg-orange-600 hover:bg-orange-700 px-3 py-1 rounded-lg text-sm">

⬅ voltar

</a>

</header>

<!-- NOTIFICAÇÃO -->

<div id="notificacaoPedidos"
class="text-red-400 font-bold text-center mt-4"></div>

<main class="px-4 mt-6 space-y-6">

@foreach ($orders as $order)

<div class="card bg-neutral-900 border border-neutral-800 rounded-xl p-5 shadow-lg">

<div class="flex justify-between items-center mb-3">

<h2 class="text-lg font-bold text-orange-400">
Quarto: {{ $order->user->name }}
</h2>

<span class="text-green-400 font-semibold">
Total: R$ {{ number_format($order->total,2,',','.') }}
</span>

</div>

<h3 class="text-gray-300 mb-2">
Itens do pedido:
</h3>

<ul class="space-y-1 text-gray-400">

@foreach ($order->order_items as $orderItem)

<li class="flex justify-between">

<span>
{{ $orderItem->quantidade }}x {{ $orderItem->item->name }}
</span>

</li>

@endforeach

</ul>

<form action="{{ route('FinalizarPedido', $order->id) }}" method="POST" class="mt-4">
@csrf

<button type="button"
onclick="finalizarPedido(this)"
class="w-full bg-green-600 hover:bg-green-700 transition p-2 rounded-lg font-semibold">

✅ Finalizar Pedido

</button>

</form>

</div>

@endforeach

</main>

<script>

function finalizarPedido(button){

const form = button.closest("form");
const card = button.closest(".card");

card.classList.add("animate-slideOut");

setTimeout(() => {
form.submit();
},500);

}


// verifica pedidos novos
function verificarPedidos(){

fetch('/admin/verificar-pedidos')

.then(response => response.json())

.then(data => {

const notificacao = document.getElementById("notificacaoPedidos");

if(data.pedidos > 0){

notificacao.innerHTML =
"🔔 " + data.pedidos + " pedidos aguardando na cozinha!";

}else{

notificacao.innerHTML = "";

}

})

.catch(error => console.log(error));

}


// roda quando abrir a página
verificarPedidos();


// roda a cada 5 segundos
setInterval(verificarPedidos,5000);

</script>

</body>
</html>