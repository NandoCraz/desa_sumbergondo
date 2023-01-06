<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Barang::create([
            'nama_barang' => 'Oli Express',
            'harga' => 70000,
            'stok' => 14,
            'kategori_id' => 1,
            'deskripsi' => 'Ini adalah Oli Mobil',
            'berat' => 400,
            'picture_barang' => 'barangPicture/back.png'
        ]);
        Barang::create([
            'nama_barang' => 'Busi',
            'harga' => 35000,
            'stok' => 17,
            'kategori_id' => 2,
            'deskripsi' => 'Ini adalah Busi',
            'berat' => 110,
            'picture_barang' => 'barangPicture/gear.png'
        ]);
        Barang::create([
            'nama_barang' => 'Radiator',
            'harga' => 750000,
            'stok' => 14,
            'kategori_id' => 3,
            'deskripsi' => 'Ini adalah Radiator Mobil',
            'berat' => 2000,
            'picture_barang' => 'barangPicture/grid.png'
        ]);
        Barang::create([
            'nama_barang' => 'Bumper',
            'harga' => 70000,
            'stok' => 21,
            'kategori_id' => 1,
            'deskripsi' => 'Ini adalah Bumper Mobil',
            'berat' => 6200,
            'picture_barang' => 'barangPicture/home.png'
        ]);
    }
}
