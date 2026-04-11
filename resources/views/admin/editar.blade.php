@extends('items.layout')
@section('content')


<h1 class="text-7xl text-center mb-12 text-red-400" style="font-family: 'Playfair Display', serif; font-weight: 700;">
    🍽 Editar Item
</h1>

<div class="max-w-3xl mx-auto">

    @if ($errors->any())
        <div class="bg-red-900 border border-red-600 text-red-300 p-4 rounded-xl mb-6">
            @foreach ($errors->all() as $erro)
                <p>{{ $erro }}</p>
            @endforeach
        </div>
    @endif

    <form 
        action="{{route('items.atualizar', $item->id)}}" 
        method="post"
        class="bg-neutral-900 border border-neutral-800 rounded-3xl shadow-2xl p-10 space-y-6 animate-slideIn"
    >
        @csrf
        @method('patch')
        <!-- Nome -->
        <div>
            <label class="block text-xl mb-2 text-gray-300">Nome do Item</label>
            <input 
                type="text" 
                name="name" 
                value="{{$item->name}}"
                class="w-full p-4 rounded-xl bg-neutral-800 border border-neutral-700 text-white focus:outline-none focus:border-red-500 transition"
            >
        </div>

        <!-- Descrição -->
        <div>
            <label class="block text-xl mb-2 text-gray-300">Descrição</label>
            <input 
                type="text" 
                name="description" 
                value="{{$item->description}}"
                class="w-full p-4 rounded-xl bg-neutral-800 border border-neutral-700 text-white focus:outline-none focus:border-red-500 transition"
            >
        </div>

        <!-- Preço -->
        <div>
            <label class="block text-xl mb-2 text-gray-300">Preço</label>
            <input 
                type="number" 
                name="price" 
                step="0.01"
                value="{{$item->price}}"
                placeholder="Ex: 19.90"
                class="w-full p-4 rounded-xl bg-neutral-800 border border-neutral-700 text-white focus:outline-none focus:border-red-500 transition"
            >
        </div>

        

        <!-- Disponível -->
        <div class="flex items-center gap-4">
            <input type="hidden" name="is_available" value="0">

            <input 
                type="checkbox" 
                name="is_available" 
                value="1"
                {{ old('is_available') ? 'checked' : '' }}
                class="w-6 h-6 accent-red-600"
            >

            <label class="text-xl text-gray-300">Item disponível</label>
        </div>

        <!-- Botão -->
        <button 
            type="submit"
            class="w-full bg-red-600 hover:bg-red-700 transition p-5 rounded-xl font-bold text-2xl transform hover:scale-105 active:scale-95"
        >
            Editar Item 
        </button>

    </form>
    <form action="{{route('items.deletar', $item->id)}}" method="post">
        @csrf
        @method('delete')
        <button 
            type="submit"
            class="w-full bg-red-600 hover:bg-red-700 transition p-5 rounded-xl font-bold text-2xl transform hover:scale-105 active:scale-95"
        >
            Deletar Item 
        </button>
    </form>
</div>

@endsection