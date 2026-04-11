@extends('items.layout')

@section('content')

<h1 class="text-9xl text-center mb-12 text-red-400" style="font-family: 'Playfair Display', serif; font-weight: 700;">
🍽 Cardápio
</h1>

<div class="space-y-12">

@foreach($items as $index => $item)

<div
style="animation-delay: {{ $index * 0.12 }}s"
class="card bg-neutral-900 border border-neutral-800 rounded-3xl shadow-2xl p-12 animate-slideIn transform transition duration-300 hover:scale-105 hover:border-red-500">

<h3 class="text-5xl font-bold text-white">
{{ $item->name }}
</h3>

<p class="text-gray-300 text-2xl mt-3">
{{ $item->description }}
</p>

<p class="text-red-400 font-bold mt-6 text-4xl">
R$ {{ number_format($item->price, 2, ',', '.') }}
</p>

@if($item->is_available)

<form action="{{ route('items.store') }}" method="POST" class="mt-8">
@csrf

<input type="hidden" name="item_id" value="{{ $item->id }}">

<button
class="w-full bg-red-600 hover:bg-red-700 transition p-6 rounded-xl font-bold text-2xl transform hover:scale-105 active:scale-95">

Adicionar ao pedido

</button>

</form>

@else

<span class="text-red-500 font-semibold text-2xl">
Indisponível
</span>

@endif

</div>
@can('ver pedidos')
<button
class="w-full bg-green-600 hover:bg-orange-700 transition p-2 rounded-lg font-semibold">

<a href="{{route('items.editar',$item->id)}}">editar item</a>

</button>
@endcan
@endforeach

</div>

<!-- BOTÕES -->

<div class="flex gap-8 mt-12">

<a href="{{route('cart.index')}}"
class="flex-1 text-center bg-red-600 hover:bg-red-700 p-6 rounded-xl font-bold text-2xl transition transform hover:scale-105">

🛒 Ir para Carrinho

</a>



<a href="{{ route('items.index') }}"
class="flex-1 text-center bg-gray-700 hover:bg-gray-800 p-6 rounded-2xl font-bold text-2xl transition transform hover:scale-105">

⬅ Voltar

</a>
@can('ver pedidos')
<a href="{{route('items.criar')}}"
class="flex-1 text-center bg-red-600 hover:bg-red-700 p-6 rounded-xl font-bold text-2xl transition transform hover:scale-105">

🛒 criar item

</a>
@endcan
</div>

@endsection