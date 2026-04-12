@extends('items.layout')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12">

    <!-- Título -->
    <div class="flex items-center justify-between mb-10">
        <h1 class="text-4xl font-bold">
            📦 Histórico de Pedidos
        </h1>

        <a href="{{ route('admin') }}"
           class="bg-gray-700 hover:bg-gray-800 px-6 py-3 rounded-xl font-bold transition transform hover:scale-105">
            ⬅ Voltar
        </a>
    </div>

    <!-- Lista de pedidos -->
    <div class="flex flex-col gap-6">

        @forelse ($pedidos as $pedido)
            <div class="bg-neutral-800 p-6 rounded-2xl shadow-lg">

                <!-- Cabeçalho -->
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

                <!-- Itens -->
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

    <!-- Download PDF -->
    <div class="mt-10 bg-neutral-800 p-6 rounded-2xl shadow-lg">
        <h2 class="text-xl font-bold mb-4">📄 Baixar PDF</h2>

        <form action="{{ route('downloadPedidos') }}" method="GET" class="flex gap-4 items-end flex-wrap">

            <div>
                <label class="block text-sm text-gray-400">De</label>
                <input type="date" name="inicio" class="bg-neutral-700 p-2 rounded">
            </div>

            <div>
                <label class="block text-sm text-gray-400">Até</label>
                <input type="date" name="fim" class="bg-neutral-700 p-2 rounded">
            </div>

            <button type="submit"
                class="bg-green-600 hover:bg-green-700 px-6 py-2 rounded font-bold">
                Download
            </button>

        </form>
    </div>

</div>
@endsection