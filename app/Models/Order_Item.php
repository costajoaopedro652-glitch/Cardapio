<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Order_Item extends Model
{
    protected $fillable = [
        'order_id',
        'item_id',
        'quantidade'
    ];
    
    public function order(){
        return $this->belongsTo(Order::class); // Esse item pertence a um pedido
    }
    
    public function menuItem() {
        return $this->belongsTo(Item::class);// Esse item pertence a um prato do cardápio
    }
}
