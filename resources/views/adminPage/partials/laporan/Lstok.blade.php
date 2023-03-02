<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Stok Barang</title>
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
    <span>Laporan Stok Barang</span>
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>#</th>
                <th>Foto</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Berat</th>
                <th>Stok</th>
                <th>Total Dibeli</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangs as $barang)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td><img src="storage/{{ $barang->picture_barang }}" width="70"></td>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>
                        @foreach ($barang->kategori as $kategori)
                            <ul>
                                <li>{{ $kategori->nama_kategori }}</li>
                            </ul>
                        @endforeach
                    </td>
                    <td>Rp. {{ number_format($barang->harga) }}</td>
                    <td>{{ $barang->berat }}</td>
                    <td>{{ $barang->stok }}</td>
                    <td>{{ $barang->dibeli }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
