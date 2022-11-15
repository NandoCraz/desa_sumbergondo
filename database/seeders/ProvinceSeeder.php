<?php

namespace Database\Seeders;

use App\Models\Provinsi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provinsi::create([
            'nama_provinsi' => 'Bali',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Bangka Belitung',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Banten',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Bengkulu',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'DI Yogyakarta',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'DKI Jakarta',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Gorontalo',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Jambi',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Jawa Barat',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Jawa Tengah',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Jawa Timur',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Kalimantan Barat',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Kalimantan Selatan',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Kalimantan Tengah',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Kalimantan Timur',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Kalimantan Utara',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Kepulauan Riau',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Lampung',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Maluku',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Maluku Utara',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Nanggroe Aceh Darussalam (NAD)',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Nusa Tenggara Barat (NTB)',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Nusa Tenggara Timur (NTT)',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Papua',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Papua Barat',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Riau',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Sulawesi Barat',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Sulawesi Selatan',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Sulawesi Tengah',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Sulawesi Tenggara',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Sulawesi Utara',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Sumatera Barat',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Sumatera Selatan',
        ]);

        Provinsi::create([
            'nama_provinsi' => 'Sumatera Utara',
        ]);
    }
}
