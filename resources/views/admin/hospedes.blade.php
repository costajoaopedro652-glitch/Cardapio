@extends('items.layout')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-12">

    <h1 class="text-4xl font-bold mb-10 text-center">
        🏨 Hóspedes Atuais
        <a href="{{ route('items.index') }}"
class="flex-1 text-center bg-gray-700 hover:bg-gray-800 p-6 rounded-2xl font-bold text-2xl transition transform hover:scale-105">

⬅ Voltar

</a>
    </h1>

    <div class="flex flex-col gap-6">

        @forelse ($hospedes as $hospede)
            <div class="bg-neutral-900 border border-neutral-700 p-6 rounded-2xl shadow-lg animate-slideIn">

                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-semibold text-white">
                            {{$hospede->name}}
                        </h2>

                        <p class="text-gray-400 mt-2">
                            📅 Entrada: 
                            {{ \Carbon\Carbon::parse($hospede->created_at)->format('d/m/Y') }}
                        </p>

                        <p class="text-gray-400">
                            🚪 Saída: 
                            {{ \Carbon\Carbon::parse($hospede->data_saida)->format('d/m/Y') }}
                        </p>
                    </div>

                    <div class="text-green-400 font-bold">
                        Ativo
                    </div>
                    <form action="{{route('admin.desospedar',$hospede->id)}}" method="post">
                        @csrf
                        @method('patch')
                        <button type="submit" class="text-red-400 font-bold"> desospedar</button>
                    </form>
                </div>

            </div>
        @empty
            <p class="text-center text-gray-400">
                Nenhum hóspede no momento.
            </p>
        @endforelse
    
    </div>
</div>
@endsection