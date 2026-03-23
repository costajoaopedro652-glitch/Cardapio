<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CardapioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::firstOrCreate(
            ['name'=>'hamburguer','categoria'=>'noite'],
            ['price'=>10]
        );
        Item::firstOrCreate(
            ['name'=>'lasanha','categoria'=>'almoço'],
            ['price'=>15]
        );
        Item::firstOrCreate(
            ['name'=>'café','categoria'=>'manha'],
            ['price'=>4]
        );
        Item::firstOrCreate(
            ['name'=>'agua','categoria'=>'tarde'],
            ['price'=>5]
        );
    }
}
