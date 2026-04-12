<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PedidosExport as PedidosExportAlias;
use App\Models\Hospede;
use App\Models\Item;
use App\Models\Order;
use App\Models\Order_Item;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Foundation\Console\DownCommand;
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
public function criarItem(){
    return view('admin.criarItem');
}
public function salvar(Request $request){
    $validarItem = $request->validate([ 
    'name' => 'required|min:1|string',
    'description' => 'nullable|min:1|string',
    'categoria'=>'required|in:almoço,noite,manha,tarde',
    'price' => 'required|numeric|min:0'
    ]);

    $validarItem['is_available'] = $request->boolean('is_available');

    Item::firstOrCreate(
    [
        'name' => $validarItem['name'],
        'categoria' => $validarItem['categoria']
    ],
    [
        'description' => $validarItem['description'],
        'categoria' => $validarItem['categoria'],
        'is_available' => $validarItem['is_available'],
        'price' => $validarItem['price']
    ]

    );

    return redirect()->route('items.index');
}
public function editar(Item $item){
    return view('admin.editar',compact('item'));
}

public function atualizar(Item $item, Request $request){
    $validarItem = $request->validate([ 
    'name' => 'required|min:1|string',
    'description' => 'nullable|min:1|string',
    'price' => 'required|numeric|min:0'
    ]);

    $validarItem['is_available'] = $request->boolean('is_available');

    $item->update([
        'name'=>$validarItem['name'],
        'description'=>$validarItem['description'],
        'price'=>$validarItem['price'],
        'is_available'=>$validarItem['is_available']
    ]);
    return redirect()->route('items.index');
}

    public function deletar(Item $item){
        $item->delete();
        return redirect()->route('items.index');
    }
    public function usuarios(){

    $users = User::where('id', '!=', auth()->id())->get();

    return view('admin.users', compact('users'));
}

public function updateRole(Request $request)
{
    $request->validate([
        'role' => 'required|exists:roles,name',
        'user_id' => 'required|exists:users,id'
    ]);

    $user = User::findOrFail($request->user_id);

    if ($user->id === auth()->id()) {
        abort(403, 'Você não pode alterar sua própria role.');
    }

    $user->syncRoles([$request->role]);
    return redirect()->route('admin.users');
}

public function admin(){
    return view('admin.admin');
}

public function historicoPedidos(){
    $pedidos = Order::where('status','entregue')->get();
    return view('admin.historicoPedidos',compact('pedidos'));
}
public function historicoPedidosPdf(){
    $pedidos = Order::where('status','entregue')->get();
    return view('admin.historicoPedidosPdf',compact('pedidos'));
}

public function adminCadastrar(){
    $quartos= User::where('name','!=','admin')->get();
    return view('admin.cadastroHospedes',compact('quartos'));
}

public function cadastrarHospede(Request $request){
    $validarItem=$request->validate([
        'name'=>'required|string',
        'room'=>'required|exists:users,id',
        'data_saida'=>'nullable|date',
        'cpf'=>'required'
    ]);
    $cpf = preg_replace('/\D/', '', $request->cpf);
    Hospede::create([
        'name'=>$validarItem['name'],
        'cpf'=>$cpf,
        'room'=>$validarItem['room'],
        'data_saida'=>$validarItem['data_saida']
    ]);

    return redirect()->route('admin');
}
public function hospedes(){
    $hospedes = Hospede::where('status','hospede')->get();
    return view('admin.hospedes',compact('hospedes'));
}
public function hospedesHistorico(){
    $hospedes = Hospede::where('status','hospedado')->get();
    return view('admin.historicoHospedes', compact('hospedes'));
}
public function desospedar(Hospede $hospede){
    $hospede->update([
        'status'=>'hospedado',
    ]);

    return redirect()->route('admin.hospedes');
}
public function gerarPDF(Request $request){

    $query= Order::query()->where('status','entregue');
    if($request->inicio && $request->fim){
        $query->whereBetween('created_at',[
            $request->inicio . ' 00:00:00',
            $request->fim . ' 23:59:59'
        ]);
    }
    $pedidos = $query->get();

    $pdf=Pdf::loadView('admin.historicoPedidosPdf', compact('pedidos'));

    return $pdf->download('pedidos.pdf');

    return view('admin.historicoPedidos',compact('pedidos'));
}
public function gerarExcel(Request $request)
{
    return Excel::download(
        new PedidosExportAlias($request->inicio, $request->fim),
        'pedidos.xlsx'
    );
}
}
