@extends('adminPage.layouts.main')
@section('content')
    <a href="/master/data-pelayanan" class=" btn btn-secondary text-decoration-none my-4">Kembali</a>
    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-primary">
                        Tambah RW
                    </h4>
                </div>
                <div class="card-body">

                    <form method="POST" action="/master/simpan-data-rw">
                        @csrf
                        <div class="mb-4">
                            <label for="nomor_rw">Nomor RW</label>
                            <input class="form-control @error('nomor_rw') is-invalid @enderror" id="nomor_rw"
                                type="text" name="nomor_rw" value="{{ old('nomor_rw') }}" required
                                autocomplete="off">
                            @error('nomor_rw')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-4 mt-5">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
