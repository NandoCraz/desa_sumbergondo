@extends('adminPage.layouts.main')
@section('content')
    <a href="/data-pengolahan" class=" btn btn-secondary text-decoration-none my-4">Kembali</a>
    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-primary">
                        Tambah Tagihan Komposter
                    </h4>
                </div>
                <div class="card-body">

                    <form method="POST" action="/update-tagihan-komposter">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user_id }}">
                        <div class="mb-4">
                            <label for="tagihan_komposter">Tagihan</label>
                            <input class="form-control @error('tagihan_komposter') is-invalid @enderror"
                                id="tagihan_komposter" type="text" name="tagihan_komposter"
                                value="{{ old('tagihan_komposter') }}" required autocomplete="off">
                            @error('tagihan_komposter')
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
