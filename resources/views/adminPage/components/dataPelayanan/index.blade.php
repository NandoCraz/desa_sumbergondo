@extends('adminPage.layouts.main')
@section('content')
    @if (session('berhasil'))
        <div class="alert alert-success mb-3 col-lg-10" role="alert">
            {{ session('berhasil') }}
        </div>
    @endif
    <a href="/master/data-pelayanan/create" class="btn btn-info mb-4"><i class=" fas fa-solid fa-plus"></i> Tambah
        Pelayanan</a>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pelayanan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($pelayanans as $pelayanan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $pelayanan->nama_pelayanan }}</td>
                                <td class="text-center">Rp. {{ number_format($pelayanan->harga) }}</td>
                                <td class="text-center">
                                    <a href="/master/data-pelayanan/{{ $pelayanan->id }}/edit"
                                        class="btn btn-success btn-sm"><i class="fas fa-solid fa-pen"></i></a>
                                    <form action="/master/data-pelayanan/{{ $pelayanan->id }}" method="post"
                                        class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-sm btn-danger" onclick="confirm('Yakin Ingin Menghapus?')"><i
                                                class="fas fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
