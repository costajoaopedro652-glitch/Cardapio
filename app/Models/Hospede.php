<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospede extends Model
{
    protected $fillable = [
        'name',
        'room',
        'cpf',
        'status',
        'data_saida'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'room');
    }
    
}
