@extends('adminPage.layouts.main')
@section('content')
    <a href="/data-rt" class=" btn btn-secondary text-decoration-none my-4">Kembali</a>
    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-primary">
                        Tambah RT
                    </h4>
                </div>
                <div class="card-body">

                    <form method="POST" action="/simpan-data-rt">
                        @csrf
                        <input type="hidden" name="rw_id" value="{{ $data }}">
                        <div class="mb-4">
                            <label for="nomor_rt">Nomor RT</label>
                            <input class="form-control @error('nomor_rt') is-invalid @enderror" id="nomor_rt"
                                type="text" name="nomor_rt" value="{{ old('nomor_rt') }}" required autocomplete="off">
                            @error('nomor_rt')
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
