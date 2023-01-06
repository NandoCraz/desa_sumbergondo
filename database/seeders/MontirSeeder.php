<?php

namespace Database\Seeders;

use App\Models\Montir;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MontirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Montir::create([
            'nama' => 'Wahid Wahyudi',
            'alamat' => 'Jl. Perum Indah/III-C, Surabaya',
            'no_telp' => '081234567890',
            'picture_montir' => 'montirPicture/bambang.jpg',
        ]);
        Montir::create([
            'nama' => 'Tukul Kurniawan',
            'alamat' => 'Jl. Bulak Rukem Barat/12A, Surabaya',
            'no_telp' => '081217176933',
            'picture_montir' => 'montirPicture/wijoyo.jpg',
        ]);
    }
}
