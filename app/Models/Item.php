<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    
    protected $fillable = [
        'name',
        'description',
        'price',
        'is_available',
        'categoria'
    ];
    
    protected $casts = [
    'is_available' => 'boolean',
    ];

    public function markUnavailable()
    {
        $this->is_available = false;   //função para marcar item como em falta
        $this->save();
    }

    public function markAvailable()
    {
        $this->is_available = true;    //função para marcar item como em estoque
        $this->save();
    }

    public function toggleAvailability()
    {
        $this->is_available = !$this->available; //aqui é a fução que diz se tem ou não
        $this->save();
    }

    public function orderItems(){
        return $this->hasMany(Order_Item::class);// Um item do cardápio pode aparecer em vários pedidos
    }
    
}
