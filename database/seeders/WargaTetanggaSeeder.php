<?php

namespace Database\Seeders;

use App\Models\Tetangga;
use App\Models\Warga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WargaTetanggaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Warga::create([
            'nomor_rw' => 'RW 1'
        ]);
        Warga::create([
            'nomor_rw' => 'RW 2'
        ]);

        Tetangga::create([
            'nomor_rt' => 'RT 1',
            'rw_id' => 1
        ]);
        Tetangga::create([
            'nomor_rt' => 'RT 2',
            'rw_id' => 1
        ]);
        Tetangga::create([
            'nomor_rt' => 'RT 3',
            'rw_id' => 1
        ]);
        Tetangga::create([
            'nomor_rt' => 'RT 4',
            'rw_id' => 1
        ]);
        Tetangga::create([
            'nomor_rt' => 'RT 1',
            'rw_id' => 2
        ]);
        Tetangga::create([
            'nomor_rt' => 'RT 2',
            'rw_id' => 2
        ]);
        Tetangga::create([
            'nomor_rt' => 'RT 3',
            'rw_id' => 2
        ]);
        Tetangga::create([
            'nomor_rt' => 'RT 4',
            'rw_id' => 2
        ]);
        Tetangga::create([
            'nomor_rt' => 'RT 1',
            'rw_id' => 3
        ]);
        Tetangga::create([
            'nomor_rt' => 'RT 2',
            'rw_id' => 3
        ]);
        Tetangga::create([
            'nomor_rt' => 'RT 3',
            'rw_id' => 3
        ]);
        Tetangga::create([
            'nomor_rt' => 'RT 4',
            'rw_id' => 3
        ]);
        Tetangga::create([
            'nomor_rt' => 'RT 1',
            'rw_id' => 4
        ]);
        Tetangga::create([
            'nomor_rt' => 'RT 2',
            'rw_id' => 4
        ]);
        Tetangga::create([
            'nomor_rt' => 'RT 3',
            'rw_id' => 4
        ]);
        Tetangga::create([
            'nomor_rt' => 'RT 4',
            'rw_id' => 4
        ]);
    }
}
