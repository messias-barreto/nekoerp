<?php

namespace Database\Seeders;

use App\Models\Cupom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CupomSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cupom::create([
            'name' => '#neko5',
            'valor' => 5,
            'quantidade' => 10,
            'data_expiracao' => '2025-07-29 00:00:00',
        ]);

        Cupom::create([
            'name' => '#neko10',
            'valor' => 10,
            'quantidade' => 6,
            'data_expiracao' => '2025-07-29 00:00:00',
        ]);

        Cupom::create([
            'name' => '#neko25',
            'valor' => 25,
            'quantidade' => 5,
            'data_expiracao' => '2025-07-29 00:00:00',
        ]);

        Cupom::create([
            'name' => '#neko50',
            'valor' => 50,
            'quantidade' => 2,
            'data_expiracao' => '2025-07-29 00:00:00',
        ]);
    }
}
