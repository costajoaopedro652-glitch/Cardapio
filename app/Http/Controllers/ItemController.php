<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Order_Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('items.index');
        // $items = Item::all();
        // return view('items.index', compact('items'));
    }

    /** 
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $item = Item::findOrFail($request->item_id);

    $order = Order::where('user_id', auth()->id())
        ->where('status', 'pendente')
        ->first();

    if (!$order) {
        $order = Order::create([
            'user_id' => auth()->id(),
            'status' => 'pendente'
        ]);
    }

    $orderItem = Order_Item::where('order_id', $order->id)
        ->where('item_id', $item->id)
        ->first();

    if ($orderItem) {
        $orderItem->quantidade += 1;
        $orderItem->save();
    } else {
        Order_Item::create([
            'order_id' => $order->id,
            'item_id' => $item->id,
            'quantidade' => 1,
            'price' => $item->price
        ]);
    }

    return redirect()->back();
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    $orderItem = Order_Item::findOrFail($id);
    if($orderItem->quantidade <= 1){
        $orderItem->delete();
    }
    else{
        $orderItem->quantidade -= 1;
        $orderItem->save();
    }
    return redirect()->back();
    }

    public function cart()
{
    $order = Order::where('user_id', auth()->id())->where('status', 'pendente')->first();

    $orderItems = $order ? $order->order_items : collect();

    $total = $orderItems->sum(function ($item) {
        return $item->price * $item->quantidade;
    });

    return view('items.cart', compact('orderItems','total'));
}

public function confirmarPedido()
{
    
    $order = Order::where('user_id', auth()->id())
    ->where('status','pendente')->first();

    if (!$order || $order->order_items->isEmpty()) {
        return redirect()->back()->with('error', 'Carrinho vazio');
    }

    $total = $order->order_items->sum(function ($item) {
        return $item->price * $item->quantidade;
    });
    // atualiza status para confirmado
    $order->update([
        'status' => 'confirmado',
        'total'=>$total,
]);

return redirect()->route('PedidoSucesso.index');
}  

public function PedidoSucesso(){
    return view('items.PedidoSucesso');
}

public function pedidos(){
    $orders= Order::where('status','confirmado')->with('order_items.item','user')->get();

    $items = Order::with('order_items.item','user')->get();
    return view('admin.pedidos', compact([
        'orders',
        'items'
    ]));
}
public function FinalizarPedido($id){
    $order = Order::findOrFail($id);

    $order->update([
        'status' => 'entregue'
    ]);

    return redirect()->back()->with('success', 'Pedido finalizado!');
}
public function cardapioManha(){
    $items = Item::where('categoria','manha')->get();
        return view('cadapios.cardapioManha', compact('items'));
}
public function cardapioAlmoço(){
    $items = Item::where('categoria','almoço')->get();
        return view('cadapios.cardapioAlmoço', compact('items'));
}
public function cardapioTarde(){
    $items = Item::where('categoria','tarde')->get();
        return view('cadapios.cardapioTarde', compact('items'));
}
public function cardapioNoite(){
    $items = Item::where('categoria','noite')->get();
        return view('cadapios.cardapioNoite', compact('items'));
}
public function verificarPedidos()
{
    $pedidos = Order::where('status','confirmado')->count();

    return response()->json([
        'pedidos' => $pedidos
    ]);
}
public function pedidosJson()
{
    $orders = Order::where('status','confirmado')
        ->with('order_items.item','user')
        ->latest()
        ->get();

    return response()->json($orders);
}
}

