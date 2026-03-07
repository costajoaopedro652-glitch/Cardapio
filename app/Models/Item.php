<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    
    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    public function orderItems(){
        return $this->hasMany(Order_Item::class);// Um item do cardápio pode aparecer em vários pedidos
    }
}
