@extends('adminPage.layouts.main')
@section('content')
    <a href="/data-pengolahan" class=" btn btn-secondary text-decoration-none my-4">Kembali</a>
    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-primary">
                        Tambah RW
                    </h4>
                </div>
                <div class="card-body">

                    <form method="POST" action="/simpan-update-tagihan">
                        @csrf
                        <input type="hidden" name="olah_id" value="{{ $olah_id }}">
                        <div class="mb-4">
                            <label for="tagihan_insenator">Tagihan</label>
                            <input class="form-control @error('tagihan_insenator') is-invalid @enderror"
                                id="tagihan_insenator" type="text" name="tagihan_insenator"
                                value="{{ old('tagihan_insenator') }}" required autocomplete="off">
                            @error('tagihan_insenator')
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
