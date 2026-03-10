<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order_Item extends Model
{
    use HasFactory;

    protected $table = 'order_items'; // <-- aqui

    protected $fillable = [
        'order_id',
        'item_id',
        'quantidade',
        'price',
    ];
    
    public function order(){
        return $this->belongsTo(Order::class); // Esse item pertence a um pedido
    }
    
    public function item() {
        return $this->belongsTo(Item::class);// Esse item pertence a um prato do cardápio
    }
}
