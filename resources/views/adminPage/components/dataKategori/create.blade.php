@extends('adminPage.layouts.main')
@section('content')
    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-primary">
                        Tambah Kategori
                    </h4>
                </div>
                <div class="card-body">

                    <form method="POST" action="/master/data-kategori">
                        @csrf
                        <div class="mb-4">
                            <label for="nama_kategori">Nama</label>
                            <input class="form-control @error('nama_kategori') is-invalid @enderror" id="nama_kategori"
                                type="text" name="nama_kategori" value="{{ old('nama_kategori') }}" required
                                autocomplete="off">
                            @error('nama_kategori')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="text-right mb-2 mt-2">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>                
            </div>
            <a href="/master/data-kategori" class=" btn btn-secondary text-decoration-none my-2">Kembali</a>
        </div>
    </div>
@endsection
