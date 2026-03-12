<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>todos os Pedidos</h1>
    @foreach ($orders as $order )
    <div>
        <h2>valor total:{{$order->total}} nome do quarto:{{$order->user->name}}</h2> 
        <form action="{{route('FinalizarPedido', $order->id)}}" method="Post">
            @csrf
            <button type="submit">Finalizar Pedido</button>
        </form>
    </div>
        
    @endforeach
        <div>
            <button><a href="{{route('items.index')}}">voltar para cardápio</a></button>
        </div>
</body>
</html>