@extends('items.layout')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-12">

    <h1 class="text-4xl font-bold mb-10 text-center">
        📜 Histórico de Hóspedes
        <a href="{{ route('admin') }}"
class="flex-1 text-center bg-gray-700 hover:bg-gray-800 p-6 rounded-2xl font-bold text-2xl transition transform hover:scale-105">

⬅ Voltar

</a>
    </h1>

    <div class="flex flex-col gap-6">

        @forelse ($hospedes as $hospede)
            <div class="bg-neutral-900 border border-neutral-700 p-6 rounded-2xl shadow-lg">

                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-semibold">
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

                    <div class="text-red-400 font-bold">
                        Finalizado
                    </div>
                </div>

            </div>
        @empty
            <p class="text-center text-gray-400">
                Nenhum histórico encontrado.
            </p>
        @endforelse
<!-- Download PDF -->
    <div class="mt-10 bg-neutral-800 p-6 rounded-2xl shadow-lg">
        <h2 class="text-xl font-bold mb-4">📄 Baixar PDF</h2>

        <form method="GET" class="flex gap-4 items-end flex-wrap">

    <div>
        <label class="block text-sm text-gray-400">De</label>
        <input type="date" name="inicio" value="{{ request('inicio') }}" class="bg-neutral-700 p-2 rounded">
    </div>

    <div>
        <label class="block text-sm text-gray-400">Até</label>
        <input type="date" name="fim" value="{{ request('fim') }}" class="bg-neutral-700 p-2 rounded">
    </div>

    <!-- PDF -->
    <button type="submit" formaction="{{ route('downloadHospedes') }}"
        class="bg-red-600 hover:bg-red-700 px-6 py-2 rounded font-bold">
        📄 PDF
    </button>

    <!-- EXCEL -->
    <button type="submit" formaction="{{ route('exportar.excelHospedes') }}"
        class="bg-green-600 hover:bg-green-700 px-6 py-2 rounded font-bold">
        📊 Excel
    </button>
    
</form>
    </div>
    </div>
</div>
@endsection