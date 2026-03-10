@extends('items.layout  ')

@section('content')
<h1>Cardápio</h1>

@foreach($items as $item)
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:5px;">
        <h3>{{ $item->name }}</h3>
        <p>{{ $item->description }}</p>
        <p>R$ {{ number_format($item->price, 2, ',', '.') }}</p>

        @if($item->is_available)
            <form action="{{ route('items.store') }}" method="POST">
                @csrf
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                <button type="submit">Adicionar ao pedido</button>
            </form>
        @else
            <span style="color:red;">Indisponível</span>
        @endif
    </div>
@endforeach
    <div>
        <button><a href="{{route('cart.index')}}">Ir para Carrinho</a></button>
    </div>
@endsection