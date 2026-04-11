<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Usuários</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-black text-white p-6">

<h1 class="text-2xl font-bold mb-6 text-orange-400">
👤 Gerenciar Usuários
<a href="{{ route('admin') }}"
class="flex-1 text-center bg-gray-700 hover:bg-gray-800 p-6 rounded-2xl font-bold text-2xl transition transform hover:scale-105">

⬅ Voltar

</a>  
</h1>

@foreach($users as $user)

<div class="bg-neutral-900 p-4 rounded mb-4 flex justify-between items-center">

    <div>
        <p class="font-bold">{{ $user->name }}</p>
        <p class="text-gray-400 text-sm">{{ $user->email }}</p>
    </div>

    <form action="{{ route('admin.users.role') }}" method="POST" class="flex gap-2">
        @csrf

    <select name="role" class="bg-black border border-gray-600 p-1 rounded">
        <option value="admin" 
        {{ $user->hasRole('admin') ? 'selected' : '' }}>
        admin
        </option>

        <option value="room" 
        {{ $user->hasRole('room') ? 'selected' : '' }}>
        room
        </option>
    </select>

        <input type="hidden" name="user_id" value="{{ $user->id }}">

        <button type="submit"
        class="bg-orange-600 px-3 py-1 rounded hover:bg-orange-700">
            Salvar
        </button>
    </form>

</div>

@endforeach

</body>
</html>