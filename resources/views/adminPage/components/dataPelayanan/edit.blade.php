@extends('adminPage.layouts.main')
@section('content')
    <a href="javascript:history.back()" class=" btn btn-secondary text-decoration-none my-4">Kembali</a>
    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-primary">
                        Edit Pelayanan
                    </h4>
                </div>
                <div class="card-body">

                    <form method="POST" action="/master/data-pelayanan/{{ $pelayanan->id }}">
                        @method('put')
                        @csrf
                        <div class="mb-4">
                            <label for="nama_pelayanan">Nama</label>
                            <input class="form-control @error('nama_pelayanan') is-invalid @enderror" id="nama_pelayanan"
                                type="text" name="nama_pelayanan"
                                value="{{ old('nama_pelayanan', $pelayanan->nama_pelayanan) }}" required>
                            @error('nama_pelayanan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="harga">Harga</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        Rp.
                                    </span>
                                </div>
                                <input class="form-control @error('harga') is-invalid @enderror" id="harga"
                                    type="text" name="harga" value="{{ old('harga', $pelayanan->harga) }}" required
                                    autocomplete="off">
                            </div>
                            @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-4 mt-5">
                            <button type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
