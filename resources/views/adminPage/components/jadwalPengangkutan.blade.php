{{-- @dd($checkoutsDel) --}}
@extends('adminPage.layouts.main')
@section('content')
    {{-- @if (session('success'))
        <div class="alert alert-success mb-3 col-lg-10" role="alert">
            {{ session('success') }}
        </div>
    @endif --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3 text-center">
            <h6 class="m-0 font-weight-bold text-dark">Atur Jadwal Pengangkutan</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="/simpan-jadwal" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="waktu">Tanggal & Jam <span class="fw-bold text-danger">*</span></label>
                    <input class="form-control selector @error('waktu') is-invalid @enderror" id="waktu" type="text"
                        name="waktu" value="{{ isset($jadwal->waktu) ? $jadwal->waktu : '' }}" required autocomplete="off"
                        required>
                    @error('waktu')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4 d-flex flex-column">
                    <label for="desk">Deskripsi</label>
                    <input type="text" class="form-control" name="desk" id="desk"
                        value="{{ isset($jadwal->desk) ? $jadwal->desk : '' }}">
                    @error('desk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-2 mt-2">
                    <button type="submit" class="btn btn-secondary btn-outline-light" style="font-weight: 700">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $(".selector").flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",
            });
        });
    </script>
@endsection
