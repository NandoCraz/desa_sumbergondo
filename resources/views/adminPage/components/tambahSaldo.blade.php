@extends('adminPage.layouts.main')
@section('content')
    <a href="/bank-sampah/data-bank" class=" btn btn-secondary text-decoration-none my-4">Kembali</a>
    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-primary">
                        Tambah Saldo
                    </h4>
                </div>
                <div class="card-body">

                    <form method="POST" action="/simpan-update-saldo">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user_id }}">
                        <div class="mb-4">
                            <label for="saldo_bank">Tambah Saldo</label>
                            <input class="form-control @error('saldo_bank') is-invalid @enderror"
                                id="saldo_bank" type="text" name="saldo_bank"
                                value="{{ old('saldo_bank') }}" required autocomplete="off">
                            @error('saldo_bank')
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
