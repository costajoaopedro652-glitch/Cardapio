@extends('items.layout')

@section('content')

<h1 class="text-3xl font-bold text-center mb-8 text-orange-400">
🍽 Cardápio
</h1>

<div class="space-y-5">

@foreach($items as $item)

<div class="card bg-neutral-900 border border-neutral-800 rounded-xl shadow-lg p-5">

<h3 class="text-xl font-bold text-white">
{{ $item->name }}
</h3>

<p class="text-gray-400 text-sm mt-1">
{{ $item->description }}
</p>

<p class="text-orange-400 font-bold mt-2 text-lg">
R$ {{ number_format($item->price, 2, ',', '.') }}
</p>

@if($item->is_available)

<form action="{{ route('items.store') }}" method="POST" class="mt-4">
@csrf

<input type="hidden" name="item_id" value="{{ $item->id }}">

<button
class="w-full bg-orange-600 hover:bg-orange-700 transition p-2 rounded-lg font-semibold">

Adicionar ao pedido

</button>

</form>

@else

<span class="text-red-500 font-semibold text-sm">
Indisponível
</span>

@endif

</div>

@endforeach

</div>

<!-- BOTÕES -->

<div class="flex gap-4 mt-8">

<a href="{{route('cart.index')}}"
class="flex-1 text-center bg-orange-600 hover:bg-orange-700 p-3 rounded-lg font-bold transition">

🛒 Ir para Carrinho

</a>

<a href="{{route('pagina.admin')}}"
class="flex-1 text-center bg-neutral-800 hover:bg-neutral-700 p-3 rounded-lg font-bold transition">

📦 Ver Pedidos

</a>

</div>
@can('ver pedidos')
<a href="{{route('items.criar')}}"
class="flex-1 text-center bg-red-600 hover:bg-red-700 p-6 rounded-xl font-bold text-2xl transition transform hover:scale-105">

🛒 criar item

</a>
@endcan
@endsection