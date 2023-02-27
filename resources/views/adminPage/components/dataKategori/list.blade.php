@extends('adminPage.layouts.main')
@section('content')
    <a href="/master/data-kategori" class=" btn btn-secondary text-decoration-none my-4">Kembali</a>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Kategori</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>No.</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($kategoriList as $katLis)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $katLis->nama_barang }}</td>
                                <td class="text-center">{{ $katLis->harga }}</td>
                                <td class="text-center">{{ $katLis->stok }}</td>
                                <td class="text-center">
                                    @if ($katLis !== 0)
                                        <h2 class="badge text-light bg-success">Siap</h2>
                                    @else
                                        <h2 class="badge text-light bg-danger">Kosong</h2>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
