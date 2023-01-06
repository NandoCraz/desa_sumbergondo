<?php

namespace Database\Seeders;

use App\Models\Pelayanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pelayanan::create([
            'nama_pelayanan' => 'Setrum Aki',
            'harga' => 40000
        ]);
        Pelayanan::create([
            'nama_pelayanan' => 'Ganti Radiator',
            'harga' => 280000
        ]);
        Pelayanan::create([
            'nama_pelayanan' => 'Tune Up',
            'harga' => 520000
        ]);
        Pelayanan::create([
            'nama_pelayanan' => 'Bongkar Mesin',
            'harga' => 2200000
        ]);
        Pelayanan::create([
            'nama_pelayanan' => 'Ganti Oli',
            'harga' => 30000
        ]);
    }
}
