@extends('items.layout')

@section('content')
<h1>Meu Pedido</h1>

@if(count($orderItems) == 0)
    <p>Seu carrinho está vazio.</p>
@else
    @foreach($orderItems as $orderItem)
        <div style="border:1px solid #ccc; padding:10px; margin-bottom:5px;">
            <h3>{{ $orderItem->item->name }}</h3>
            <p>Quantidade: {{ $orderItem->quantity }}</p>
            <p>Preço: R$ {{ number_format($orderItem->item->price, 2, ',', '.') }}</p>

            <form action="{{ route('items.destroy', $orderItem->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Remover</button>
            </form>
        </div>
    @endforeach
    <div> <form action="{{route('confirmarPedido')}}" method="post">
        @csrf
        <button type="submit">Confirmar Pedido</button>
    </form></div>
@endif
@endsection