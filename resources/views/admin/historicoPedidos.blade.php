@extends('items.layout')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12">

    <h1 class="text-4xl font-bold mb-10 text-center">
        📦 Histórico de Pedidos <a href="{{ route('admin') }}"
class="flex-1 text-center bg-gray-700 hover:bg-gray-800 p-6 rounded-2xl font-bold text-2xl transition transform hover:scale-105">

⬅ Voltar

</a>    
    </h1>

    <div class="flex flex-col gap-6">

        @forelse ($pedidos as $pedido)
            <div class="bg-neutral-800 p-6 rounded-2xl shadow-lg animate-slideIn">

                <div class="flex justify-between items-center mb-4">
                    <div>
                        <p class="text-sm text-gray-400">
                            Pedido #{{ $pedido->id }} • 
                            {{ $pedido->created_at->format('d/m/Y H:i') }}
                        </p>

                        <p class="text-2xl font-bold">
                            {{ $pedido->user->name }}
                        </p>
                    </div>

                    <p class="text-lg font-bold text-green-400">
                        💰 R$ {{ number_format($pedido->total, 2, ',', '.') }}
                    </p>
                </div>

                <div>
                    <p class="font-semibold mb-2 text-gray-300">
                        Itens:
                    </p>

                    <ul class="space-y-1">
                        @foreach ($pedido->order_items as $orderItem)
                            <li class="flex justify-between border-b border-neutral-700 pb-1">
                                <span>
                                    {{ $orderItem->item->name }} x{{ $orderItem->quantidade }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        @empty
            <p class="text-center text-gray-400 text-xl">
                Nenhum pedido encontrado.
            </p>
        @endforelse

    </div>

</div>
@endsection