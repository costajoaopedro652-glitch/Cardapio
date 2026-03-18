@extends('items.layout')

@section('content')

<h1 class="text-7xl font-bold text-center mb-10 text-red-500">
🛒 Meu Pedido
</h1>

@if(count($orderItems) == 0)

<div class="text-center mt-10">

<p class="text-gray-400 text-xl">
Seu carrinho está vazio.
</p>

<a href="{{ route('items.index') }}"
class="inline-block mt-6 bg-red-600 hover:bg-red-700 px-7 py-3 rounded-xl font-bold text-lg transition transform hover:scale-105">

Ver Cardápio

</a>

</div>

@else

<div class="space-y-6">

@foreach($orderItems as $index => $orderItem)

<div
style="animation-delay: {{ $index * 0.1 }}s"
class="cart-item bg-neutral-900 p-7 rounded-2xl shadow-lg border border-neutral-800 min-h-[120px]
transform transition duration-200 hover:scale-[1.02] animate-slideIn">

<div class="flex justify-between items-center">

<div>

<h3 class="text-4xl font-bold text-white">
{{ $orderItem->item->name }}
</h3>

<p class="text-gray-400 text-lg mt-2">
Quantidade: {{ $orderItem->quantidade }}
</p>

<p class="text-red-500 font-bold text-2xl mt-2">
R$ {{ number_format($orderItem->item->price, 2, ',', '.') }}
</p>

</div>

<form action="{{ route('items.destroy', $orderItem->id) }}" method="POST">
@csrf
@method('DELETE')

<button
type="button"
onclick="removeItem(this)"
class="bg-red-600 hover:bg-red-700 px-6 py-3 rounded-lg text-base font-bold transition transform hover:scale-105 active:scale-95">

Remover

</button>

</form>

</div>

</div>

@endforeach

</div>

<!-- TOTAL -->

<div class="mt-10 bg-neutral-900 p-7 rounded-2xl shadow-lg border border-neutral-800">

<div class="flex justify-between items-center text-2xl font-bold">

<span>Total</span>

<span class="text-green-500">
R$ {{ number_format($total, 2, ',', '.') }}
</span>

</div>

</div>

<!-- BOTÕES -->

<div class="flex gap-4 mt-8">

<a href="{{ route('items.index') }}"
class="flex-1 text-center bg-gray-700 hover:bg-gray-800 p-4 rounded-xl font-semibold text-lg transition transform hover:scale-105">

⬅ Voltar

</a>

<form action="{{ route('confirmarPedido') }}" method="POST" class="flex-1">
@csrf

<button
class="w-full bg-green-600 hover:bg-green-700 p-4 rounded-xl font-bold text-lg transition transform hover:scale-105 active:scale-95">

✅ Confirmar Pedido

</button>

</form>

</div>

@endif


<style>
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


<script>
function removeItem(button){

    const form = button.closest("form");
    const card = button.closest(".cart-item");

    card.classList.remove("animate-slideIn");
    card.classList.add("animate-slideOut");

    setTimeout(() => {
        form.submit();
    }, 500);

}
</script>

@endsection