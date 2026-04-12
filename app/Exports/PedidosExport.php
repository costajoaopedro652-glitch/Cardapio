<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;

class PedidosExport implements FromCollection
{
    protected $inicio;
    protected $fim;

    public function __construct($inicio, $fim)
    {
        $this->inicio = $inicio;
        $this->fim = $fim;
    }

    public function collection()
    {
        $query = Order::where('status', 'entregue');

        if ($this->inicio && $this->fim) {
            $query->whereBetween('created_at', [
                $this->inicio . ' 00:00:00',
                $this->fim . ' 23:59:59'
            ]);
        }

        return $query->get();
    }
}
