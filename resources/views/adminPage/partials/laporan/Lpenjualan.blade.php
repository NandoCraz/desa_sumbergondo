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
    <span>Laporan Penjualan Tanggal : {{ $awal }} / {{ $akhir }}</span>
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal Dipesan</th>
                <th>Nama Penerima</th>
                <th>Alamat</th>
                <th>Total Harga</th>
                <th>Total Barang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($checkouts as $checkout)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $checkout->created_at)->format('Y-m-d') }}
                    </td>
                    <td>{{ $checkout->daftarAlamat->nama_penerima }}</td>
                    <td>{{ $checkout->daftarAlamat->alamat }},
                        {{ $checkout->daftarAlamat->provinsi->nama_provinsi }},
                        {{ $checkout->daftarAlamat->kota->nama_kab_kota }}</td>
                    <td>Rp. {{ number_format($checkout->total) }}</td>
                    <td>{{ $checkout->pesanans->count() }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" style="text-align: center">Total Penjualan</td>
                <td colspan="3">Rp. {{ number_format($total) }}</td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
