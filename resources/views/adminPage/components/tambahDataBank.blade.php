@extends('adminPage.layouts.main')
@section('content')
    <a href="/data-pengolahan" class=" btn btn-secondary text-decoration-none my-4">Kembali</a>
    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-primary">
                        Tambah Bank Sampah
                    </h4>
                </div>
                <div class="card-body">

                    <form method="POST" action="/simpan-data-bank">
                        @csrf
                        <div class="mb-4">
                            <label for="nama_bank">Nama Bank Sampah</label>
                            <input class="form-control @error('nama_bank') is-invalid @enderror" id="nama_bank"
                                type="text" name="nama_bank" value="{{ old('nama_bank') }}" required autocomplete="off">
                            @error('nama_bank')
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
@section('script')
@endsection
