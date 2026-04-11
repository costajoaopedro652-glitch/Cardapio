@extends('items.layout')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-12">

    <h1 class="text-4xl font-bold mb-10 text-center">
        Página de Admin
    </h1>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

        @can('ver pedidos')
            <a href="{{ route('admin.pedidos') }}"
               class="text-center bg-neutral-800 hover:bg-neutral-700 p-6 rounded-xl font-bold text-2xl transition transform hover:scale-105">
                📦 Ver Pedidos
            </a>
        @endcan

        @can('ver pedidos')
            <a href="{{ route('admin.historicoPedidos') }}"
               class="text-center bg-neutral-800 hover:bg-neutral-700 p-6 rounded-xl font-bold text-2xl transition transform hover:scale-105">
                📦 Pedidos Antigos
            </a>
        @endcan

        @can('ver pedidos')
            <a href="{{ route('admin.cadastrar') }}"
               class="text-center bg-neutral-800 hover:bg-neutral-700 p-6 rounded-xl font-bold text-2xl transition transform hover:scale-105">
                👨🏿‍🤝‍👨🏿 Cadastrar Hóspedes
            </a>
        @endcan

        @can('ver pedidos')
            <a href="{{ route('admin.hospedes') }}"
               class="text-center bg-neutral-800 hover:bg-neutral-700 p-6 rounded-xl font-bold text-2xl transition transform hover:scale-105">
                👨🏿‍🤝‍👨🏿 Ver Hóspedes
            </a>
        @endcan

        @can('ver pedidos')
            <a href="{{ route('admin.historicoHospedes') }}"
               class="text-center bg-neutral-800 hover:bg-neutral-700 p-6 rounded-xl font-bold text-2xl transition transform hover:scale-105">
                👨🏿‍🤝‍👨🏿 Histórico de Hóspedes
            </a>
        @endcan

        @can('ver pedidos')
            <a href="{{ route('admin.users') }}"
               class="text-center bg-neutral-800 hover:bg-neutral-700 p-6 rounded-xl font-bold text-2xl transition transform hover:scale-105">
                👨🏿‍🤝‍👨🏿 MudarRole
            </a>
        @endcan
    </div>

</div>
@endsection