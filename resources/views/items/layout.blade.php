<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pousada Pousada</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translate(-120px, 60px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translate(0, 0) scale(1);
    }
}

.animate-slideIn {
    animation: slideIn 0.9s cubic-bezier(.22,1,.36,1) forwards;
}
@keyframes slideOut {
    from {
        opacity: 1;
        transform: translateX(0);
    }
    to {
        opacity: 0;
        transform: translateX(120px);
    }
}

.animate-slideOut {
    animation: slideOut 1s ease forwards;
}
</style>
</head>
<body class="pb-24 bg-black text-white">

    <header>
        <h1></h1>
    </header>

    <main>
        @yield('content')
    </main>

<script>
function removeItem(button) {

    const form = button.closest("form");
    const card = button.closest(".cart-item");

    card.classList.remove("animate-slideIn");
    card.classList.add("animate-slideOut");

    setTimeout(() => {
        form.submit();
    }, 500); // tempo da animação
}
</script>
<footer class="mt-20 py-16 text-center border-t-2 border-neutral-700">

    <h2 class="text-6xl font-extrabold text-red-500">
        🍔 Pousada Iramaia
    </h2>

    <p class="text-gray-300 text-3xl mt-6">
        O Sabor Que Conquista 🍟
    </p>

    <p class="text-gray-400 text-xl mt-4">
        © 2026 Todos os direitos reservados
    </p>

</footer>
</body>
</html>