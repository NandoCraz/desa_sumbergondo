@extends('adminPage.layouts.main')
@section('content')
    @if (session('berhasil'))
        <div class="alert alert-success mb-3 col-lg-10" role="alert">
            {{ session('berhasil') }}
        </div>
    @endif
    <a href="/master/data-kategori/create" class="btn btn-info mb-4"><i class=" fas fa-solid fa-plus"></i> Tambah Kategori</a>
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
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($kategoris as $kategori)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $kategori->nama_kategori }}</td>
                                <td class="text-center">
                                    <a href="/master/data-kategori/{{ $kategori->id }}/edit"
                                        class="btn btn-success btn-sm"><i class="fas fa-solid fa-pen"></i></a>
                                    <form action="/master/data-kategori/{{ $kategori->id }}" method="post"
                                        class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-sm btn-danger" onclick="confirm('Yakin Ingin Menghapus?')"><i
                                                class="fas fa-solid fa-trash"></i></button>
                                    </form>
                                    <a href="/master/data-kategori/list/{{ $kategori->id }}" class="btn btn-secondary btn-sm"><i
                                            class="fas fa-solid fa-list"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
