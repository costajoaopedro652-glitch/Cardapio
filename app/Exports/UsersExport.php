<?php

namespace App\Exports;

use App\Models\Hospede;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

        protected $fim;
        protected $inicio;

    public function __construct($fim, $inicio)
    {
        $this->inicio = $inicio;
        $this->fim = $fim;
    }


    public function collection()
    {
        $query = Hospede::where('status', 'hospedado');
        if($this->inicio && $this->fim){
            $query->whereBetween('created_at',[
                $this->inicio . '00:00:00',
                $this->fim . '23:59:59',
            ]);
        }
        return $query->get();
    }
}
