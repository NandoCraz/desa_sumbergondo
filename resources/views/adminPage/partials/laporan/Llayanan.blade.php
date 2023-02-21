{{-- @dd($bookings) --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Penjualan</title>
</head>
<style>
    .header {
        margin-bottom: 50px;
    }

    h1 {
        text-align: center;
    }

    h5 {
        text-align: center;
    }

    span {
        font-size: 20px;
        font-weight: 300;
        margin-top: 500px;
    }

    table {
        margin-top: 20px;
    }

    table,
    th,
    tr,
    td {
        border: 1px solid black;
        text-align: center;
    }

    th,
    tr,
    td {
        padding: 15px;
    }
</style>

<body>
    <div class="header">
        <h1>NSPARKEL</h1>
        <h5>Jl. Rangkah VII/124C, Surabaya | 081233911558</h5>
    </div>
    <span>Laporan Layanan Tanggal : {{ $awal }} / {{ $akhir }}</span>
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal Dipesan</th>
                <th>Nama Pemesan</th>
                <th>Tempat Perbaikan</th>
                <th>Alamat</th>
                <th>Total Biaya (pelayanan & barang)</th>
                <th>Memesan Barang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $booking->created_at)->format('Y-m-d') }}
                    </td>
                    <td>{{ $booking->nama_pemesan }}</td>
                    <td>{{ $booking->tempat_perbaikan == 'dibengkel' ? 'Di Bengkel' : 'Di Rumah' }}</td>
                    <td>{{ isset($booking->alamat) ? $booking->alamat : '-' }}</td>
                    <td>Rp. {{ number_format($booking->total + $booking->total_harga_barang) }}</td>
                    <td>{{ $booking->barang->count() }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" style="text-align: center">Total Biaya Layanan & Barang</td>
                <td colspan="2">Rp. {{ number_format($total) }}</td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
