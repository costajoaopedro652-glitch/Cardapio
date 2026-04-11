@extends('items.layout')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-12">

    <h1 class="text-4xl font-bold mb-10 text-center">
        ➕ Cadastrar Novo Hóspede <a href="{{ route('admin') }}"
class="flex-1 text-center bg-gray-700 hover:bg-gray-800 p-6 rounded-2xl font-bold text-2xl transition transform hover:scale-105">

⬅ Voltar

</a>
    </h1>

    <form action="{{route('admin.cadastrarhospede')}}" method="post"
          class="bg-neutral-900 p-8 rounded-2xl shadow-lg border border-neutral-700 flex flex-col gap-6">

        @csrf

        <div>
            <label class="block text-gray-300 mb-2">Nome do hóspede</label>
            <input type="text" name="name"
                   class="w-full p-3 rounded bg-neutral-800 border border-neutral-600 focus:outline-none focus:border-blue-500">
        </div>

        <div>
            <label class="block text-gray-300 mb-2">CPF</label>
            <input 
    type="text" 
    name="cpf" 
    id="cpf"
    maxlength="14"
    class="w-full p-3 rounded bg-neutral-800 border border-neutral-600 focus:outline-none focus:border-blue-500">
        </div>

        <div>
            <label class="block text-gray-300 mb-2">Quarto</label>
            <select name="room"
                    class="w-full p-3 rounded bg-neutral-800 border border-neutral-600 focus:outline-none">
                @foreach ($quartos as $quarto)
                    <option value="{{$quarto->id}}">
                        {{$quarto->name}}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-gray-300 mb-2">Data de saída</label>
            <input type="date" name="data_saida"
                   class="w-full p-3 rounded bg-neutral-800 border border-neutral-600">
        </div>

        <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 transition p-3 rounded text-white font-bold">
            Hospedar
        </button>

    </form>

</div>
<script>
document.getElementById('cpf').addEventListener('input', function (e) {
    let value = e.target.value;

    // remove tudo que não é número
    value = value.replace(/\D/g, '');

    // aplica máscara
    value = value.replace(/(\d{3})(\d)/, '$1.$2');
    value = value.replace(/(\d{3})(\d)/, '$1.$2');
    value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

    e.target.value = value;
});
</script>
@endsection