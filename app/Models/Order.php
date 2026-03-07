<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'estimated_time',
    ];
    public function user(){
        return $this->belongsTo(User::class); // Pedido pertence a um usuário (quarto)
    }
    public function items(){
        return $this->hasMany(Order_Item::class); // Pedido possui vários itens
    }
}
